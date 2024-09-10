@extends('orders.partials.main')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col text-center content-rd">
            <div class="content">
                    <h1>Payment</h1>
                    <div class="bonus">
                        Kindly follow the instructions below
                    </div>
                    <div class="BS" style="width: auto">
                        <div class="info">
                            <div class="information">
                                <div class="sub-total">
                                    <div class="payment">
                                        <h4>Room Type :</h4>
                                        <h2>: {{ $booking->room->room_type }}</h2>
                                    </div>
                                    <div class="payment">
                                        <h4>Total Room Price :</h4>
                                        <h2>: Rp. {{ number_format($totalRoomPrice, 0, ',', '.') }}</h2>
                                    </div>
                                    {{-- <div class="payment">
                                        <h4>Service Type</h4>
                                        <h2>: {{ $booking->service->service_name }}</h2>
                                    </div> --}}
                                    <div class="payment">
                                        <h4>Total Service Price</h4>
                                        <h2>: Rp. {{ number_format($totalServicePrice, 0, ',', '.') }}</h2>
                                    </div>
                                    <div class="payment">
                                        <h4>Check-In Date</h4>
                                        <h2>: {{ $booking->checkin_date }}</h2>
                                    </div>
                                    <div class="payment">
                                        <h4>Check-Out Date</h4>
                                        <h2>: {{ $booking->checkout_date }}</h2>
                                    </div>
                                    <div class="payment">
                                        <h4>Number of Rooms</h4>
                                        <h2>: {{ $numOfRooms }}</h2>
                                    </div>
                                    <div class="payment">
                                        <h4>Number of Nights</h4>
                                        <h2>: {{ $numOfNights }}</h2>
                                    </div>
                                    <div class="payment">
                                        <h4>Total Amount</h4>
                                        <h2>: Rp. {{ number_format($totalAmount, 0, ',', '.') }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="code">
                            <h3>Payment Method</h3>
                            <h4>To complete your transaction, please use the following payment method</h4>
                            <button id="pay-button" class="btn btn-primary my-3" >
                                Payment Method
                            </button>
                            <h4>Remember that the deadline for finalizing your order is within 1 day from
                                the initial order placement. Additionally, make sure to review the details 
                                of the product or service you’ve ordered to ensure it meets 
                                your expectations.</h4>
                        </div>
                    </div>
                    <div id="snap-container"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ config('midtrans.client_key') }}">
</script>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
            alert("payment success!"); console.log(result);
            window.location.href = '/status';
            },
            onPending: function (result) {
            alert("waiting for your payment!"); console.log(result);
            },
            onError: function (result) {
            alert("payment failed!"); console.log(result);
            },
            onClose: function () {
            alert('you closed the popup without finishing the payment');
            }
        });
    });
</script>
@endsection
