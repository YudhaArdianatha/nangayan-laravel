@extends('admin.partials.main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $room->room_type }}</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-9 p-2">
            <a href="/rooms" class="btn btn-success"><i class="bi bi-arrow-left"></i>Back to all rooms</a>
            <a href="/rooms/{{ $room->slug }}/edit" class="btn btn-warning"><i class="bi bi-pencil-square"></i>Edit</a>
            <form action="/rooms/{{ $room->slug }}" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i>Delete</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 p-2 ">
            <h5 class="mb-1">Room Image</h5>
            <img src="/storage/{{ $room->photos->where('photo_type', 'room_image')->first()->photo_path }}" alt="{{ $room->room_type }}" class="img-fluid mx-0">
        </div>
        <div class="col-md-3 p-2">
            <h5 class="mb-1">Bathroom Image</h5>
            <img src="/storage/{{ $room->photos->where('photo_type', 'bathroom_image')->first()->photo_path }}" alt="{{ $room->room_type }}" class="img-fluid mx-0">
        </div>
        <div class="col-md-3 p-2">
            <h5 class="mb-1">Extra Image</h5>
            <img src="/storage/{{ $room->photos->where('photo_type', 'extra_image')->first()->photo_path }}" alt="{{ $room->room_type }}" class="img-fluid mx-0">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-9">
            <h5>Description</h5>
            <p class="mb-1">{!! $room->room_description !!}</p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-9">
            <h5>Price</h5>
            <h6 class="mb-1">Rp. {{ number_format($room->room_price, 0, ',', '.') }}</h6>
        </div>
    </div>
</div>



@endsection