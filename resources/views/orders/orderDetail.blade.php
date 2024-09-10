@extends('orders.partials.main')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col text-center content-rd">
                <h1>{{ $room->room_type }}</h1>
                <div class="ket">
                    Bali, Indonesia
                    <div class="picture justify-content-center">
                        <div class="row">
                            <div class="col-lg-8 px-0">
                                <div class="room_img_left">
                                    <img src="/storage/{{ $room->photos->where('photo_type', 'room_image')->first()->photo_path }}" alt="{{ $room->room_type }}" height="600">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="room_img_right">
                                    <div class="room_img mb-3">
                                        <img src="/storage/{{ $room->photos->where('photo_type', 'bathroom_image')->first()->photo_path }}" alt="{{ $room->room_type }}" height="290">
                                    </div>
                                    <div class="room_img">
                                        <img src="/storage/{{ $room->photos->where('photo_type', 'extra_image')->first()->photo_path }}" alt="{{ $room->room_type }}" height="290">
                                    </div>
                                </div>
                            </div>
                            <div class="frame">
                                <div class="row">
                                    <div class="col-lg-6 px-1">
                                        <div class="desc text-md-start p-0 mt-2">
                                            <h4>{{ $room->room_type }}</h4>
                                        </div>
                                        <div class="detail text-md-start">
                                            <p>{!! $room->room_description !!}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="date">
                                            <h4 class="fw-bold px-3">Start Booking</h4>
                                            <h3 class="mx-0 mt-2 mb-0 fw-bold px-3" style="color: #e0b973;">Rp. {{ number_format($room->room_price, 0, ',', '.') }} Per Night</h3>
                                            <form action="{{ route('bookings.store', $room) }}" method="POST">
                                                @csrf
                                                <label for="checkin_date" class="form-label mb-0">Pick a Check In Date</label>
                                                <input type="date" class="form-control @error ('checkin_date') is-invalid @enderror" id="checkin_date" name="checkin_date" required>
                                                @error('checkin_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <label for="checkout_date" class="form-label mb-0">Pick a Check Out Date</label>
                                                <input type="date" class="form-control @error ('checkout_date') is-invalid @enderror" id="checkout_date" name="checkout_date" required>
                                                @error('checkout_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <label for="num_of_rooms" class="form-label mb-0">Number of Rooms to Book</label>
                                                <input type="number" inputmode="numeric" class="form-control @error ('num_of_rooms') is-invalid @enderror" id="num_of_rooms" name="num_of_rooms" min="1" required>
                                                @error('num_of_rooms')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                @if(session('num_of_rooms'))
                                                    <div class="alert alert-danger mt-3">
                                                        {{ session('num_of_rooms') }}
                                                    </div>
                                                @endif


                                                <button type="submit" class="btn btn-primary mt-3">Book Now</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection