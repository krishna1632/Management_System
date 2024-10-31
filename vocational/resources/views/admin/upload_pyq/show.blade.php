@extends('layouts.admin')

@section('title', 'View PYQ')

@section('content')
    <div class="page-wrapper" style="margin-top:3rem;">
        <div class="page-content">
            <div class="card p-2">
                <div class="card-body">
                    <h3 class="h2 mb-4">{{ $pyq->title }}</h3>

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Title --}}
                            <label class="form-label"><strong>Tile:</strong></label>
                            <p>{{ $pyq->title ?? 'No title available' }}</p>
                        </div>

                        <div class="col-md-6">
                            {{-- year --}}
                            <label class="form-label"><strong>Year:</strong></label>
                            <p>{{ $pyq->year ?? 'No Year available' }}</p>
                        </div>

                        <div class="col-md-12">
                            {{-- File --}}
                            <label class="form-label"><strong>File:</strong></label>
                            @if ($pyq->file)
                                <p><a href="{{ asset('storage/' . $pyq->file) }}" target="_blank">
                                        <button class="btn btn-primary">View File</button>
                                    </a></p>
                            @else
                                <p>No file uploaded</p>
                            @endif
                        </div>
                    </div>

                    {{-- Back, Edit, Delete buttons --}}
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('admin.upload_pyq.index') }}" class="btn btn-light px-4">Back to List</a>
                        <a href="{{ route('admin.upload_pyq.edit', $pyq->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('admin.upload_pyq.destroy', $pyq->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this pyq?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
