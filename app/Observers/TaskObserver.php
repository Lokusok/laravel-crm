<?php

namespace App\Observers;

use App\Enums\Cache\TasksEnum;
use Illuminate\Support\Facades\Cache;

class TaskObserver
{
    public function created(): void
    {
        Cache::forget(TasksEnum::TASKS_INDEX->value);
    }

    public function updated(): void
    {
        Cache::forget(TasksEnum::TASKS_INDEX->value);
    }

    public function deleted(): void
    {
        Cache::forget(TasksEnum::TASKS_INDEX->value);
    }
}
