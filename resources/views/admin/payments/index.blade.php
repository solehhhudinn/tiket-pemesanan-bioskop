@extends('layouts.admin.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Pembayaran</h2>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">User</th>
                                <th scope="col">Film</th>
                                <th scope="col">Bioskop</th>
                                <th scope="col">Jumlah Kursi</th>
                                <th scope="col">Kursi yang Dipilih</th>
                                <th scope="col">Jadwal</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Bukti Pembayaran</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                                <tr>
                                    <th scope="row">{{ $payment->id }}</th>
                                    <td>{{ $payment->user ? $payment->user->name : 'N/A' }}</td>
                                    <td>{{ $payment->movie ? $payment->movie->title : 'N/A' }}</td>
                                    <td>{{ $payment->theater ? $payment->theater->name : 'N/A' }}</td>
                                    <td>{{ $payment->seat_count ?? 'N/A' }}</td>
                                    <td>{{ is_array(json_decode($payment->selected_seats, true)) ? implode(', ', json_decode($payment->selected_seats, true)) : $payment->selected_seats }}</td>
                                    <td>
                                        @if ($payment->schedule)
                                            {{ \Carbon\Carbon::parse($payment->schedule->date)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                                            <br>
                                            {{ $payment->time }}
                                        @else
                                            Tidak tersedia
                                        @endif
                                    </td>
                                    <td>Rp. {{ number_format($payment->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentProofModal{{ $payment->id }}">Lihat</button>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $payment->status == 'Di Terima' ? 'success' : ($payment->status == 'Di Tolak' ? 'danger' : 'warning') }}">{{ $payment->status }}</span>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.payments.update', $payment->id) }}" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="action" value="accept">
                                            <input type="hidden" name="selected_seats" value="{{ $payment->selected_seats }}">
                                            <button type="submit" class="btn btn-success">{{ __('Terima') }}</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.payments.update', $payment->id) }}" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="btn btn-danger">{{ __('Tolak') }}</button>
                                        </form>
                                        <a href="{{ route('admin.payments.show', $payment->id) }}" class="btn btn-info">Detail</a>
                                    </td>
                                </tr>

                                <!-- Modal Bukti Pembayaran -->
                                <div class="modal fade" id="paymentProofModal{{ $payment->id }}" tabindex="-1" aria-labelledby="paymentProofModalLabel{{ $payment->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="paymentProofModalLabel{{ $payment->id }}">Bukti Pembayaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($payment->payment_proof)
                                                    <img src="{{ Storage::url($payment->payment_proof) }}" alt="Bukti Pembayaran" class="img-fluid">
                                                @else
                                                    <p>Bukti pembayaran tidak tersedia</p>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">Tidak ada data pembayaran</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('shown.bs.modal', function () {
                var triggerButton = document.activeElement;
                triggerButton.blur();
            });
        });

        var closeButtons = document.querySelectorAll('.modal .btn-close, .modal .btn-secondary');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                var modal = bootstrap.Modal.getInstance(this.closest('.modal'));
                modal.hide();
            });
        });
    });
</script>
@endsection