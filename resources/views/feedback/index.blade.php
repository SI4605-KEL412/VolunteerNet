@extends('layouts.app')

@section('title', 'Feedbacks List')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-gradient">Feedback List</h2>
                <p class="text-muted">Discover feedback from our valued customers!</p>
            </div>

            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success fade-in rounded-pill shadow-sm">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Daftar feedback -->
            @if($feedbacks->isEmpty())
                <p class="text-center text-muted">No feedback available.</p>
            @else
                @foreach($feedbacks as $feedback)
                <div class="feedback-item mb-4">
                    <div class="card shadow-lg border-0 rounded-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary fw-bold">{{ $feedback->customer_name }}</h5>
                            <p class="text-secondary small mb-1"><strong>Email:</strong> {{ $feedback->email }}</p>
                            <p class="text-dark mb-2"><strong>Feedback:</strong> {{ $feedback->feedback }}</p>

                            <!-- Tambahan feedback_type dan event_name -->
                            <div class="mb-2">
                                <span class="badge bg-info text-dark me-2">
                                    {{ ucfirst($feedback->feedback_type) }}
                                </span>
                                @if($feedback->feedback_type === 'event')
                                    <span class="badge bg-secondary">{{ $feedback->event_name }}</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center mt-3">
                                <!-- Tombol Edit -->
                                <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-warning btn-rounded btn-sm me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-rounded btn-sm">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif

            <!-- Navigasi pagination -->
            <div class="text-center mt-4">
                {{ $feedbacks->links() }}
            </div>
        </div>
    </div>
</div>
@endsection