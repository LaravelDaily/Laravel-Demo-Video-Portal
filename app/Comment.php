<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    public $table = 'comments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'video_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'comment_text',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');

    }
}
