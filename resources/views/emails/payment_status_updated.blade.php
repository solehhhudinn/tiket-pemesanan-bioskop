<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pembayaran Diperbarui</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #000000; /* Set the default text color to black */
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header img {
            max-width: 100px;
        }
        .content {
            text-align: left;
            padding: 0 20px;
            color: #000000; /* Set the text color to black */
        }
        .content h1 {
            color: #333;
            font-size: 20px;
        }
        .content p {
            color: #555;
            line-height: 1.6;
        }
        .button-container {
            text-align: center;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            background-color: #555555;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ $message->embed(public_path('img/logo2.png')) }}" alt="Logo">
        </div>
        <div class="content">
            <h1>Hello {{ $userName }}!</h1>
            <p>Status pembayaran Anda telah <strong>{{ $status }}</strong>.</p>
            <div class="button-container">
                <a href="{{ $url }}" class="button">Lihat Pembayaran</a>
            </div>
            <p>Terima kasih telah menggunakan layanan kami!</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Tiket Pemesanan Bioskop</p>
        </div>
    </div>
</body>
</html>
