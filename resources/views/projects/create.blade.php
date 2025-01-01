@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Project</h1>
        <form method="POST" enctype="multipart/form-data" action="{{ route('projects.store') }}">
            @csrf
            @include('projects.partials.form')
        </form>
    </div>
@endsection

