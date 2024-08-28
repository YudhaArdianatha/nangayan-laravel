@extends('admin.partials.main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create Service</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8 px-0">
            <form action="{{ route('services.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="service_name" class="form-label">Service Name</label>
                    <input type="text" class="form-control" id="service_name" name="service_name" value="{{ old('service_name') }}">
                </div>
                <div class="mb-3">
                    <label for="service_description" class="form-label">Service Description</label>
                    <input type="text" class="form-control" id="service_description" name="service_description" value="{{ old('service_description') }}">
                </div>
                <div class="mb-3">
                    <label for="service_price" class="form-label">Service Price</label>
                    <input type="text" inputmode="numeric" class="form-control" id="service_price" name="service_price" value="{{ old('service_price') }}">
                </div>                
                
                <button type="submit" class="btn btn-primary">Create Service</button>
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
</script>
