@extends('layouts.app')

@section('title', 'Pilih Kursi - Cinema')

@section('content')
<div class="container">
    <h2 class="text-center">Pilih Kursi untuk Jadwal {{ $schedule->date }} - {{ $time }}</h2>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="screen">Screen</div>
            <div class="legend">
                <div><span class="seat-box regular"></span> Reguler</div>
                @if($hasSweetbox)
                    <div><span class="seat-box sweetbox"></span> Sweetbox</div>
                @endif
                <div><span class="seat-box unavailable"></span> Tidak Tersedia</div>
            </div>
            <div id="seatSelection" class="seat-selection"></div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('movies.tickets', ['movie' => $movieId]) }}" class="btn btn-danger mt-3">Kembali</a>
                <button type="button" class="btn btn-primary mt-3" id="confirmSeatsBtn" disabled>Konfirmasi Kursi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Peringatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="modal-body" id="alertModalBody">
                <!-- Pesan alert akan dimasukkan di sini -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
.screen {
    background-color: #d3d3d3;
    text-align: center;
    padding: 10px;
    margin-bottom: 20px;
    font-weight: bold;
}
.legend {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}
.legend div {
    margin: 0 10px;
    display: flex;
    align-items: center;
}
.legend .seat-box {
    display: inline-block;
    width: 20px;
    height: 20px;
    margin-right: 5px;
}
.seat-selection {
    display: grid;
    grid-gap: 5px;
    justify-content: center;
}
.seat-btn {
    width: 50px;
    height: 50px;
    text-align: center;
    line-height: 50px;
    cursor: pointer;
}
.selected {
    background-color: #007bff;
    color: white;
}
.regular {
    background-color: #28a745;
}
.sweetbox {
    background-color: #ffc107;
}
.unavailable {
    background-color: #e6e6e6;
    cursor: not-allowed;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const seatSelection = document.getElementById('seatSelection');
    const confirmSeatsBtn = document.getElementById('confirmSeatsBtn');
    const alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
    const alertModalBody = document.getElementById('alertModalBody');
    let selectedSeats = [];
    const maxSeats = {{ $quantity }};
    const isSweetboxAllowed = maxSeats > 1;

    function fetchSeats(scheduleId) {
        fetch(`/api/schedules/${scheduleId}/seats`)
            .then(response => response.json())
            .then(data => {
                console.log('Seats and layout fetched:', data);
                const { seats, layout } = data;

                seatSelection.style.gridTemplateColumns = `repeat(${layout.columns}, 1fr)`;
                seatSelection.innerHTML = '';

                const rows = seats.reduce((acc, seat) => {
                    const row = seat.seat_number[0].toUpperCase();
                    if (!acc[row]) acc[row] = [];
                    acc[row].push(seat);
                    return acc;
                }, {});

                const sortedRows = Object.keys(rows)
                    .filter(row => row !== 'A')
                    .sort()
                    .concat('A');

                sortedRows.forEach(row => {
                    if (rows[row]) {
                        rows[row].sort((a, b) => parseInt(a.seat_number.slice(1)) - parseInt(b.seat_number.slice(1)))
                                  .forEach(seat => renderSeat(seat));
                    }
                });
            })
            .catch(error => console.error('Error fetching seats:', error));
    }

    function renderSeat(seat) {
        const seatBtn = document.createElement('div');
        seatBtn.classList.add('seat-btn');
        seatBtn.textContent = seat.seat_number;
        seatBtn.setAttribute('data-seat-id', seat.id);
        seatBtn.setAttribute('data-seat-number', seat.seat_number);
        seatBtn.setAttribute('data-seat-type', seat.type);

        if (!seat.is_available) {
            seatBtn.classList.add('unavailable');
        } else {
            if (seat.status === 'occupied') {
                seatBtn.classList.add('occupied');
            } else {
                if (seat.type === 'sweetbox') {
                    seatBtn.classList.add('sweetbox');
                } else {
                    seatBtn.classList.add('regular');
                }
                seatBtn.addEventListener('click', function() {
                    handleSeatSelection(this);
                });
            }
        }

        seatSelection.appendChild(seatBtn);
    }

    function handleSeatSelection(seatBtn) {
        const seatId = seatBtn.getAttribute('data-seat-id');
        const seatNumber = seatBtn.getAttribute('data-seat-number');
        const seatType = seatBtn.getAttribute('data-seat-type');

        if (seatBtn.classList.contains('selected')) {
            if (seatType === 'sweetbox') {
                // Deselect sweetbox pair
                deselectSweetboxPair(seatNumber);
            } else {
                seatBtn.classList.remove('selected');
                selectedSeats = selectedSeats.filter(id => id !== seatId);
            }
        } else if (selectedSeats.length < maxSeats) {
            if (seatType === 'sweetbox' && isSweetboxAllowed) {
                // Select sweetbox pair if within limit
                const pairSeatNumber = getPairSeatNumber(seatNumber);
                if (selectedSeats.length + 2 <= maxSeats) {
                    selectSweetboxPair(seatNumber);
                } else {
                    showAlert("Anda tidak dapat memilih lebih dari jumlah tiket yang tersedia.");
                }
            } else if (seatType !== 'sweetbox') {
                seatBtn.classList.add('selected');
                selectedSeats.push(seatId);
            } else {
                showAlert("Sweetbox hanya dapat dipilih jika memesan lebih dari satu tiket.");
            }
        } else {
            showAlert("Anda tidak dapat memilih lebih dari jumlah tiket yang tersedia.");
        }

        validateSeats();
    }

    function selectSweetboxPair(seatNumber) {
        const pairSeatNumber = getPairSeatNumber(seatNumber);
        const pairSeatBtn = document.querySelector(`[data-seat-number="${pairSeatNumber}"]`);

        if (pairSeatBtn && !pairSeatBtn.classList.contains('selected')) {
            document.querySelector(`[data-seat-number="${seatNumber}"]`).classList.add('selected');
            pairSeatBtn.classList.add('selected');
            selectedSeats.push(document.querySelector(`[data-seat-number="${seatNumber}"]`).getAttribute('data-seat-id'));
            selectedSeats.push(pairSeatBtn.getAttribute('data-seat-id'));
        }
    }

    function deselectSweetboxPair(seatNumber) {
        const pairSeatNumber = getPairSeatNumber(seatNumber);   
        document.querySelector(`[data-seat-number="${seatNumber}"]`).classList.remove('selected');
        document.querySelector(`[data-seat-number="${pairSeatNumber}"]`).classList.remove('selected');

        selectedSeats = selectedSeats.filter(id => id !== document.querySelector(`[data-seat-number="${seatNumber}"]`).getAttribute('data-seat-id'));
        selectedSeats = selectedSeats.filter(id => id !== document.querySelector(`[data-seat-number="${pairSeatNumber}"]`).getAttribute('data-seat-id'));
    }

    function getPairSeatNumber(seatNumber) {
        const seatRow = seatNumber[0];
        const seatNum = parseInt(seatNumber.slice(1));
        return `${seatRow}${seatNum % 2 === 0 ? seatNum - 1 : seatNum + 1}`;
    }

    function showAlert(message) {
        alertModalBody.textContent = message;
        alertModal.show();
    }

    function validateSeats() {
        const selectedSweetboxSeats = selectedSeats.filter(id => {
            const seat = document.querySelector(`[data-seat-id="${id}"]`);
            return seat && seat.getAttribute('data-seat-type') === 'sweetbox';
        }).length;

        const selectedRegularSeats = selectedSeats.length - selectedSweetboxSeats;

        console.log('Selected Sweetbox Seats:', selectedSweetboxSeats);
        console.log('Selected Regular Seats:', selectedRegularSeats);
        console.log('Max Seats Allowed:', maxSeats);

        // Validasi jumlah kursi yang dipilih
        if (selectedSweetboxSeats % 2 === 0 && (selectedSweetboxSeats / 2) + selectedRegularSeats <= maxSeats && (selectedRegularSeats === maxSeats || (selectedSweetboxSeats / 2) * 2 + selectedRegularSeats === maxSeats)) {
            confirmSeatsBtn.disabled = false;
        } else {
            confirmSeatsBtn.disabled = true;
        }
    }

    fetchSeats({{ $schedule->id }});

    confirmSeatsBtn.addEventListener('click', function() {
        const seatsInput = document.createElement('input');
        seatsInput.type = 'hidden';
        seatsInput.name = 'seat_numbers';
        seatsInput.value = JSON.stringify(selectedSeats);

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('payment') }}';
        form.appendChild(seatsInput);

        const scheduleIdInput = document.createElement('input');
        scheduleIdInput.type = 'hidden';
        scheduleIdInput.name = 'schedule_id';
        scheduleIdInput.value = {{ $schedule->id }};
        form.appendChild(scheduleIdInput);

        const timeInput = document.createElement('input');
        timeInput.type = 'hidden';
        timeInput.name = 'time';
        timeInput.value = '{{ $time }}';
        form.appendChild(timeInput);

        const quantityInput = document.createElement('input');
        quantityInput.type = 'hidden';
        quantityInput.name = 'quantity';
        quantityInput.value = '{{ $quantity }}';
        form.appendChild(quantityInput);

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        document.body.appendChild(form);
        form.submit();
    });

    // Hide alert modal event
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
        button.addEventListener('click', () => {
            alertModal.hide();
        });
    });
});
</script>
@endsection
