@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col content">
                <p class="bonus">This Two Rooms Are The Most Popular In Nangayan</p>
                @foreach ($newRooms as $newRoom)
                    <article class="mb-2 card">
                        <div class="content-description d-flex flex-row ">
                            <section class="me-2">
                                <div class="row mb-3">
                                    <div class="col text-start">
                                        <h2>{{ $newRoom->room_type }}</h2>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-6">
                                        {!! limit_words($newRoom->room_description, 115) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img src="/storage/{{ $newRoom->photos->where('photo_type', 'room_image')->first()->photo_path }}" alt="Room Image">
                                </div>
                            </section>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
@endsection