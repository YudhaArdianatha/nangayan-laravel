@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col text-center content" >
                <h1>Rooms and Rates</h1>
                <p class="bonus">Each of our bright, light-flooded rooms come with everything you could possibly need for a comfortable stay. And yes, comfort isn't our only objective, we also value good design, sleek contemporary furnishing complemented by the rich tones of nature's palette as visible from our room's sea-view windows and terraces.</p>
            </div>
        </div>
        <div class="row mt-3">
            @foreach ($rooms as $room)
            <div class="col-lg-6 mb-4">
                <div class="card room">
                    <img src="/storage/{{ $room->photos->where('photo_type', 'room_image')->first()->photo_path }}" class="card-img-top" alt="{{ $room->room_type }}">
                    <div class="card-body p-0">
                      <h2 class="card-title">{{ $room->room_type }}</h2>
                      <div class="room-button">
                          <a href="/suites/{{ $room->slug }}" class="btn mt-2">Rp. {{ number_format($room->room_price, 0, ',', '.') }}</a>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection