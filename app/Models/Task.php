<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ['id'];//IDはデータ作成時に自動生成
    public $timestamps = false;
    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function assignee()
    {
        return $this->belongsTo(Assignee::class,'assignee_id');
    }
}
