@extends('admin.partials.main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create Room</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8 px-0">
            <form action="{{ route('rooms.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="room_type">Room Type</label>
                    <input type="text" class="form-control" id="room_type" name="room_type" value="{{ old('room_type') }}" required>
                    @error('room_type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="room_description" class="form-label">Room Description</label>
                    @error('room_description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    {{-- <input type="text" class="form-control" id="room_description" name="room_description" value="{{ old('service_description') }}"> --}}
                    <input id="room_description" type="hidden" name="room_description" value="{{ old('room_description') }}">
                    <trix-editor input="room_description"></trix-editor>
                </div>
                <div class="mb-3">
                    <label for="room_price" class="form-label">Room Price</label>
                    <input type="text" inputmode="numeric" class="form-control" id="room_price" name="room_price" value="{{ old('service_price') }}">
                    @error('room_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>                
                <div class="mb-3">
                    <label for="room_image" class="form-label">Room Image</label>
                    <input class="form-control" type="file" id="room_image" name="room_image" value="{{ old('room_image') }}">
                    @error('room_image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="bathroom_image" class="form-label">Bathroom Image</label>
                    <input class="form-control" type="file" id="bathroom_image" name="bathroom_image" value="{{ old('bathroom_image') }}">
                    @error('bathroom_image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="extra_image" class="form-label">Extra Image</label>
                    <input class="form-control" type="file" id="extra_image" name="extra_image" value="{{ old('extra_image') }}">
                    @error('extra_image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create Room</button>
            </form>
        </div>
    </div>
</div>

@endsection

<script>
    document.getElementById('service_name').addEventListener('input', function() {
    let name = this.value;

    fetch(`/checkSlug?name=${name}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('slug').value = data.slug;
        });
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })
</script>
