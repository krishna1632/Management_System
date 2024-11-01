@extends('layouts.user')

@section('content')
    <h1 class="mt-4" style="font-size:35px">Welcome,
        <span class="navbar-text me-3 mt-7 text-primary" style="font-size:35px">
            {{ Auth::user()->name }}
        </span>
    </h1>
    <ol class="breadcrumb mb-4">
        <!-- <li class="breadcrumb-item active">Dashboard</li> -->
    </ol>
    <div class="row">
        <!-- Profile Picture and Static Info (Left Card) -->
        <div class="container col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <!-- Profile Picture -->
                    <img src="{{ asset($user->profilePic) }}" alt="Profile Picture" class="rounded-circle" width="150"
                        height="150">
                    <h3 class="mt-3">{{ $user->name }}</h3>
                    <p>{{ $user->department }}</p>
                </div>
            </div>
        </div>

        <!-- Editable Form (Right Card) -->
        <div class="container col-md-8">
            <div class="card" style="font-weight: 700; font-size:17px">
                <div class="card-header">
                    User Profile
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', ['id' => Auth::user()->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Full Name (Read-only) -->
                        <div class="row mb-3">
                            <label for="fullName" class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fullName" value="{{ $user->name }}"
                                    readonly>
                            </div>
                        </div>

                        <!-- Email (Editable) -->
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label">Email <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ $user->email }}">
                            </div>
                        </div>

                        <!-- Phone (Editable) -->
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-3 col-form-label">Phone <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone" id="phone"
                                    value="{{ $user->phone }}">
                            </div>
                        </div>

                        <!-- Profile Picture Upload -->
                        <div class="row mb-3">
                            <label for="profilePic" class="col-sm-3 col-form-label">Profile Picture</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="profilePic" id="profilePic">
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-warning">Update Profile</button>
                            <button type="button" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert Success Popup -->
    @if (session('success'))
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Profile Updated Successfully!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false, // Hide OK button
                    timer: 3000, // Popup disappears after 3 seconds
                    timerProgressBar: true, // Show progress bar
                    width: '600px', // Make the popup larger
                    padding: '3em', // Add padding for a larger effect
                    backdrop: `
                        rgba(0,0,0,0.4)  // Darken the background
                    `,
                    position: 'center', // Center the popup
                });
            }
        </script>
    @endif
@endsection
