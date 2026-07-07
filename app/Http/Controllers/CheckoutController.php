<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        if ($event->capacity <= 0) {
            return back()->with('error', 'Mohon maaf, tiket habis!')->withInput();
        }

        $orderId = 'TRX-' . time() . '-' . Str::random(5);
        $totalPrice = $event->price + 5000; 

        $transaction = Transaction::create([
            'event_id' => $event->id,
            'order_id' => $orderId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price' => $totalPrice,
            'status' => 'Pending', 
        ]);

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

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');

        try {
            $midtransStatus = \Midtrans\Transaction::status($order_id);
            
            // KONDISI 1: JIKA BENAR-BENAR LUNAS (Berhasil)
            if (in_array($midtransStatus->transaction_status, ['capture', 'settlement'])) {
                if ($transaction->status !== 'success') {
                    $transaction->update(['status' => 'success']);
                    $transaction->event->decrement('capacity', 1);
                    $transaction->event->increment('sold', 1);
                }
                return view('checkout.success', compact('transaction','categories'));
            } 
            // KONDISI 2: JIKA MASIH PENDING (Baru dapat nomor VA tapi di-close)
            elseif ($midtransStatus->transaction_status == 'pending') {
                return redirect()->route('checkout.payment', $order_id)->with('warning', 'Transaksi Anda berstatus PENDING. Silakan selesaikan transfer melalui Virtual Account yang Anda pilih.');
            } 
            // KONDISI 3: JIKA GAGAL / EXPIRED
            else {
                $transaction->update(['status' => 'failed']);
                return redirect()->route('home')->with('error', 'Pembayaran gagal atau telah kadaluarsa.');
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
            return redirect()->route('home')->with('error', 'Tiket Anda belum lunas atau dibatalkan.');
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
}