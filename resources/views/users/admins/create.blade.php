@extends('layouts.master')

@section('title','Create Admin')

@section('wrapper')
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('adm.site.admins.store') }}" method="POST">
                        @csrf
                        @include('layouts.partials.errors')

                        <div class="mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first name" required value="{{ old('fname') }}">
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter last name" value="{{ old('lname') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="uname" class="form-label">Username</label>
                            <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter username" value="{{ old('uname') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                <button type="button" class="btn btn-secondary" id="generatePassword">Generate Password</button>
                                <button type="button" class="btn btn-warning" id="togglePassword">Show</button>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" @if(old('is_active')) checked @endif>
                            <label class="form-check-label" for="is_active">Is Active</label>
                        </div>
                        <button type="submit" role="submit" class="btn btn-primary">Create User</button>
                    </form>

                    <script>
                        // Generate a strong password
                        document.getElementById('generatePassword').addEventListener('click', function () {
                            const length = 12;
                            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~`|}{[]:;?><,./-=";
                            let password = "";
                            for (let i = 0, n = charset.length; i < length; ++i) {
                                password += charset.charAt(Math.floor(Math.random() * n));
                            }
                            document.getElementById('password').value = password;
                        });

                        // Toggle password visibility
                        document.getElementById('togglePassword').addEventListener('click', function () {
                            const passwordField = document.getElementById('password');
                            const toggleButton = this;
                            if (passwordField.type === 'password') {
                                passwordField.type = 'text';
                                toggleButton.textContent = 'Hide';
                            } else {
                                passwordField.type = 'password';
                                toggleButton.textContent = 'Show';
                            }
                        });
                    </script>
                </div>
            </div>

        </div>
    </div>
@endsection
