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
                <h2>User Details</h2>
                <div class="text-end">
                    <span class="me-2">Admin</span>
                    <img src="{{ asset('images/avatar.png') }}" alt="Admin" class="rounded-circle" width="40">
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <img src="{{ asset('images/avatar.png') }}" alt="{{ $data->name }}" class="rounded-circle mb-3" width="120">
                            <h4>{{ $data->name }}</h4>
                            </span>
                            <span class="badge {{ $data->status === 'active' ? 'bg-success' : ($data->status === 'inactive' ? 'bg-warning' : 'bg-danger') }}">
                                {{ ucfirst($data->status) }}
                            </span>
                        </div>
                        <div class="col-md-9">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Contact Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-3 fw-bold">Email:</div>
                                        <div class="col-md-9">{{ $data->email }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 fw-bold">Phone:</div>
                                        <div class="col-md-9">{{ $data->phone ?: 'Not provided' }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Skills</h5>
                                </div>
                                <div class="card-body">
                                    @if(is_array($data->skills) && count($data->skills) > 0)
                                        @foreach($data->skills as $skill)
                                            <span class="badge bg-secondary me-1 mb-1">{{ $skill }}</span>
                                        @endforeach
                                    @else
                                        <p>No skills listed</p>
                                    @endif
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Account Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-3 fw-bold">Created:</div>
                                        <div class="col-md-9">{{ $data->created_at->format('M d, Y') }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 fw-bold">Last Updated:</div>
                                        <div class="col-md-9">{{ $data->updated_at->format('M d, Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('manageUser.index') }}" class="btn btn-outline-secondary me-2">Back to List</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
