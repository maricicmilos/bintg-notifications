<?php

namespace App;

use App\Helpers\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'serial_number', 'image_path'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Accessor for Name field value
     *
     * @param $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Many-to-Many relationship - Get All Users for dedicated Hospital
     *
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get Path to Hospital Profile Image Location
     *
     * @param $value
     * @return string
     */
    public function getImagePathAttribute($value){
        return Image::HOSPITAL_MODEL_PATH . $value;
    }

}
