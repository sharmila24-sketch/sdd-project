<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $table = 'inquiries';
    protected $primaryKey = 'InquiryID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'UserID',
        'InquiryTitle',
        'InquiryDescription',
        'InquiryEvidance',
        'InquiryStatus',
        'AssignedAgency',
        'InquiryDate',
        'is_public',
        'InquiryCategory'
    ]; // ✅ Properly close this array

    public function assignedAgency()
{
    return $this->belongsTo(User::class, 'AssignedAgency', 'UserID');
}


    public function user()
{
    return $this->belongsTo(User::class, 'UserID');
}


}
