@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Faculty Details</h1>

    <p><strong>Name:</strong> {{ $faculty->name }}</p>
    <p><strong>Email:</strong> {{ $faculty->email }}</p>
    <p><strong>Phone:</strong> {{ $faculty->phone }}</p>
    <p><strong>Department:</strong> {{ $faculty->department }}</p>

    <a href="{{ route('admin.faculty.edit', $faculty->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
