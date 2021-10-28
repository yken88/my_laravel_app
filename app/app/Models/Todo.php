<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    const INCOMPLETE = 1;
    const COMPLETED = 0;


    protected $fillable = [
        'title',
        'detail',
        'status',
        'user_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
