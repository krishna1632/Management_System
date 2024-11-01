@extends('layouts.admin')

@section('title', 'Upload PYQ')

@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper "style="margin-top:3rem;">
        <div class="page-content">
            <div class="card p-2">
                <div class="card-body">
                    <h3 class="h2 mb-4">Upload New PYQ</h3>
                    <form action="{{ route('admin.upload_pyq.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="department" class="form-label">Department<font color="red"><b>*</b></font>
                                </label>
                                <select name="department" class="form-control" required>
                                    <option value="" disabled selected>Select Department</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="BMS">BMS</option>
                                    <option value="Commerce">Commerce</option>
                                    <option value="Bvoc Software Development">Bvoc Software Development</option>
                                    <option value="Banking">Banking</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="subject_type" class="form-label">Subject Type<font color="red"><b>*</b>
                                    </font>
                                </label>
                                <select name="subject_type" class="form-control" required>
                                    <option value="" disabled selected>Select Subject Type</option>
                                    <option value="Core">Core</option>
                                    <option value="Elective">Elective</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="semester" class="form-label">Semester<font color="red"><b>*</b></font>
                                </label>
                                <select name="semester" class="form-control" required>
                                    <option value="" disabled selected>Select Semester</option>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="title" class="form-label">Title<font color="red"><b>*</b></font></label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Title"
                                    value="{{ old('title') }}" required>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label for="year" class="form-label">Year</label>
                                <input type="year" name="year" class="form-control" rows="4"
                                    placeholder="Enter year">{{ old('year') }}</input>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="file" class="form-label">File<font color="red"><b>*</b></font></label>
                                <input type="file" name="file" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ url('/admin/upload_pyq') }}" class="btn btn-light px-4">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
