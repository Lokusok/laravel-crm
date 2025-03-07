<?php

namespace App\Enums\Cache;

enum TasksEnum: string
{
    case GLOBAL_NAME = 'tasks';
    case TASKS_INDEX = 'tasks:index';
}
