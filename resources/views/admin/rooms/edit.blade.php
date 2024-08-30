@extends('admin.partials.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit {{ $room->room_type }}</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8 px-0">
            <form action="{{ route('rooms.update', $room->slug) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="room_type">Room Type</label>
                    <input type="text" class="form-control" id="room_type" name="room_type" value="{{ old('room_type', $room->room_type) }}" required>
                    @error('room_type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="room_description" class="form-label">Room Description</label>
                    @error('room_description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="room_description" type="hidden" name="room_description" value="{{ old('room_description', $room->room_description) }}">
                    <trix-editor input="room_description"></trix-editor>
                </div>
                <div class="mb-3">
                    <label for="room_price" class="form-label">Room Price</label>
                    <input type="text" inputmode="numeric" class="form-control" id="room_price" name="room_price" value="{{ old('room_price', $room->room_price) }}">
                    @error('room_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>                
                <div class="mb-3">
                    <label for="room_image" class="form-label">Room Image</label>
                    <input type="hidden" name="oldRoomImage" value="{{ $room->photos->where('photo_type', 'room_image')->first()->photo_path }}">
                    <img src="/storage/{{ $room->photos->where('photo_type', 'room_image')->first()->photo_path }}" alt="Room Image" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    <input class="form-control" type="file" id="room_image" name="room_image" onchange="previewImage()">
                    @error('room_image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="bathroom_image" class="form-label">Bathroom Image</label>
                    <input type="hidden" name="oldBathroomImage" value="{{ $room->photos->where('photo_type', 'bathroom_image')->first()->photo_path }}">
                    <img src="/storage/{{ $room->photos->where('photo_type', 'bathroom_image')->first()->photo_path }}" alt="Bathroom Image" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    <input class="form-control" type="file" id="bathroom_image" name="bathroom_image" onchange="previewImage()">
                    @error('bathroom_image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="extra_image" class="form-label">Extra Image</label>
                    <input type="hidden" name="oldExtraImage" value="{{ $room->photos->where('photo_type', 'extra_image')->first()->photo_path }}">
                    <img src="/storage/{{ $room->photos->where('photo_type', 'extra_image')->first()->photo_path }}" alt="Extra Image" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    <input class="form-control" type="file" id="extra_image" name="extra_image" onchange="previewImage()">
                    @error('extra_image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Room</button>
            </form>
        </div>
    </div>
</div>

@endsection

<script>
    function previewImage() {
    const imageInput = document.querySelectorAll('input[type="file"]');
    imageInput.forEach(input => {
        const imgPreview = input.closest('.mb-3').querySelector('.img-preview');
        if (imgPreview && input.files && input.files[0]) {
            const oFReader = new FileReader();
            oFReader.readAsDataURL(input.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            };
        }
    });
}
</script>
