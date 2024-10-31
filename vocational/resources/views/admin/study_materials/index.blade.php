@extends('layouts.admin')

@section('title', 'Study Materials')

@section('content')
    <h1 class="mt-4">Study Materials</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Study Materials</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-book me-1"></i>
            Study Materials List
            <a href="{{ route('admin.study_materials.create') }}" class="btn btn-primary btn-sm float-end">Add New Study Material</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studyMaterials as $material)
                        <tr>
                            <td>
                                @if ($material->image_path)
                                    <img src="{{ asset('storage/' . $material->image_path) }}" alt="Image" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $material->title }}</td>
                            <td>{{ $material->description }}</td>
                            <td>
                                @if ($material->file_path)
                                    <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank">
                                        <button class="btn btn-primary btn-sm">View File</button>
                                    </a>
                                @else
                                    No File
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.study_materials.show', $material->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('admin.study_materials.edit', $material->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.study_materials.destroy', $material->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this study material?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include SweetAlert CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert Success Popup -->
    @if(session('success'))
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            }
        </script>
    @endif
@endsection
