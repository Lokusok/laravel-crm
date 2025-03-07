<?php

namespace App\Observers;

use App\Enums\Cache\ProjectsEnum;
use App\Enums\ProjectStatus;
use App\Mail\ProjectDone;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProjectObserver
{
    public function created(): void
    {
        Cache::forget(ProjectsEnum::PROJECTS_INDEX->value);
    }

    public function updated(Project $project): void
    {
        Cache::forget(ProjectsEnum::PROJECTS_INDEX->value);

        if ($project->status === ProjectStatus::COMPLETED) {
            Log::info("{$project->title} is done!");

            $admin = User::where('first_name', 'Admin')->first();

            if (! $admin) {
                return;
            }

            Mail::to($admin)->send(new ProjectDone($project));
        }
    }

    public function deleted(): void
    {
        Cache::forget(ProjectsEnum::PROJECTS_INDEX->value);
    }
}
