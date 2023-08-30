<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    public function status()
    {
        return $this->hasOne(Status::class, 'id','status_id');
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'id','user_id');
    }

}
