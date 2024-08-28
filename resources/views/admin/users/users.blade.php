@extends('admin.partials.main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Users</h1>
</div>


<div class="table-responsive">
    <table class="table table-hover table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Gender</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->gender }}</td>
                <td>
                    {{-- <a href="/users/{{ $user->slug }}" class="badge bg-primary"><i class="bi bi-eye"></i></a> --}}
                    <a href="/users/{{ $user->slug }}/edit" class="badge bg-warning"><i class="bi bi-pencil-square"></i></span></a>
                    <form action="/users/{{ $user->slug }}" method="post" class="d-inline">
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