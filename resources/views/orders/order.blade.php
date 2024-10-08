@extends('orders.partials.main')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col text-center content-rd">
                <div class="content">
                    <h1>Booking Information</h1>
                    <div class="bonus">
                        Please chose the service that you want to add
                    </div>
                    <div class="py-3 px-0 mb-3 BS" style="width: auto">
                        <div class="info">
                            @if($roomImage)
                                <img src="{{ asset('storage/' . $roomImage->photo_path) }}" alt="Room Image" height="600">
                            @else
                                <p>Foto kamar tidak tersedia.</p>
                            @endif
                            <div class="information">
                                <div class="left-info">
                                    <h2>{{ $room->room_type }}</h2>
                                    <h4>Bali, Indonesia</h4>
                                </div>
                                <div class="right-info">
                                    <h2>Rp. {{ number_format($room->room_price, 0, ',', '.') }} Per Night</h2>
                                    <h3>{{ $booking->checkin_date }} - {{ $booking->checkout_date }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="content-form">
                            <div class="form-wraper-info">
                                <h4>Name :</h4>
                                <h2>{{ $user->name }}</h2>
                            </div>
                            <div class="form-wraper-info">
                                <h4>Email :</h4>
                                <h2>{{ $user->email }}</h2>
                            </div>
                            <div class="form-wraper-info">
                                <h4>Number of Rooms :</h4>
                                <h2>{{ $booking->num_of_rooms }}</h2>
                            </div>
                            <form action="{{ route('booking_services.store', ['booking' => $booking->slug]) }}" method="POST">
                                @csrf
                                <div class="d-flex flex-column text-start form-wraper-info">
                                    <label for="service_id">Choose Service</label>
                                    <select name="service_id" id="service_id" class="my-3 fs-5">
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex flex-column text-start form-wraper-info">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" required min="1" class="my-3">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Continue</button>
                                <a href="/suites" class="btn btn-secondary w-100 mt-3">Cancel</a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection