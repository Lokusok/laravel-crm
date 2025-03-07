<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use App\Observers\ProjectObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ProjectObserver::class)]
class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'client_id',
        'deadline_at',
        'status',
        'preview_url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function casts(): array
    {
        return [
            'status' => ProjectStatus::class,
            'deadline_at' => 'datetime'
        ];
    }
}
