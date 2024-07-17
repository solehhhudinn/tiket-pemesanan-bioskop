@extends('layouts.app')

@section('title', 'Pembayaran - Cinema')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Pembayaran</h2>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p><strong>Film :</strong> {{ $movieName }}</p>
                    <p><strong>Bioskop :</strong> {{ $theaterName }}</p>
                    <p><strong>Jadwal :</strong> {{ $formattedDate }}</p>
                    <p><strong>Waktu :</strong> {{ $time }}</p>
                    <p><strong>Jumlah Kursi Yang Dipilih :</strong> {{ $quantity }}</p>
                    <p><strong>Kursi Yang Dipilih :</strong> {{ implode(', ', $seatNumbers) }}</p>
                    <p><strong>Harga :</strong> {{ $price }}</p>
                    <form method="POST" action="{{ route('payment.barcode') }}">
                        @csrf
                        @foreach ($seatNumbers as $seatNumber)
                            <input type="hidden" name="seat_numbers[]" value="{{ $seatNumber }}">
                        @endforeach
                        <input type="hidden" name="schedule_id" value="{{ $scheduleId }}">
                        <input type="hidden" name="date" value="{{ $formattedDate }}">
                        <input type="hidden" name="time" value="{{ $time }}">
                        <input type="hidden" name="quantity" value="{{ $quantity }}">
                        <input type="hidden" name="movie_name" value="{{ $movieName }}">
                        <input type="hidden" name="theater_name" value="{{ $theaterName }}">
                        <input type="hidden" name="formatted_price" value="{{ $formattedPrice }}">
                        <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
                        <button type="submit" class="btn btn-success btn-block mt-3">Lanjutkan Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
