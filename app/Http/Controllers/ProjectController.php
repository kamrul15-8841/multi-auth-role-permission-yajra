<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $projects = Project::where('user_id', Auth::id());
            return DataTables::of($projects)
                ->addColumn('type', function ($project) {
                    return ucfirst($project->type);
                })
                ->addColumn('stack', function ($project) {
                    return ucfirst(str_replace('-', ' ', $project->stack));
                })
                ->addColumn('image', function ($project) {
                    if ($project->image) {
                        return '<img src="' . asset('storage/' . $project->image) . '" alt="Project Image" width="50" />';
                    }
                    return 'No Image';
                })
                ->addColumn('actions', function ($project) {
                    return view('projects.partials.actions', compact('project'))->render();
                })
                ->rawColumns(['image','actions'])
                ->make(true);
        }

        return view('projects.index');
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:web,mobile',
            'stack' => 'required|in:full-stack-mern,full-stack-laravel,full-stack-laravel-react,full-stack-mobile,front-end,back-end,mobile',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'github_link' => 'nullable|url',
            'web_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
            'slug' => 'nullable|string|unique:projects,slug',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        // Create the project with all validated fields + the image path
        $project = Project::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'type' => $request->type,
            'stack' => $request->stack,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'github_link' => $request->github_link,
            'web_link' => $request->web_link,
            'image' => $imagePath,
            'status' => $request->status,
            'slug' => $request->slug ?? \Str::slug($request->title),
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function store1(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:web,mobile',
            'stack' => 'required|in:full-stack-mern,full-stack-laravel,full-stack-laravel-react,full-stack-mobile,front-end,back-end,mobile',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'github_link' => 'nullable|url',
            'web_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
            'slug' => 'nullable|string|unique:projects,slug',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        }
        $request->merge(['user_id' => Auth::id(), 'image' => $imagePath]);
        Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        // Ensure only authorized users can update this project
        $this->authorize('update', $project);

        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:web,mobile',
            'stack' => 'required|in:full-stack-mern,full-stack-laravel,full-stack-laravel-react,full-stack-mobile,front-end,back-end,mobile',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'github_link' => 'nullable|url',
            'web_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
            'slug' => 'nullable|string|unique:projects,slug,' . $project->id,
        ]);

        // Update fields except for the image
        $project->title = $request->title;
        $project->type = $request->type;
        $project->stack = $request->stack;
        $project->short_description = $request->short_description;
        $project->long_description = $request->long_description;
        $project->github_link = $request->github_link;
        $project->web_link = $request->web_link;
        $project->status = $request->status;
        $project->slug = $request->slug ?? \Str::slug($request->title);

        // Handle image upload if a new file is provided
        if ($request->hasFile('image')) {
            // Store the new image
            $imagePath = $request->file('image')->store('projects', 'public');

            // Optionally, delete the old image from storage
            if ($project->image) {
                \Storage::disk('public')->delete($project->image);
            }

            $project->image = $imagePath;
        }

        // Save the updated project
        $project->save();

        // Redirect back with a success message
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function update1(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:web,mobile',
            'stack' => 'required|in:full-stack-mern,full-stack-laravel,full-stack-laravel-react,full-stack-mobile,front-end,back-end,mobile',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'github_link' => 'nullable|url',
            'web_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
            'slug' => 'nullable|string|unique:projects,slug,' . $project->id,
        ]);

//        $project->update($request->all());
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $project->image = $imagePath;
        }

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function toggleStatus(Project $project)
    {
        $this->authorize('update', $project);

        $project->update(['status' => !$project->status]);

        return response()->json(['success' => 'Project status updated successfully.']);
    }

    public function generateSlug(Request $request)
    {
        $title = $request->get('title');
        $slug = \Str::slug($title);

        // Check if the slug already exists
        $count = Project::where('slug', 'LIKE', "{$slug}%")->count();

        if ($count > 0) {
            $slug .= '-' . ($count + 1); // Append a unique suffix if slug exists
        }

        return response()->json(['slug' => $slug]);
    }


}
