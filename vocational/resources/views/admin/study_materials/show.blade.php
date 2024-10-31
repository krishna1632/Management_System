@extends('layouts.admin')

@section('title', 'View Study Material')

@section('content')
    <div class="page-wrapper" style="margin-top:3rem;">
        <div class="page-content">
            <div class="card p-2">
                <div class="card-body">
                    <h3 class="h2 mb-4">{{ $studyMaterial->title }}</h3>

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Show Image --}}
                            <label class="form-label"><strong>Image:</strong></label>
                            @if ($studyMaterial->image_path)
                                <img src="{{ asset('storage/' . $studyMaterial->image_path) }}" alt="Image"
                                    class="img-fluid" style="max-width: 300px; height: auto;">
                            @else
                                <p>No image uploaded</p>
                            @endif
                        </div>

                        <div class="col-md-6">
                            {{-- Description --}}
                            <label class="form-label"><strong>Description:</strong></label>
                            <p>{{ $studyMaterial->description ?? 'No description available' }}</p>
                        </div>

                        <div class="col-md-12">
                            {{-- File --}}
                            <label class="form-label"><strong>File:</strong></label>
                            @if ($studyMaterial->file_path)
                                <p><a href="{{ asset('storage/' . $studyMaterial->file_path) }}" target="_blank">
                                        <button class="btn btn-primary">View File</button>
                                    </a></p>
                            @else
                                <p>No file uploaded</p>
                            @endif
                        </div>
                    </div>

                    {{-- Back, Edit, Delete buttons --}}
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('admin.study_materials.index') }}" class="btn btn-light px-4">Back to List</a>
                        <a href="{{ route('admin.study_materials.edit', $studyMaterial->id) }}"
                            class="btn btn-warning">Edit</a>

                        <form action="{{ route('admin.study_materials.destroy', $studyMaterial->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this material?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
