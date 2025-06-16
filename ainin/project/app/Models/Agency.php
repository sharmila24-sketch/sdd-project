<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'agency';
    protected $primaryKey = 'UserID'; // since UserID is primary key
    public $incrementing = false; // if UserID is not auto increment
    public $timestamps = false;

    protected $fillable = [
        'UserID', 'AgencyCompany'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    public function inquiryAssignments()
    {
        return $this->hasMany(InquiryAssignment::class, 'UserID', 'UserID');
    }
}
