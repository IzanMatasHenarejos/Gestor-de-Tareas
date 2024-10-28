<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $guarded = [];
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');// 1º Clave foranea y segundo clave local.
    }

    public function sharedWith(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_user')->withPivot('permission');
    }
}
