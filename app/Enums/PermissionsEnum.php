<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    case MANAGE_USERS = 'manage_users';
    case DELETE_CLIENTS = 'delete_users';
    case DELETE_PROJECTS = 'delete_projects';
    case DELETE_TASKS = 'delete_tasks';
}
