<?php

namespace App\Observers;

use App\Enums\Cache\ClientsEnum;
use Illuminate\Support\Facades\Cache;

class ClientObserver
{
    public function created(): void
    {
        Cache::tags([ClientsEnum::GLOBAL_NAME->value])->flush();
    }

    public function updated(): void
    {
        Cache::tags([ClientsEnum::GLOBAL_NAME->value])->flush();
    }

    public function deleted(): void
    {
        Cache::tags([ClientsEnum::GLOBAL_NAME->value])->flush();
    }
}
