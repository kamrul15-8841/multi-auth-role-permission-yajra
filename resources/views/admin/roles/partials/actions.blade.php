<div class="d-flex">
    @can('role-edit')
        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
    @endcan
    @can('role-delete')
        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    @endcan

</div>

@push('scripts')
    <script>
        $(document).on('submit', '.delete-form', function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this role?')) {
                this.submit();
            }
        });
    </script>
@endpush
