<?php

namespace App\Enums\Cache;

enum UsersEnum: string
{
    case GLOBAL_NAME = 'users';
    case USERS_INDEX = 'users:index';
}
