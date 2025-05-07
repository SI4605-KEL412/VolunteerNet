@extends('layouts.app')

@section('content')
<h2 class="mb-4">Bookmarked Events</h2>

@if($bookmarkedEvents->isEmpty())
    <div class="alert alert-info">Kamu belum bookmark event apapun.</div>
@else
<div class="row">
    @foreach($bookmarkedEvents as $event)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="event-image" style="height: 200px; object-fit: cover;">
            @endif
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $event->title }}</h5>
                <p class="mb-2 text-muted">
                    <i class="bi bi-geo-alt-fill text-danger"></i> {{ $event->location }} <br>
                    <i class="bi bi-calendar-event-fill text-primary"></i>
                    {{ \Carbon\Carbon::parse($event->date)->translatedFormat('d F Y') }}
                </p>
                <div class="mt-auto d-flex justify-content-between">
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-outline-secondary">Detail</a>
                    <form action="{{ route('bookmark.toggle', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-bookmark-dash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection
