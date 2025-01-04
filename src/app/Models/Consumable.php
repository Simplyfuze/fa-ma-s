<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Consumable extends Model
{
    use HasUlids;
    protected $fillable = [
        'consumable_name',
        'consumable_type',
    ];

    /**
     * @return BelongsToMany
     */
    function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_consumable', 'consumable_id', 'task_id');
    }
}
