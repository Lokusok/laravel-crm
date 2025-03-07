<?php

namespace App\Http\Controllers;

use App\Enums\Cache\ProjectsEnum;
use App\Enums\PermissionsEnum;
use App\Http\Requests\Projects\StoreProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use App\Services\PreviewUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function __construct(
        private PreviewUploader $previewUploader
    )
    {}

    public function index(Request $request)
    {
        $cacheKey = ProjectsEnum::GLOBAL_NAME->value . ':' . ($request->page ?? '0');

        $projects = Cache::tags([ProjectsEnum::GLOBAL_NAME->value])->remember($cacheKey, 30, function () {
            return Project::with(['user', 'client'])->latest()->paginate(10);
        });

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $users = User::select(['id', 'first_name', 'last_name'])->get();
        $clients = Client::select(['id', 'company_name'])->get();

        return view('projects.create', compact('users', 'clients'));
    }

    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        if (isset($validated['preview_url'])) {
            $validated['preview_url'] = $this->previewUploader->storePreview($validated['preview_url']);
        }

        Project::create($validated);

        return redirect()->route('projects.index');
    }

    public function edit(Project $project)
    {
        $users = User::select(['id', 'first_name', 'last_name'])->get();
        $clients = Client::select(['id', 'company_name'])->get();

        return view('projects.edit', compact('project', 'users', 'clients'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        if (isset($validated['preview_url'])) {
            $validated['preview_url'] = $this->previewUploader->storePreview($validated['preview_url']);
        }

        $project->update($validated);

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        Gate::authorize(PermissionsEnum::DELETE_PROJECTS->value);

        $project->delete();

        return redirect()->route('projects.index');
    }
}
