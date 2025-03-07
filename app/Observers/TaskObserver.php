<?php

namespace App\Observers;

use App\Enums\Cache\TasksEnum;
use Illuminate\Support\Facades\Cache;

class TaskObserver
{
    public function created(): void
    {
        Cache::tags([TasksEnum::GLOBAL_NAME->value])->flush();
    }

    public function updated(): void
    {
        Cache::tags([TasksEnum::GLOBAL_NAME->value])->flush();
    }

    public function deleted(): void
    {
        Cache::tags([TasksEnum::GLOBAL_NAME->value])->flush();
    }
}
