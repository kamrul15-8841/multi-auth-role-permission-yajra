@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Projects</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Create Project</a>
        <table class="table table-bordered" id="projects-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Type</th>
                <th>Stack</th>
                <th>Short Description</th>
                <th>Long Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#projects-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('projects.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    // { data: 'image', name: 'image' },
                    { data: 'image', name: 'image', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'type', name: 'type' },
                    { data: 'stack', name: 'stack' },
                    { data: 'short_description', name: 'short_description' },
                    { data: 'long_description', name: 'long_description' },
                    { data: 'status', name: 'status', render: function(data, type, row) {
                            return row.status ? 'Active' : 'Inactive';
                        }},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    <script>
        function toggleStatus(projectId) {
            $.ajax({
                url: `/projects/${projectId}/toggle-status`,
                type: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.success);
                    $('#projects-table').DataTable().ajax.reload();
                }
            });
        }
    </script>
@endpush
