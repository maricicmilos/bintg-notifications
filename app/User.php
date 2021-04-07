<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'specialty_id',
        'firstname',
        'email',
        'lastname',
        'confirmation_code',
        'is_verified',
        'email_verified_at',
        'password'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Accessor for First Name field value
     *
     * @param $value
     * @return string
     */
    public function getFirstnameAttribute($value) {
        return ucwords($value);
    }

    /**
     * Mutator for First Name field value
     *
     * @param $value
     */
    public function setFirstnameAttribute($value) {
        $this->attributes['firstname'] = strtolower($value);
    }

    /**
     * Accessor for Last Name field value
     *
     * @param $value
     * @return string
     */
    public function getLastnameAttribute($value) {
        return ucwords($value);
    }

    /**
     * Accessor for Last Name field value
     *
     * @param $value
     */
    public function setLastnameAttribute($value) {
        $this->attributes['lastname'] = strtolower($value);
    }

    /**
     * Accessor for Email field value
     *
     * @param $value
     */
    public function setEmailAttribute($value) {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * Relationship User - Role
     *
     * @return BelongsTo
     */
    public function role()
    {
       return $this->belongsTo('App\Role');
    }

    /**
     * Relationship User - Specialty
     *
     * @return BelongsTo
     */
    public function specialty()
    {
        return $this->belongsTo('App\Specialty');
    }

    /**
     * Relationship User - Hospitals
     *
     * @return BelongsToMany
     */
    public function hospitals()
    {
        return $this->belongsToMany('App\Hospital');
    }
}
