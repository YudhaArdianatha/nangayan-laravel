@extends('admin.partials.main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Users</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8 px-0">
            <form action="/services/{{ $service->slug }}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="service_name" class="form-label">Service Name</label>
                    <input type="text" class="form-control" id="service_name" name="service_name" value="{{ old('service_name', $service->service_name) }}">
                </div>
                <div class="mb-3">
                    <label for="service_description" class="form-label">Service Description</label>
                    <input type="text" class="form-control" id="service_description" name="service_description" value="{{ old('service_description', $service->service_description) }}">
                </div>
                <div class="mb-3">
                    <label for="service_price" class="form-label">Service Price</label>
                    <input type="text" inputmode="numeric" class="form-control" id="service_price" name="service_price" value="{{ old('service_price', $service->service_price) }}">
                </div>                
            
                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</div>

@endsection