<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryAssignment extends Model
{
    protected $table = 'inquiryassignment'; // ✅ Add this line
    protected $primaryKey = 'AssignmentID';
    public $timestamps = false;

    protected $fillable = [
        'InquiryID', 'UserID', 'AssignmentDate', 'AssignmentNotes', 'AssignmentStatus', 'AssignmentType', 'AssignmentAgency'
    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class, 'InquiryID', 'InquiryID');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'UserID', 'UserID');
    }
}
