@extends('layouts.app')

@section('title', 'Pilih Tiket - Cinema')

@section('content')
<div class="container">
    <h2 class="text-center">Pilih Tiket untuk {{ $movie->title }}</h2>
    <hr>
    <div class="row">
        <div class="col-md-4 text-center">
            <img src="{{ asset('storage/' . $movie->poster) }}" class="img-fluid movie-poster" alt="{{ $movie->title }}" style="width: 100%; max-width: 300px;">
        </div>
        <div class="col-md-8">
            <div class="movie-trailer mt-2">
                <iframe src="{{ $movie->trailer_url }}" class="w-100" style="height: 440px; border-radius:10px" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
            <h3 class="text-uppercase font-weight-bold">{{ $movie->title }}</h3>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Sutradara:</strong> {{ $movie->director ?? 'N/A' }}</p>
                    <p><strong>Pemeran:</strong> {{ $movie->starring ?? 'N/A' }}</p>
                    <p><strong>Klasifikasi Usia:</strong> {{ $movie->censor_rating ?? 'N/A' }}</p>
                    <p><strong>Genre:</strong> {{ $movie->genre ?? 'N/A' }}</p>
                    <p><strong>Bahasa:</strong> {{ $movie->language ?? 'N/A' }}</p>
                    <p><strong>Subtitle:</strong> {{ $movie->subtitle ?? 'N/A' }}</p>
                    <p><strong>Durasi:</strong> {{ $movie->duration ?? 'N/A' }} Menit</p>
                </div>
                <div class="col-md-8">
                    <p>{{ $movie->description }}</p>
                </div>
            </div>
            <hr>
            <h3 class="text-uppercase font-weight-bold">Jadwal</h3>
            <hr>
            <div class="d-flex justify-content-center mb-4" id="dateSelection">
                <button class="btn btn-light mx-1 date-nav" data-nav="-1">&lt; Sebelumnya</button>
                <!-- Date buttons will be inserted here -->
                <button class="btn btn-light mx-1 date-nav" data-nav="1">Berikutnya &gt;</button>
            </div>
            <div class="row">
                <div class="col-md-12" id="scheduleContainer">
                    @if ($movie->schedules->isEmpty())
                        <p class="text-center">Tidak ada jadwal yang tersedia untuk film ini.</p>
                    @else
                        <!-- Initial schedule rows will be dynamically displayed here -->
                    @endif
                </div>
            </div>
            <a href="/" class="btn btn-danger mt-3 d-flex justify-content-center">Kembali</a>
        </div>
    </div>
</div>

<!-- Modal Pilih Tiket -->
<div class="modal fade" id="selectTicketsModal" tabindex="-1" role="dialog" aria-labelledby="selectTicketsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectTicketsModalLabel">Pilih Tiket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tickets.seatSelection', ['id' => $theater->id ]) }}" method="GET" id="selectTicketsForm">
                    @csrf
                    <div class="form-group">
                        <label for="tickets">Pilih Jumlah Tiket:</label>
                        <select class="form-select" id="tickets" name="quantity">
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <input type="hidden" id="selected_schedule_id" name="schedule_id">
                    <input type="hidden" id="selected_time" name="time">
                    <button type="button" class="btn btn-primary" id="continueBtn">Lanjutkan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded and parsed');
        const selectTicketsModal = new bootstrap.Modal(document.getElementById('selectTicketsModal'));
        const selectedScheduleIdInput = document.getElementById('selected_schedule_id');
        const selectedTimeInput = document.getElementById('selected_time');
        const selectTicketsForm = document.getElementById('selectTicketsForm');
        const continueBtn = document.getElementById('continueBtn');
        const scheduleContainer = document.getElementById('scheduleContainer');
        const dateSelection = document.getElementById('dateSelection');
        const schedules = @json($schedules);
        let currentDate = new Date();

        // Function to format date to "DD MMM"
        function formatDate(date) {
            const options = { weekday: 'long', day:'2-digit' , month: 'short', year : 'numeric' };
            return date.toLocaleDateString('id-ID', options);
        }

        // Function to add days to a date
        function addDays(date, days) {
            const result = new Date(date);
            result.setDate(result.getDate() + days);
            return result;
        }

        // Function to render schedules based on selected date
        function renderSchedules(selectedDate) {
            scheduleContainer.innerHTML = '';
            let schedulesFound = false;

            const today = new Date();
            today.setHours(0, 0, 0, 0);

            schedules.forEach(schedule => {
                const startDate = new Date(schedule.start_date);
                const endDate = new Date(schedule.end_date);

                const selectedDateObj = new Date(selectedDate);

                if (selectedDateObj >= startDate && selectedDateObj <= endDate && selectedDateObj >= today) {
                    schedulesFound = true;
                    // Cek jika `schedule.times` adalah array yang valid
                    const times = Array.isArray(schedule.times) ? schedule.times : [];

                    const scheduleHTML = `
                        <div class="row mb-3 schedule-row" data-schedule-date="${schedule.start_date}">
                            <div class="col-md-3">
                                <p><strong>Bioskop:</strong> ${schedule.theater ? schedule.theater.name : 'N/A'}</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Tanggal:</strong> ${formatDate(new Date(schedule.start_date))}</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Harga:</strong> Rp ${new Intl.NumberFormat('id-ID').format(schedule.theater ? schedule.theater.price : 0)}</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Jam:</strong></p>
                                <div class="d-flex flex-wrap">
                                    ${times.map(time => `
                                        <button class="btn btn-primary select-time-btn m-1" data-time="${time.time}" data-schedule-id="${schedule.id}">${time.time}</button>
                                    `).join('')}
                                </div>
                            </div>
                        </div>
                    `;
                    scheduleContainer.insertAdjacentHTML('beforeend', scheduleHTML);
                }
            });

            if (!schedulesFound) {
                scheduleContainer.innerHTML = '<p class="text-center">Tidak ada jadwal yang tersedia untuk tanggal ini.</p>';
            }

            attachSelectTimeButtonListeners();
        }

        // Function to generate date navigation
        function generateDateNavigation(currentDate) {
            dateSelection.innerHTML = `
                <button class="btn btn-light mx-1 date-nav" data-nav="-1">&lt; Sebelumnya</button>
            `;
            for (let i = -3; i <= 3; i++) {
                const date = addDays(currentDate, i);
                const dateButton = document.createElement('button');
                dateButton.classList.add('btn', 'btn-light', 'mx-1', 'date-btn');
                dateButton.textContent = formatDate(date);
                dateButton.setAttribute('data-date', date.toISOString().split('T')[0]);
                if (i === 0) {
                    dateButton.classList.add('active');
                }
                dateSelection.appendChild(dateButton);
            }
            dateSelection.innerHTML += `
                <button class="btn btn-light mx-1 date-nav" data-nav="1">Berikutnya &gt;</button>
            `;
        }

        // Initial date navigation
        generateDateNavigation(currentDate);

        // Event listener for date navigation buttons
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('date-nav')) {
                const nav = parseInt(event.target.getAttribute('data-nav'));
                currentDate = addDays(currentDate, nav * 7); // Navigate by weeks
                generateDateNavigation(currentDate);
                renderSchedules(currentDate.toISOString().split('T')[0]);
            }
        });

        // Event listener for date button clicks
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('date-btn')) {
                document.querySelectorAll('.date-btn').forEach(btn => btn.classList.remove('active'));
                event.target.classList.add('active');
                const selectedDate = event.target.getAttribute('data-date');
                renderSchedules(selectedDate);
            }
        });

        // Function to attach event listeners to select time buttons
        function attachSelectTimeButtonListeners() {
            document.querySelectorAll('.select-time-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const scheduleId = btn.getAttribute('data-schedule-id');
                    const time = btn.getAttribute('data-time');
                    selectedScheduleIdInput.value = scheduleId;
                    selectedTimeInput.value = time;
                    selectTicketsModal.show();
                });
            });
        }

        // Initial render for the current date
        renderSchedules(currentDate.toISOString().split('T')[0]);

        // Continue button event listener
        continueBtn.addEventListener('click', function() {
            selectTicketsForm.submit();
        });
    });
</script>

@endsection
