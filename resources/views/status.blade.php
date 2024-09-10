@extends('orders.partials.main')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col text-center content-rd">
            <div class="content">
                    <h1>Booking Status</h1>
                    <div class="bonus">
                        You can see your booking status below
                    </div>
                    <div class="BS" style="width: auto">
                        <div class="p-3">
                            <div class="bg-container">
                                <img src="/storage/{{ $booking->room->photos->where('photo_type', 'room_image')->first()->photo_path }}" alt="">
                            </div>
                            <div class="status-kamar">
                                <h2>{{ $booking->room->room_type }}</h2>
                            </div>
                            <h4>Bali, Indonesia</h4>
                        </div>
                        <form class="content-form d-flex gap-2 text-start">
                            <div class="form-group">
                                <div class="form-wrapper">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" disabled>
                                </div>
                                <div class="form-wrapper">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="{{ $user->email }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-wrapper">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="name" value="{{ $user->phone_number }}" disabled>
                                </div>
                                <div class="form-wrapper">
                                    <label for="">Services</label>
                                    <input type="text" name="email" value="{{ $bookingService->service->service_name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-wrapper">
                                    <label for="">Check-in Date</label>
                                    <input type="text" name="name" value="{{ $booking->checkin_date }}" disabled>
                                </div>
                                <div class="form-wrapper">
                                    <label for="">Check-out Date</label>
                                    <input type="text" name="email" value="{{ $booking->checkout_date }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-wrapper">
                                    <label for="">Number of Rooms</label>
                                    <input type="text" name="name" value="{{ $booking->num_of_rooms }}" disabled>
                                </div>
                                <div class="form-wrapper">
                                    <label for="">Rooms Number</label>
                                    <input type="text" name="email" value="@foreach ($booking->roomNumbers as $roomNumber) {{ $roomNumber->room_number }} @endforeach" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-wrapper">
                                    <label for="">Total Payment</label>
                                    <input type="text" name="name" value=" Rp. {{ number_format($booking->total_payment, 0, ',', '.') }}" disabled>
                                </div>
                                <div class="form-wrapper">
                                    <label for="">Payment Status</label>
                                    <input type="text" name="email" value="{{ $booking->status }}" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

