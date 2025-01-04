<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasUlids;
    protected $fillable = [
        'group_name'
    ];


    public function users(){
        return $this->belongsToMany(User::class, 'groups_users', 'group_id', 'user_id');
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
