<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat - {{ $transaction->customer_name }}</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            text-align: center;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .certificate-container {
            border: 10px solid #4f46e5; /* Warna bingkai disamakan dengan warna utama AmikomEventHub */
            padding: 50px;
            margin: 20px;
            height: 520px;
            position: relative;
        }
        .header {
            font-size: 45px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 4px;
        }
        .sub-header {
            font-size: 22px;
            color: #64748b;
            margin-bottom: 40px;
            letter-spacing: 2px;
        }
        .presented-to {
            font-size: 20px;
            color: #475569;
            margin-bottom: 15px;
        }
        .name {
            font-size: 55px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        .reason {
            font-size: 20px;
            color: #475569;
            margin-bottom: 15px;
        }
        .event-title {
            font-size: 35px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 40px;
        }
        .footer {
            position: absolute;
            bottom: 40px;
            width: 100%;
            left: 0;
            text-align: center;
        }
        .date {
            font-size: 18px;
            color: #64748b;
            margin-bottom: 40px;
        }
        .signature-line {
            border-top: 2px solid #cbd5e1;
            width: 250px;
            margin: 0 auto;
            padding-top: 10px;
        }
        .signature-text {
            font-size: 18px;
            font-weight: bold;
            color: #1e293b;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="header">Certificate of Participation</div>
        <div class="sub-header">AMIKOM EVENT HUB</div>
        
        <div class="presented-to">Sertifikat ini diberikan dengan bangga kepada:</div>
        
        <!-- NAMA PEMBELI AKAN MUNCUL OTOMATIS DI SINI -->
        <div class="name">{{ strtoupper($transaction->customer_name) }}</div>
        
        <div class="reason">Atas partisipasi dan kehadirannya dalam acara:</div>
        
        <!-- NAMA EVENT AKAN MUNCUL OTOMATIS DI SINI -->
        <div class="event-title">"{{ strtoupper($transaction->event->name) }}"</div>
        
        <div class="footer">
            <div class="date">Diselenggarakan pada tanggal {{ date('d F Y', strtotime($transaction->event->date)) }}</div>
            
            <div class="signature-line">
                <div class="signature-text">Penyelenggara Acara</div>
            </div>
        </div>
    </div>
</body>
</html>