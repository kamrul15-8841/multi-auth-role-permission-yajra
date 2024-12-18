@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role Management</h1>
        <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create New Role</a>
        <table class="table table-bordered" id="roles-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Role Name</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#roles-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('roles.index') }}",
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'permissions', name: 'permissions' },
                        { data: 'actions', name: 'actions', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    @endpush
@endsection
