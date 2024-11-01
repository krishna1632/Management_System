@extends('layouts.admin')

@section('title', 'Edit Study Material')

@section('content')
    <div class="page-wrapper" style="margin-top:3rem;">
        <div class="page-content">
            <div class="card p-2">
                <div class="card-body">
                    <h3 class="h2 mb-4">Edit Study Material</h3>
                    <form action="{{ route('admin.study_materials.update', $studyMaterial->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Department Dropdown -->
                            <div class="col-md-3">
                                <label class="form-label">Department</label>
                                <select name="department" class="form-control">
                                    <option value="" disabled>Select Department</option>

                                    <option value="Computer Science"
                                        {{ old('department', $studyMaterial->department) == 'Computer Science' ? 'selected' : '' }}>
                                        Computer Science
                                    </option>

                                    <option value="BMS"
                                        {{ old('department', $studyMaterial->department) == 'BMS' ? 'selected' : '' }}>
                                        BMS

                                    </option>
                                    <option value="Commerce"
                                        {{ old('department', $studyMaterial->department) == 'Commerce' ? 'selected' : '' }}>
                                        Commerce
                                    </option>

                                    <option value="Bvoc Software Development"
                                        {{ old('department', $studyMaterial->department) == 'Bvoc Software Development' ? 'selected' : '' }}>
                                        Bvoc Software Development
                                    </option>

                                    <option value="Banking"
                                        {{ old('department', $studyMaterial->department) == 'Banking' ? 'selected' : '' }}>
                                        Banking
                                    </option>
                                </select>
                                @error('department')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Semester Dropdown -->
                            <div class="col-md-3">
                                <label class="form-label">Semester</label>
                                <select name="semester" class="form-control">
                                    <option value="" disabled>Select Semester</option>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('semester', $studyMaterial->semester) == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('semester')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Title Field -->
                            <div class="col-md-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Title"
                                    value="{{ old('title', $studyMaterial->title) }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Description Field -->
                            <div class="col-md-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" placeholder="Enter Description">{{ old('description', $studyMaterial->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Image Field -->
                            <div class="col-md-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control">
                                @if ($studyMaterial->image_path)
                                    <p>Current Image: <img src="{{ asset('storage/' . $studyMaterial->image_path) }}"
                                            alt="Image" width="100" class="mt-2"></p>
                                @endif
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- File Field -->
                            <div class="col-md-3">
                                <label class="form-label">File</label>
                                <input type="file" name="file" class="form-control-file">
                                @if ($studyMaterial->file_path)
                                    <p>Current File: <a href="{{ asset('storage/' . $studyMaterial->file_path) }}"
                                            target="_blank">View File</a></p>
                                @endif
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('admin.study_materials.index') }}" class="btn btn-light px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Study Material</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert Success Popup -->
    @if (session('success'))
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
