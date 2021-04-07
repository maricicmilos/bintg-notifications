<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'deleted_at'];

    protected $dates = ['deleted_at'];

    /**
     * Accessor for Name field value
     *
     * @param $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Accessor for Name field value
     *
     * @param $value
     * @return string
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    /**
     * Relationship Role - Users
     *
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
