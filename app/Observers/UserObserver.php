<?php

namespace App\Observers;

use App\Enums\Cache\UsersEnum;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    public function created(): void
    {
        Cache::tags([UsersEnum::GLOBAL_NAME->value])->flush();
    }

    public function updated(): void
    {
        Cache::tags([UsersEnum::GLOBAL_NAME->value])->flush();
    }

    public function deleted(): void
    {
        Cache::tags([UsersEnum::GLOBAL_NAME->value])->flush();
    }
}
