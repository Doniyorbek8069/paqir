<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'custom_id',
        'user_id',
        'sum',
        'date',
        'comment'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function custom(){
        return $this->belongsTo(Staff::class,'custom_id','id');
    }
}
