@extends('admin.partials.main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Services</h1>
</div>

<div class="container px-0 mb-3">
    <a class="btn btn-primary" href="/services/create">Add Service</a>
</div>

<div class="table-responsive">
    <table class="table table-hover table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Service Name</th>
                <th scope="col">Service Description</th>
                <th scope="col">Service Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $service->service_name }}</td>
                <td>{{ $service->service_description }}</td>
                <td>{{ $service->service_price }}</td>
                <td>
                    <a href="/services/{{ $service->slug }}/edit" class="badge bg-warning"><i class="bi bi-pencil-square"></i></span></a>
                    <form action="/services/{{ $service->slug }}" method="post" class="d-inline">
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