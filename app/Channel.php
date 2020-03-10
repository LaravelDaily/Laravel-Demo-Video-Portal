<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use SoftDeletes;

    public $table = 'channels';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'published',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class, 'channel_id');
    }
}
