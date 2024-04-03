<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'recipient',
        'send_date',
        'is_published',
        'heart_count'
    ];

    protected $dates = ['send_date'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
