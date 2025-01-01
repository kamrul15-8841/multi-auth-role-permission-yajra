@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $project->title }}</h1>
        <p><strong>Type:</strong> {{ ucfirst($project->type) }}</p>
        <p><strong>Stack:</strong> {{ ucfirst(str_replace('-', ' ', $project->stack)) }}</p>
        <p><strong>Status:</strong> {{ $project->status ? 'Active' : 'Inactive' }}</p>
        <p><strong>Short Description:</strong> {{ $project->short_description }}</p>
        <p><strong>Long Description:</strong> {!! nl2br(e($project->long_description)) !!}</p>
        <p><strong>GitHub Link:</strong> <a href="{{ $project->github_link }}" target="_blank">{{ $project->github_link }}</a></p>
        <p><strong>Web Link:</strong> <a href="{{ $project->web_link }}" target="_blank">{{ $project->web_link }}</a></p>
        @if($project->image)
            <img src="{{ asset('storage/' . $project->image) }}" alt="Project Image" class="img-fluid">
        @endif
    </div>
@endsection
