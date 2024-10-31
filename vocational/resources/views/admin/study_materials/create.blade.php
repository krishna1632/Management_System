@extends('layouts.admin')

@section('title', 'Add Study Material')

@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper "style="margin-top:3rem;">
        <div class="page-content">
            <div class="card p-2">
                <div class="card-body">
                    <h3 class="h2 mb-4">Add New Study Material</h3>
                    <form action="{{ route('admin.study_materials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title" class="form-label">Title<font color="red"><b>*</b></font></label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{ old('title') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label">Image<font color="red"><b>*</b></font></label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Enter Description">{{ old('description') }}</textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="file" class="form-label">File<font color="red"><b>*</b></font></label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ url('/admin/study_materials') }}" class="btn btn-light px-4">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
