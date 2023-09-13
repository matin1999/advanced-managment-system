<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Article
 * @property int user_id
 * @property string title
 * @property string content
 * @property int status_id
 */
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
