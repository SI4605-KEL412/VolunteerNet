@extends('manageUser.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 bg-primary text-white py-4" style="min-height: 100vh;">
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
                <h2>Manage Users</h2>
                <div class="text-end">
                    <span class="me-2">Admin</span>
                    <alt="Admin" class="rounded-circle" width="40">
                </div>
            </div>

            <!-- Stats cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm bg-card text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">1000+ Active Users</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm bg-card text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">100+ Events Managed</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm bg-card text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">50+ Partner NGOs</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and filter -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">User List</h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form action="{{ route('manageUser.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="katakunci" value="{{ $katakunci }}" class="form-control" placeholder="Search for name or email...">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('manageUser.create') }}" class="btn btn-success">+ Add User</a>
                        </div>
                    </div>
                        <div class="col-md-4">
                            <form action="{{ route('manageUser.index') }}" method="get" id="statusFilterForm">
                                <input type="hidden" name="katakunci" value="{{ $katakunci }}">
                                <input type="hidden" name="role_filter" value="{{ $roleFilter }}">
                                <select name="status_filter" class="form-select" onchange="document.getElementById('statusFilterForm').submit()">
                                    <option value="">All Status</option>
                                    <option value="active" {{ $statusFilter == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $statusFilter == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="banned" {{ $statusFilter == 'banned' ? 'selected' : '' }}>Banned</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <!-- User listing table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-gray-300 mr-3"></div>
                                            {{ $item->name }}
                                    </td>
                                    <td class="align-middle">{{ $item->email }}</td>
                                    <td class="align-middle">
                                            {{ ucfirst($item->role) }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge {{ $item->status === 'active' ? 'bg-success' : ($item->status === 'inactive' ? 'bg-warning' : 'bg-danger') }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="btn-group">
                                            <a href="{{ route('manageUser.show', $item->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                            <a href="{{ route('manageUser.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                            <form onsubmit="return confirm('Are you sure you want to delete this user?');" action="{{ route('manageUser.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $data->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
    <div class="toast show bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
</div>
<script>
    setTimeout(function() {
        document.querySelector('.toast').classList.remove('show');
    }, 3000);
</script>
@endif
@endsection
