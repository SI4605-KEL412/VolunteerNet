@extends('layouts.app')
@section('content')
<h2>Edit Event</h2>
<form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $event->title }}" class="form-control mb-2" required>
    <input type="text" name="location" value="{{ $event->location }}" class="form-control mb-2" required>
    <input type="date" name="date" value="{{ $event->date }}" class="form-control mb-2" required>
    <textarea name="description" class="form-control mb-2">{{ $event->description }}</textarea>
    <input type="file" name="image" class="form-control mb-2">
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection