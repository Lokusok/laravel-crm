<?php

namespace App\Observers;

use App\Enums\Cache\UsersEnum;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    public function created(): void
    {
        Cache::forget(UsersEnum::USERS_INDEX->value);
    }

    public function updated(): void
    {
        Cache::forget(UsersEnum::USERS_INDEX->value);
    }

    public function deleted(): void
    {
        Cache::forget(UsersEnum::USERS_INDEX->value);
    }
}
