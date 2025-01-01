<a href="{{ route('projects.show', $project) }}" class="btn btn-info btn-sm">View Details</a>

<a href="javascript:void(0)" onclick="toggleStatus({{ $project->id }})" class="btn btn-warning btn-sm">
    {{ $project->status ? 'Deactivate' : 'Activate' }}
</a>
<a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
</form>

