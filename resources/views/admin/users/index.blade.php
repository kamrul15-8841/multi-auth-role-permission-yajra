@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Management</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New User</a>
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>
    </div>

    @push('scripts')
        <script>
            $(function() {
                $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('users.index') !!}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'roles', name: 'roles' },
                        { data: 'actions', name: 'actions', orderable: false, searchable: false },
                    ]
                });
            });
        </script>
    @endpush

@endsection
