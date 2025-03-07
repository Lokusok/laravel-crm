<?php

namespace App\Http\Controllers;

use App\Enums\Cache\TasksEnum;
use App\Enums\PermissionsEnum;
use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index()
    {
        $cacheKey = TasksEnum::TASKS_INDEX->value . ':' . ($request->page ?? '0');

        $tasks = Cache::tags([TasksEnum::GLOBAL_NAME->value])->remember($cacheKey, 30, function () {
            return Task::with(['user', 'client', 'project'])->latest()->paginate(20);
        });

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::select(['id', 'first_name', 'last_name'])->get();
        $clients = Client::select(['id', 'company_name'])->get();
        $projects = Project::select(['id', 'title'])->get();

        return view('tasks.create', compact('users', 'clients', 'projects'));
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        Task::create($validated);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $users = User::select(['id', 'first_name', 'last_name'])->get();
        $clients = Client::select(['id', 'company_name'])->get();
        $projects = Project::select(['id', 'title'])->get();

        return view('tasks.edit', compact('task', 'users', 'clients', 'projects'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validated = $request->validated();

        $task->update($validated);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        Gate::authorize(PermissionsEnum::DELETE_TASKS->value);

        $task->delete();

        return redirect()->route('tasks.index');
    }
}
