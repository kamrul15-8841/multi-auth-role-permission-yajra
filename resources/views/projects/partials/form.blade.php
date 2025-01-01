<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $project->title ?? '') }}" required>
</div>

<div class="form-group">
    <label for="type">Type</label>
    <select name="type" id="type" class="form-control">
        <option value="web" {{ old('type', $project->type ?? '') === 'web' ? 'selected' : '' }}>Web</option>
        <option value="mobile" {{ old('type', $project->type ?? '') === 'mobile' ? 'selected' : '' }}>Mobile</option>
    </select>
</div>

<div class="form-group">
    <label for="stack">Stack</label>
    <select name="stack" id="stack" class="form-control">
        @foreach(['full-stack-mern', 'full-stack-laravel', 'full-stack-laravel-react', 'full-stack-mobile', 'front-end', 'back-end', 'mobile'] as $stack)
            <option value="{{ $stack }}" {{ old('stack', $project->stack ?? '') === $stack ? 'selected' : '' }}>
                {{ ucfirst(str_replace('-', ' ', $stack)) }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="short_description">Short Description</label>
    <textarea name="short_description" id="short_description" class="form-control">{{ old('short_description', $project->short_description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="long_description">Long Description</label>
    <textarea name="long_description" id="long_description" class="form-control">{{ old('long_description', $project->long_description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="github_link">GitHub Link</label>
    <input type="url" name="github_link" id="github_link" class="form-control" value="{{ old('github_link', $project->github_link ?? '') }}">
</div>

<div class="form-group">
    <label for="web_link">Web Link</label>
    <input type="url" name="web_link" id="web_link" class="form-control" value="{{ old('web_link', $project->web_link ?? '') }}">
</div>

<div class="form-group">
    <label for="image">Project Image</label>
    <input type="file" name="image" id="image" class="form-control">
    @if(isset($project) && $project->image)
        <img src="{{ asset('storage/' . $project->image) }}" alt="Project Image" class="img-fluid mt-2" width="150">
    @endif
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-control">
        <option value="1" {{ old('status', $project->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('status', $project->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $project->slug ?? '') }}">
</div>


<button type="submit" class="btn btn-primary">Submit</button>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#title').on('input', function() {
                const title = $(this).val();

                // Only generate slug if title is not empty
                if (title.trim() !== '') {
                    $.ajax({
                        url: '{{ route('projects.generateSlug') }}', // Define a new route for slug generation
                        type: 'GET',
                        data: { title: title },
                        success: function(response) {
                            $('#slug').val(response.slug);
                        },
                        error: function() {
                            console.error('Error generating slug.');
                        }
                    });
                } else {
                    $('#slug').val('');
                }
            });
        });
    </script>
@endpush
