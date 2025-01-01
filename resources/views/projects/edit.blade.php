@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Project</h1>
        <form method="POST" enctype="multipart/form-data" action="{{ route('projects.update', $project) }}">
            @csrf
            @method('PUT')
            @include('projects.partials.form', ['project' => $project])
        </form>
    </div>
@endsection
