<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasUlids;
    protected $fillable = [
        'task_description',
        'task_type',
        'task_status',

    ];

    protected $hidden =[
        'created_at',
        'updated_at',
        'group_id',
        'field_id',
    ];

    /**
     * @return BelongsToMany
     */
    function equipments()
    {
        return $this->belongsToMany(Equipment::class, 'task_equipment', 'task_id', 'equipment_id');
    }

    function consumables(){
        return $this->belongsToMany(Consumable::class, 'task_consumable', 'task_id', 'consumable_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }


}
