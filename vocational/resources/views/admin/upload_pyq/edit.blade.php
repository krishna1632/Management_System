@extends('layouts.admin')

@section('title', 'Edit PYQ')

@section('content')
    <div class="page-wrapper" style="margin-top:3rem;">
        <div class="page-content">
            <div class="card p-2">
                <div class="card-body">
                    <h3 class="h2 mb-4">Edit PYQ</h3>
                    <form action="{{ route('admin.upload_pyq.update', $pyq->id) }}" method="POST"
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
                                        {{ old('department', $pyq->department) == 'Computer Science' ? 'selected' : '' }}>
                                        Computer Science
                                    </option>

                                    <option value="BMS"
                                        {{ old('department', $pyq->department) == 'BMS' ? 'selected' : '' }}>
                                        BMS

                                    </option>
                                    <option value="Commerce"
                                        {{ old('department', $pyq->department) == 'Commerce' ? 'selected' : '' }}>
                                        Commerce
                                    </option>

                                    <option value="Bvoc Software Development"
                                        {{ old('department', $pyq->department) == 'Bvoc Software Development' ? 'selected' : '' }}>
                                        Bvoc Software Development
                                    </option>

                                    <option value="Banking"
                                        {{ old('department', $pyq->department) == 'Banking' ? 'selected' : '' }}>
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
                                            {{ old('semester', $pyq->semester) == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('semester')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Subject Type</label>
                                <select name="subject_type" class="form-control">
                                    <option value="" disabled>Select Subject Type</option>
                                    <option value="core"
                                        {{ old('subject_type', $pyq->subject_type) == 'Core' ? 'selected' : '' }}>
                                        Core
                                    </option>
                                    <option value="Elective"
                                        {{ old('subject_type', $pyq->subject_type) == 'Elective' ? 'selected' : '' }}>
                                        Elective
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Title"
                                    value="{{ old('title', $pyq->title) }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Year</label>
                                <textarea name="year" class="form-control" placeholder="Enter year">{{ old('year', $pyq->year) }}</textarea>
                                @error('year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">File</label>
                                <input type="file" name="file" class="form-control-file">
                                @if ($pyq->file_path)
                                    <p>Current File: <a href="{{ asset('storage/' . $pyq->file) }}" target="_blank">View
                                            File</a></p>
                                @endif
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('admin.upload_pyq.index') }}" class="btn btn-light px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update PYQ</button>
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
                    showConfirmButton: false, // Hide the OK button
                    timer: 3000, // Popup will disappear after 4 seconds
                    timerProgressBar: true, // Optional: Show progress bar
                });
            }
        </script>
    @endif

@endsection
