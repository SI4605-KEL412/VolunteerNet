@extends('manageUser.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 bg-primary text-white py-4">
            <div class="d-flex align-items-center mb-4">
                <h4 class="m-0">VolunteerNet</h4>
            </div>
            <div class="nav flex-column">
                <a href="{{ route('manageUser.index') }}" class="nav-link bg-light text-primary mb-2 rounded py-2 px-3">
                    Manage User
                </a>
                <a href="#" class="nav-link text-white mb-2 py-2 px-3">
                    Manage Volunteer Event
                </a>
                <a href="#" class="nav-link text-white mb-2 py-2 px-3">
                    Notification
                </a>
            </div>
        </div>

        <!-- Main content -->
        <div class="col-md-10 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Edit User: {{ $data->name }}</h2>
                <div class="text-end">
                    <span class="me-2">Admin</span>
                    <img src="{{ asset('avatar.png') }}" alt="Admin" class="rounded-circle" width="40">
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('manageUser.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $data->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $data->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password (leave blank to keep current)</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="volunteer" {{ old('role', $data->role) == 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $data->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="active" {{ old('status', $data->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $data->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="banned" {{ old('status', $data->status) == 'banned' ? 'selected' : '' }}>Banned</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="skills" class="form-label">Skills (comma separated)</label>
                                <input type="text" class="form-control @error('skills') is-invalid @enderror" id="skills" name="skills"
                                    value="{{ old('skills', is_array($data->skills) ? implode(',', $data->skills) : $data->skills) }}"
                                    placeholder="e.g. teaching, first aid, web design">
                                @error('skills')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('manageUser.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
