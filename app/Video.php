<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    public $table = 'videos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'channel_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'youtube_embed',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');

    }
}
