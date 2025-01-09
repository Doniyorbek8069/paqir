<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    const START = 1;
    const INCOME = 2;
    const OUTCOME = 3;

    const LIST = [
        [
            'id'    => self::START,
            'name'  => "Boshlang'ich"
        ],
        [
            'id'    => self::INCOME,
            'name'  => "Kirim Qilish"
        ],
        [
            'id'    => self::OUTCOME,
            'name'  => "Chiqim Qilish"
        ]
    ];
    protected $fillable = [
        'id',
        'custom_id',
        'input',
        'output',
        'debt',
        'type',
        'object_id',
        'date',
        'comment'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'object_id','id');
    }
}
