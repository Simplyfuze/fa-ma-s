<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    use HasUlids;
    protected $fillable = [
        'field_name',
        'field_size'
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
