@extends('layouts.app')

@section('title', 'Receipt')

@section('content')
<div class="container ">
    <h2 class="text-center">Receipt</h2>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-light">
                    <h4>Detail Pembayaran</h4>
                </div>
                <div class="card-body">
                    <p><strong>ID Pembayaran:</strong> {{ $payment->id }}</p>
                    <p><strong>Nama Pengguna:</strong> {{ optional($payment->user)->name ?? 'N/A' }}</p>
                    <p><strong>Film:</strong> {{ optional($payment->movie)->title ?? 'N/A' }}</p>
                    <p><strong>Bioskop:</strong> {{ optional($payment->theater)->name ?? 'N/A' }}</p>

                    @php
                        $selectedSeats = json_decode($payment->selected_seats, true);
                        $seatCount = is_array($selectedSeats) ? count($selectedSeats) : 'N/A';
                    @endphp

                    <p><strong>Jumlah Kursi yang Dipilih:</strong> {{ $seatCount }}</p>
                    <p><strong>Kursi yang Dipilih:</strong> {{ is_array($selectedSeats) ? implode(', ', $selectedSeats) : 'N/A' }}</p>
                    <p><strong>Jadwal Jam Tayang:</strong>                                         
                        @if ($payment->schedule)
                            {{ $payment->time }},
                            {{ \Carbon\Carbon::parse($payment->schedule->date)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                        @else
                            Tidak tersedia
                        @endif
                    </p>
                    <p><strong>Total Harga:</strong> Rp. {{ number_format($payment->total_price, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong> <span class="badge badge-success">{{ $payment->status }}</span></p>
                    @if ($payment->payment_proof)
                        <p><strong>Bukti Pembayaran:</strong></p>
                        <div class="text-center">
                            <img src="{{ Storage::url($payment->payment_proof) }}" alt="Bukti Pembayaran" class="img-fluid rounded shadow-sm">
                        </div>
                    @else
                        <p>Bukti pembayaran tidak tersedia</p>
                    @endif
                </div>
                <div class="card-footer text-center bg-light">
                    <button class="btn btn-primary no-print" onclick="window.print()">Print Receipt</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
    }
    .card-header, .card-footer {
        background-color: #f8f9fa;
    }
    .card-body p {
        font-size: 18px; /* Increase font size */
        margin-bottom: 10px;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    @media print {
        .no-print {
            display: none;
        }
        body {
            visibility: hidden;
        }
        .container {
            visibility: visible;
            margin-top: 280px;
            width: 100%;
            max-width: none;
            padding: 0;
        }
        .card, .card-header, .card-body {
            border: none;
            box-shadow: none;
        }
        .card-header {
            background-color: white;
        }
    }
</style>
@endsection
