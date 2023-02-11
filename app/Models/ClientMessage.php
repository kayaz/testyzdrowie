<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientMessage extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_msg';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'user_id',
        'client_id',
        'message',
        'source',
        'investment',
        'building',
        'floor',
        'property',
        'rooms',
        'area',
        'ip',
        'mark_at'
    ];

    public function investments()
    {
        return $this->hasOne(Investment::class, 'id', 'investment');
    }

    public function answers()
    {
        return $this->hasMany(self::class, 'parent_id')->latest();
    }

    public function utms()
    {
        return $this->hasMany(ClientMessageArgument::class, 'msg_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
