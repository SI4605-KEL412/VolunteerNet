@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Volunteer Events</h2>
    <a href="{{ route('events.create') }}" class="btn btn-primary">+ Create Event</a>
</div>

<div class="row">
    @foreach($events as $event)
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
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" onclick="return confirm('Are you sure?')">Apply</button>
                    </form>
                    <form action="{{ route('bookmark.toggle', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-warning">
                            @if(auth()->check() && auth()->user()->bookmarkedEvents->contains($event->id))
                                <i class="bi bi-bookmark-fill"></i>
                            @else
                                <i class="bi bi-bookmark"></i>
                            @endif
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
