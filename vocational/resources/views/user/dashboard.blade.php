@extends('layouts.user')

@section('content')
    <h1 class="mt-4" style="font-size:35px">Welcome,
        <span class="navbar-text me-3 mt-7 text-primary" style="font-size:35px">
            {{ Auth::user()->name }}
        </span>
    </h1>
    <ol class="breadcrumb mb-4"></ol>
    <div class="row">
        <!-- Profile Picture and Static Info (Left Card) -->
        <div class="container col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <!-- Profile Picture -->
                    <img src="{{ asset($user->profilePic) }}" alt="Profile Picture" class="rounded-circle" width="150" height="150">
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
                    <form action="{{ route('user.update', ['id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Full Name (Read-only) -->
                        <div class="row mb-3">
                            <label for="fullName" class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fullName" value="{{ $user->name }}" readonly>
                            </div>
                        </div>

                        <!-- Email (Editable) -->
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                            </div>
                        </div>

                        <!-- Phone (Editable) -->
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-3 col-form-label">Phone <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
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
                            <button type="button" class="btn btn-primary" onclick="togglePasswordForm()">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Change Password Form (Hidden initially) -->
            <div id="passwordForm" class="card mt-4" style="display: none;">
                <div class="card-header">
                    Change Password
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Current Password -->
                        <div class="row mb-3">
                            <label for="currentPassword" class="col-sm-4 col-form-label">Current Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="currentPassword" id="currentPassword" required>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="row mb-3">
                            <label for="newPassword" class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="newPassword" id="newPassword" required>
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="row mb-3">
                            <label for="confirmNewPassword" class="col-sm-4 col-form-label">Confirm New Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="confirmNewPassword" id="confirmNewPassword" required>
                            </div>
                        </div>

                        <!-- Update Password Button -->
                        <button type="submit" class="btn btn-success">Update Password</button>
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
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    width: '600px',
                    padding: '3em',
                    backdrop: `rgba(0,0,0,0.4)`,
                    position: 'center',
                    customClass: {
                        popup: 'my-swal-popup'
                    }
                });
            }
        </script>
    @endif

    <!-- JavaScript to toggle the Change Password form -->
    <script>
        function togglePasswordForm() {
            const passwordForm = document.getElementById('passwordForm');
            passwordForm.style.display = passwordForm.style.display === 'none' ? 'block' : 'none';
        }
    </script>

    <!-- CSS to further ensure the popup centers correctly -->
    <style>
        .my-swal-popup {
            margin: 0 auto !important; /* Center-aligns popup on all screen sizes */
        }
    </style>
@endsection
