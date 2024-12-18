<div class="d-flex">
    @can('user-edit')
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
    @endcan
    @can('user-delete')
        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    @endcan
</div>
