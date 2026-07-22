<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use App\Models\Promo; // <-- Model Promo
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf; // <-- Tambahan Library PDF

class CheckoutController extends Controller
{
    public function create($id)
    {
        $event = Event::findOrFail($id);
        $categories = \App\Models\Category::all();

        return view('checkout.create', compact('event','categories'));
    }

    public function store(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        // 1. Tambahkan validasi untuk promo_code
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'promo_code' => 'nullable|string' // Boleh kosong
        ]);

        if ($event->capacity <= 0) {
            return back()->with('error', 'Mohon maaf, tiket habis!')->withInput();
        }

        $orderId = 'TRX-' . time() . '-' . Str::random(5);
        
        // 2. Hitung harga awal
        $totalPrice = $event->price + 5000; 
        $appliedPromo = null;

        // 3. Pengecekan Kode Promo
        if ($request->filled('promo_code')) {
            $promo = Promo::where('code', $request->promo_code)->first();

            if (!$promo) {
                return back()->with('error', 'Kode promo tidak valid atau tidak ditemukan!')->withInput();
            } elseif ($promo->quota <= 0) {
                return back()->with('error', 'Mohon maaf, kuota kode promo ini sudah habis!')->withInput();
            }

            // Kurangi harga total dengan jumlah diskon
            $totalPrice = $totalPrice - $promo->discount_amount;
            $appliedPromo = $promo;
        }

        // Pastikan harga tidak minus (kalau diskon lebih besar dari harga tiket)
        if ($totalPrice < 0) {
            $totalPrice = 0;
        }

        // 4. LOGIKA BYPASS JIKA HARGA TIKET MENJADI GRATIS (Rp 0)
        if ($totalPrice == 0) {
            $transaction = Transaction::create([
                'event_id' => $event->id,
                'order_id' => $orderId,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'total_price' => 0,
                'status' => 'success', // LANGSUNG SUKSES TANPA MIDTRANS!
            ]);

            // Kurangi kapasitas tiket & tambah tiket terjual
            $event->decrement('capacity', 1);
            $event->increment('sold', 1);

            // Kurangi kuota promo jika dipakai
            if ($appliedPromo) {
                $appliedPromo->decrement('quota', 1);
            }

            // Kirim Email Tiket
            Mail::raw('Halo ' . $transaction->customer_name . ', Tiket GRATIS untuk event ' . $transaction->event->name . ' telah berhasil diklaim! Terima kasih.', function ($message) use ($transaction) {
                $message->to($transaction->customer_email)
                        ->subject('E-Ticket Anda - AmikomEventHub');
            });

            // Langsung lempar ke halaman sukses
            return redirect()->route('checkout.success', $transaction->order_id)->with('success', 'Tiket gratis berhasil diklaim!');
        }

        // 5. JIKA HARGA MASIH ADA (> Rp 0), LANJUT KE MIDTRANS SEPERTI BIASA
        $transaction = Transaction::create([
            'event_id' => $event->id,
            'order_id' => $orderId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price' => $totalPrice,
            'status' => 'Pending', 
        ]);

        // Kurangi kuota promo (sudah di-booking oleh transaksi ini)
        if ($appliedPromo) {
            $appliedPromo->decrement('quota', 1);
        }

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production'); 
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_phone,
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $transaction->update(['snap_token' => $snapToken]);
            return redirect()->route('checkout.payment', $transaction->order_id);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal terhubung ke Midtrans: ' . $e->getMessage())->withInput();
        }
    }

    public function payment($order_id)
    {
         $categories = \App\Models\Category::all();
         $transaction = Transaction::with('event')->where('order_id', $order_id)->firstOrFail();
         
         return view('checkout.payment', compact('transaction','categories'));
    }

    public function success($order_id)
    {
        $categories = \App\Models\Category::all();
        $transaction = Transaction::with('event')->where('order_id', $order_id)->firstOrFail();

        // Jika statusnya sudah success (dari bypass tiket gratis tadi), tidak perlu cek midtrans lagi
        if ($transaction->status === 'success') {
            return view('checkout.success', compact('transaction','categories'));
        }

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');

        try {
            $midtransStatus = \Midtrans\Transaction::status($order_id);
            
            if (in_array($midtransStatus->transaction_status, ['capture', 'settlement'])) {
                if ($transaction->status !== 'success') {
                    $transaction->update(['status' => 'success']);
                    $transaction->event->decrement('capacity', 1);
                    $transaction->event->increment('sold', 1);
                    
                    Mail::raw('Halo ' . $transaction->customer_name . ', Pembayaran tiket untuk event ' . $transaction->event->name . ' telah berhasil! Terima kasih.', function ($message) use ($transaction) {
                        $message->to($transaction->customer_email)
                                ->subject('E-Ticket Anda - AmikomEventHub');
                    });
                }
                return view('checkout.success', compact('transaction','categories'));
            } 
            elseif ($midtransStatus->transaction_status == 'pending') {
                return redirect()->route('checkout.payment', $order_id)->with('warning', 'Transaksi Anda berstatus PENDING.');
            } 
            else {
                $transaction->update(['status' => 'failed']);
                return redirect()->route('home')->with('error', 'Pembayaran gagal atau kadaluarsa.');
            }

        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan.');
        }
    }

    public function ticket($order_id)
    {
        $categories = \App\Models\Category::all();
        $transaction = Transaction::with('event')->where('order_id', $order_id)->firstOrFail();

        if ($transaction->status !== 'success') {
            return redirect()->route('home')->with('error', 'Tiket belum lunas.');
        }

        return view('checkout.ticket', compact('transaction', 'categories'));
    }

    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);
        if ($transaction->status === 'pending') {
            $transaction->update(['status' => 'failed']);
        }
        return redirect('/')->with('error', 'Pembayaran dibatalkan.');
    }

    // ==========================================
    // FITUR UAS: CETAK SERTIFIKAT PDF
    // ==========================================
    public function downloadCertificate($order_id)
    {
        $transaction = Transaction::with('event')->where('order_id', $order_id)->firstOrFail();

        // Pastikan tiket sudah lunas/sukses sebelum bisa download sertifikat
        if ($transaction->status !== 'success') {
            return redirect()->back()->with('error', 'Sertifikat belum tersedia karena pembayaran belum selesai.');
        }

        // Memanggil tampilan desain sertifikat
        $pdf = Pdf::loadView('certificate.pdf', compact('transaction'));
        
        // Mengatur ukuran kertas menjadi A4 Memanjang (Landscape)
        $pdf->setPaper('A4', 'landscape');

        // Mengunduh file dengan nama otomatis
        return $pdf->download('Sertifikat-' . str_replace(' ', '-', $transaction->customer_name) . '.pdf');
    }
}