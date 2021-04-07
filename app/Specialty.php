<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialty extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    /**
     * Accessor for Name field value
     *
     * @param $value
     * @return string
     */
    public function getNameAttribute($value) {
        return ucwords($value);
    }

    /**
     * Mutator for Name field value
     *
     * @param $value
     * @return string
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    /**
     * Many to Many Relationship - Specialty Notifications
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notifications()
    {
        return $this->belongsToMany('App\Notification');
    }

    /**
     * Checks if Specialty name already exist
     *
     * @param $specialtyName
     * @return bool
     */
    public function isSpecialtyExist($specialtyName)
    {
        try {
            $specialty = Specialty::where('name', '=', $specialtyName)->firstOrFail();
            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }
}
