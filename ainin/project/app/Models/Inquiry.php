<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiry';
    protected $primaryKey = 'InquiryID';
    public $incrementing = false;  // because it's varchar, not int
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'UserID', 'InquiryTitle', 'InquiryDetails', 'InquiryDescription', 'InquiryDate', 'InquiryStatus', 'InquiryCategory', 'InquiryHistory'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    public function inquiryAssignments()
    {
        return $this->hasMany(InquiryAssignment::class, 'InquiryID', 'InquiryID');
    }
}
