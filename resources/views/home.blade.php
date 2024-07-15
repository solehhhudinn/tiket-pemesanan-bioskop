@extends('layouts.app')

@section('title', 'Home - Cinema')

@section('content')

<div class="container">
    <!-- Carousel Section -->
    <div class="row mb-4">
        <div class="col">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="2000">
                <div class="carousel-inner">
                    @foreach ($iklans as $index => $iklan)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $iklan->iklan) }}" class="d-block w-100" alt="{{ $iklan->title }}" style="height: 400px; object-fit: fill;">
                        </div>
                    @endforeach
                </div>
                
                <a class="carousel-control-prev custom-carousel-control" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="custom-carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next custom-carousel-control" href="#carouselExampleCaptions" role="button" data-slide="next" style="left: 1000px;">
                    <span class="custom-carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Movie Selection Section -->
    <h3 class="mb-3 text-center movie-selection-header">
        <span class="line"></span>
        <span class="title">MOVIE SELECTION</span>
        <span class="line"></span>
    </h3>
    <div id="movieCarousel" class="carousel slide" data-interval="false">
        <div class="carousel-inner">
            @foreach ($movies->chunk(4) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row">
                        @foreach ($chunk as $movie)
                            <div class="col-md-3 mb-4">
                                <div class="card position-relative movie-card" style="height: 400px;">
                                    <img src="{{ asset('storage/' . $movie->poster) }}" class="card-img-top" alt="{{ $movie->title }}" style="height: 400px; object-fit: fill;">
                                    <div class="position-absolute badge badge-danger badge-large" style="top: 10px; left: 10px;">{{ $loop->parent->index * 4 + $loop->index + 1 }}</div>
                                    <div class="position-absolute badge badge-light badge-large" style="top: 10px; right: 10px;">{{ $movie->censor_rating }}</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $movie->title }}</h5>
                                        <p class="card-text">{{ \Illuminate\Support\Str::limit($movie->description, 100) }}</p>
                                    </div>
                                    <div class="overlay">
                                        <button class="btn btn-secondary transparent-btn watch-trailer" data-toggle="modal" data-target="#trailerModal" data-trailer-url="{{ $movie->trailer_url }}">Watch Trailer</button>
                                        <a href="{{ route('movies.tickets', $movie->id) }}" class="btn btn-danger">Get Tickets</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev change-carousel-control" href="#movieCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url('{{ asset('img/prev2.png') }}'); background-size: 50px; width: 100px; height: 100px;"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#movieCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: url('{{ asset('img/next2.png') }}'); background-size: 50px; width: 100px; height: 100px;"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<!-- Trailer Modal -->
<div class="modal fade" id="trailerModal" tabindex="-1" role="dialog" aria-labelledby="trailerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding:15">
                <h5 class="modal-title" id="trailerModalLabel" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">Movie Trailer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" id="trailerVideo" src="" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#trailerModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var trailerUrl = button.data('trailer-url'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('.modal-body iframe').attr('src', trailerUrl);
        });

        $('#trailerModal').on('hide.bs.modal', function () {
            var modal = $(this);
            modal.find('.modal-body iframe').attr('src', '');
        });

        // Show/hide carousel controls on hover
        $('.carousel').hover(
            function() {
                $(this).find('.carousel-control-prev, .carousel-control-next').fadeIn();
            },
            function() {
                $(this).find('.carousel-control-prev, .carousel-control-next').fadeOut();
            }
        );
    });
</script>
@endpush
