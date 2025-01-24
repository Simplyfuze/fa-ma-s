<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';
    use HasUlids;
    protected $fillable = [
        'brand_name',
        'model_name',
        'equipment_type',
        'registration_number',
        'year_of_manufacture',
    ];

    function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_equipment', 'equipment_id', 'task_id');
    }
}

