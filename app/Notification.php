<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subject',
        'notification_content'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Many to Many Relationship - Notification Specialties
     *
     * @return BelongsToMany
     */
    public function specialties()
    {
        return $this->belongsToMany('App\Specialty');
    }
}
