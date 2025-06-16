<?php

// app/Models/Agency.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'agency';
    protected $primaryKey = 'UserID';
    public $timestamps = false;
    public function assignedInquiries()
{
    return $this->hasMany(Inquiry::class, 'AssignedAgency', 'UserID');
}

}

