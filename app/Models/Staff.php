<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'type_id',
        'balance',
        'tg_chat_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function type()
    {
        return $this->belongsTo(StaffType::class,'type_id','id');
    }
}
