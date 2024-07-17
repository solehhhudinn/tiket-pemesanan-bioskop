@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran - Cinema')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Konfirmasi Pembayaran</h2>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <p><strong>Total Harga:</strong> Rp. {{ number_format($totalPrice, 0, ',', '.') }}</p>
                    <p>Silakan scan QR Code di bawah ini untuk melakukan pembayaran.</p>
                    <img src="{{ asset('img/qris_qr_code.jpg') }}" alt="Kode QR" class="img-fluid">
                    <div class="mt-4">
                        <p>Apakah Anda Sudah Membayar?</p>
                        <button class="btn btn-success" onclick="tampilkanForm()">{{ __('Iya') }}</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmCancelModal">{{ __('Batal') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Upload Bukti Pembayaran yang Tersembunyi -->
    <div class="row justify-content-center" id="formUploadBukti" style="display: none; margin-left:260px">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-body">
                    <form id="form-barcode">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="bukti_pembayaran">{{ __('Unggah Bukti Pembayaran') }}</label>
                            <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
                        </div>
                        <input type="hidden" name="movie_id" value="{{ $movieId }}">
                        <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                        <input type="hidden" name="theater_id" value="{{ $theaterId }}">
                        <input type="hidden" name="schedule_id" value="{{ $scheduleId }}">
                        <input type="hidden" name="time" value="{{ $times }}">
                        <input type="hidden" name="seat_count" value="{{ $seatCount }}">
                        <input type="hidden" name="selected_seats" id="selected_seats" value="{{ json_encode($seatNumbers) }}">
                        <button type="submit" class="btn btn-primary">{{ __('Kirim Bukti Pembayaran') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Pembatalan -->
<div class="modal fade" id="confirmCancelModal" tabindex="-1" aria-labelledby="confirmCancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmCancelModalLabel">Konfirmasi Pembatalan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin membatalkan transaksi?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-danger" id="confirmCancelButton">Iya, Batalkan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Proses -->
<div class="modal fade" id="processModal" tabindex="-1" aria-labelledby="processModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p>{{ __('Mohon tunggu, bukti pembayaran Anda sedang diproses...') }}</p>
            </div>
        </div>
    </div>
</div>
<script>
function tampilkanForm() {
    document.getElementById('formUploadBukti').style.display = 'block';
}

function showModal() {
    var modal = new bootstrap.Modal(document.getElementById('processModal'));
    modal.show();
}

    $('#form-barcode').on('submit', function(e) {
        e.preventDefault();
        console.log("E", e);
        const token = e.currentTarget[0].value;
        const file = e.currentTarget[1].files[0];
        const movieId = e.currentTarget[2].value;
        const totalPrice = e.currentTarget[3].value;
        const theaterId = e.currentTarget[4].value;
        const scheduleId = e.currentTarget[5].value;
        const time = e.currentTarget[6].value;
        const seatCount = e.currentTarget[7].value;
        const selectedSeats = e.currentTarget[8].value;
        showModal();
        
        var formData = new FormData();
        formData.append("bukti_pembayaran", file);
        formData.append("movie_id", movieId);
        formData.append("total_price", totalPrice);
        formData.append("theater_id", theaterId);
        formData.append("schedule_id", scheduleId);
        formData.append("time", time);
        formData.append("seat_count", seatCount);
        formData.append("selected_seats", selectedSeats);
        $.ajax({
            url: "{{ route('upload.bukti.pembayaran') }}",
            type: 'POST',
            data: formData,
            headers: {
                    'X-CSRF-Token': token 
               },
                cache: false,
                contentType: false,
                processData: false,
            success: function(response) {
                alert('Bukti pembayaran berhasil diunggah. Transaksi sedang diproses.');
                window.location.href = "{{ route('home') }}";
            },
            error: function(xhr) {
                var modal = bootstrap.Modal.getInstance(document.getElementById('processModal'));
                modal.hide();
                
                var errors = xhr.responseJSON.errors;
                var errorMessage = 'Terjadi kesalahan. ';
                for (var key in errors) {
                    errorMessage += errors[key][0] + ' ';
                }
                alert(errorMessage);
            }
        });
    });

    $('#confirmCancelButton').on('click', function() {
        window.location.href = "{{ route('home') }}";
    });
</script>
@endsection
