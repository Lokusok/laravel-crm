<?php

namespace App\Observers;

use App\Enums\Cache\ClientsEnum;
use Illuminate\Support\Facades\Cache;

class ClientObserver
{
    public function created(): void
    {
        Cache::forget(ClientsEnum::CLIENTS_INDEX->value);
    }

    public function updated(): void
    {
        Cache::forget(ClientsEnum::CLIENTS_INDEX->value);
    }

    public function deleted(): void
    {
        Cache::forget(ClientsEnum::CLIENTS_INDEX->value);
    }
}
