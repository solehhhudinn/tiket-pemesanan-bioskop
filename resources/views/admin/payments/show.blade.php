@extends('layouts.admin.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Detail Pembayaran</h2>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <h5>ID: {{ $payment->id }}</h5>
                    <p>User: {{ optional($payment->user)->name ?? 'N/A' }}</p>
                    <p>Film: {{ optional($payment->movie)->title ?? 'N/A' }}</p>
                    <p>Bioskop: {{ optional($payment->theater)->name ?? 'N/A' }}</p>
                    <p>Jumlah Kursi: {{ $payment->seat_count ?? 'N/A' }}</p>
                    <p>Kursi yang Dipilih: 
                        @if(is_array(json_decode($payment->selected_seats, true)))
                            {{ implode(', ', json_decode($payment->selected_seats, true)) }}
                        @else
                            {{ $payment->selected_seats }}
                        @endif
                    </p>
                    <p>Jadwal: 
                        @if ($payment->schedule)
                            {{ \Carbon\Carbon::parse($payment->schedule->date)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                            <br>
                            {{ $payment->time }}
                        @else
                            Tidak tersedia
                        @endif
                    </p>
                    <p>Total Harga: Rp. {{ number_format($payment->total_price, 0, ',', '.') }}</p>
                    <p>Status: 
                        <span class="badge bg-{{ $payment->status == 'Di Terima' ? 'success' : ($payment->status == 'Di Tolak' ? 'danger' : 'warning') }}">
                            {{ $payment->status }}
                        </span>
                    </p>
                    <p>Bukti Pembayaran: 
                        <br>
                        @if ($payment->payment_proof)
                            <img src="{{ Storage::url($payment->payment_proof) }}" alt="Bukti Pembayaran" class="img-fluid">
                        @else
                            Bukti pembayaran tidak tersedia
                        @endif
                    </p>
                </div>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection