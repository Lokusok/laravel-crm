<?php

namespace App\Enums\Cache;

enum ClientsEnum: string
{
    case GLOBAL_NAME = 'clients';
    case CLIENTS_INDEX = 'clients:index';
}
