@extends('layouts.app')
@section('content')
<h2>Create Event</h2>
<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" class="form-control mb-2" placeholder="Title" required>
    <input type="text" name="location" class="form-control mb-2" placeholder="Location" required>
    <input type="date" name="date" class="form-control mb-2" required>
    <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
    <input type="file" name="image" class="form-control mb-2">
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection