@extends('orders.partials.main')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center align-items-center mb-5">
            <h1 class="text-center">Term And Condition</h1>
            <div class="col content-rd">
                <h4>Welcome to NangAyan Hotel. By accessing and using our website and services,
                    you agree to the following terms and conditions.
                    Please read them carefully before making a reservation.</h4>
                <ol>
                    <li>General Information</li>
                    <p>NangAyan Hotel, owned by NangAyan Group, is located at Jl. Sumandang VI. No 10, Ubud.
                        We offer a range of accommodations and services to ensure a comfortable and enjoyable
                        stay for our guests.</p>
                    <li>User Registration</li>
                    <p>To make a reservation, guests must create an account on our website. During registration, you are required to provide accurate and complete information, including:</p>
                    <ul>
                        <li>Full Name</li>
                        <li>Email Address</li>
                        <li>Password (must be at least 8 characters and include uppercase letters,
                            lowercase letters, numbers, and an underscore)
                        </li>
                        <li>Gender</li>
                        <li>Phone Number (must consist of at least 10 digits)</li>
                    </ul>
                    <p>If you do not meet these requirements, you will be prompted to correct the information.
                        Upon successful registration, you will receive a confirmation email, and you can log in to
                        proceed with your reservation.</p>
                    <li>Login</li>
                    <p>Registered users can log in using their email address and password.</p>
                    <li>Home Page</li>
                    <p>The home page displays various room types available at NangAyan Hotel along with their nightly rates.
                        Users can click on the rates to start the booking process.</p>
                    <li>Booking Order</li>
                    <ul>
                        <li>Room Details</li>
                        <p>Users can view detailed photos and descriptions of rooms, including beds, bathrooms, and balconies.
                            You can select the check-in and check-out dates and click "Continue to Book" to proceed.</p>
                        <li>Room Booking 1</li>
                        <p> This page allows users to select the number of rooms and any additional services such as extra beds or breakfast. Once completed, click "Continue to Book" to proceed to payment.</p>
                        <li>Room Booking 2</li>
                        <p>Users will see a summary of their booking and total amount payable. Payment can be made via bank transfer or through a payment gateway. For bank transfers, provide proof of payment to the admin via phone. For payment gateway transactions, follow the prompts to complete payment. Payments must be completed within the specified time frame.</p>
                        <li>Room Booking 3</li>
                        <p>This page confirms the completion of your booking and payment. If you paid via bank transfer, wait for admin validation. Payments made via the payment gateway will be automatically validated. Click "Back to Home" to return to the homepage or check your booking status.</p>
                    </ul>
                    <li>Booking Status</li>
                    <p>You can view the status of your booking, including account information, additional services, reservation dates, pricing, and payment status.</p>
                    <li>Cancellations and Modifications</li>
                    <ul>
                        <li>Cancellations</li>
                        <p>ancellations are subject to our cancellation policy. Please contact customer service for details.</p>
                        <li>Modifications</li>
                        <p>Modifications to bookings are subject to availability and may incur additional charges. Contact our customer service team for assistance with modifications.</p>
                    </ul>
                    <li>Liability</li>
                    <p>NangAyan Hotel is not responsible for any loss or damage resulting from the use of our website or services. We make every effort to ensure the accuracy of information, but we are not liable for any errors or omissions.</p>
                    <li>Privicy Policy</li>
                    <p>We value your privacy. Personal information collected during the reservation process is used solely for booking purposes and is not shared with third parties, except as required by law.</p>
                    <li>Contact Us</li>
                    NangAyan Hotel <br>
                    Jl. Sumandang VI. No 10 <br>
                    Ubud <br>
                    Phone: +62-812-345-6789 <br>
                    Email: nangayan_hotel@gmail.com
                </ol>
            </div>
        </div>
    </div>
@endsection