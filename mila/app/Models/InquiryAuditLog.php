<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryAuditLog extends Model
{
    use HasFactory;

    protected $table = 'inquiryassignment';
    protected $primaryKey = 'AssignmentID';
    public $timestamps = false;

    protected $fillable = [
        'InquiryID', 'UserID', 'AssignmentDate', 'AssignmentNotes', 'AssignmentStatus',
    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class, 'InquiryID', 'InquiryID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }
}