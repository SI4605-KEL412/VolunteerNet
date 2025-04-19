@extends('layouts.app')
@section('content')
<a href="{{ route('events.create') }}" class="btn btn-primary mb-3">+ Create Event</a>
<div class="row">
    @foreach($events as $event)
    <div class="col-md-4">
        <div class="card mb-4">
            @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="image">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $event->title }}</h5>
                <p>{{ $event->location }} - {{ \Carbon\Carbon::parse($event->date)->translatedFormat('d F Y') }}</p>
                <span class="badge bg-success">{{ $event->status }}</span>
                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection