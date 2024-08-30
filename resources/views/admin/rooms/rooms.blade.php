@extends('admin.partials.main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Rooms</h1>
</div>

<div class="container px-0 mb-3">
    <a class="btn btn-primary" href="/rooms/create">Add Room</a>
</div>

<div class="table-responsive">
    <table class="table table-hover table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Room Name</th>
                <th scope="col">Room Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $room->room_type }}</td>
                <td>Rp. {{ number_format($room->room_price, 0, ',', '.') }}</td>
                <td>
                    <a href="/rooms/{{ $room->slug }}" class="badge bg-info"><i class="bi bi-eye"></i></a>
                    <a href="/rooms/{{ $room->slug }}/edit" class="badge bg-warning"><i class="bi bi-pencil-square"></i></span></a>
                    <form action="/rooms/{{ $room->slug }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('name').addEventListener('input', function() {
    let name = this.value;

    fetch(`/checkSlug?name=${name}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('slug').value = data.slug;
        });
});
</script>

@endsection