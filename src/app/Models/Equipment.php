<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    // TODO: Add user type

    use HasUlids;
    protected $fillable = [
        'brand_name',
        'model_name',
        'registration_number',
        'year_of_manufacture',
    ];

    function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_equipment', 'equipment_id', 'task_id');
    }
}

