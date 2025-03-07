<?php

namespace App\Observers;

use App\Enums\Cache\ProjectsEnum;
use Illuminate\Support\Facades\Cache;

class ProjectObserver
{
    public function created(): void
    {
        Cache::forget(ProjectsEnum::PROJECTS_INDEX->value);
    }

    public function updated(): void
    {
        Cache::forget(ProjectsEnum::PROJECTS_INDEX->value);
    }

    public function deleted(): void
    {
        Cache::forget(ProjectsEnum::PROJECTS_INDEX->value);
    }
}
