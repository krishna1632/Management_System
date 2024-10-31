@extends('layouts.admin')

@section('title', 'Faculty Management')

@section('content')
    <h1 class="mt-4">Faculty Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Faculty</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Faculty List
            <a href="{{ route('admin.faculty.create') }}" class="btn btn-primary btn-sm float-end">Add Faculty</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faculties as $faculty)
                        <tr>
                            <td>{{ $faculty->id }}</td>
                            <td>{{ $faculty->name }}</td>
                            <td>{{ $faculty->email }}</td>
                            <td>{{ $faculty->phone }}</td>
                            <td>{{ $faculty->department }}</td>
                            <td>
                                <a href="{{ route('admin.faculty.show', $faculty->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('admin.faculty.edit', $faculty->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.faculty.destroy', $faculty->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this faculty?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection