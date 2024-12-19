<div class="btn-group">
    @can('permission-edit')
    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
   @endcan
   @can('permission-delete')
    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
    @endcan
</div>
