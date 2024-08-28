@extends('admin.partials.main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>User Details</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-8 px-0">
            <a href="/users" class="btn btn-success">
                <i class="bi bi-arrow-left"></i>Back to all users
            </a>
            <a href="/users/{{ $user->slug }}/edit" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i>Edit
            </a>
            <form action="/users/{{ $user->slug }}" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i>Delete</button>
            </form>
            <div class="table table-responsive mt-3">
                <table class="table table-striped table-sm">
                    <tr>
                        <td>Name</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td>{{ $user->phone_number }}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>{{ $user->gender }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection