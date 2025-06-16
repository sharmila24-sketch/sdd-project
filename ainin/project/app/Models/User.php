<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'UserID';
    public $timestamps = false; // adjust if your table doesn't have timestamps

    protected $fillable = [
        'UserName', 'UserEmail', 'UserPassword'
    ];

    protected $hidden = [
        'UserPassword',
    ];

    // One user can have many inquiries
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'UserID', 'UserID');
    }

    // One user can be an agency (one-to-one)
    public function agency()
    {
        return $this->hasOne(Agency::class, 'UserID', 'UserID');
    }

    // One user can have many assignments (if agency user)
    public function inquiryAssignments()
    {
        return $this->hasMany(InquiryAssignment::class, 'UserID', 'UserID');
    }
}
