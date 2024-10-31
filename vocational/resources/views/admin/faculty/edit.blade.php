@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Faculty</h1>

    <form action="{{ route('admin.faculty.update', $faculty->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $faculty->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $faculty->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $faculty->phone }}" required>
        </div>

        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" name="department" class="form-control" value="{{ $faculty->department }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Faculty</button>
    </form>
</div>
@endsection
