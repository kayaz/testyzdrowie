<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Gallery extends Model
{

    use HasTranslations;
    public $translatable = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'text',
        'file',
        'file_webp',
        'sort',
        'status'
    ];

    /**
     * Get images
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Models\Image')->orderBy('sort');
    }
}
