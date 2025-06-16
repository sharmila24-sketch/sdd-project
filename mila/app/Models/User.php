<?php



namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Set primary key kepada UserID
    protected $primaryKey = 'UserID';

    // Jika bukan auto-increment, set ini ke false
    public $incrementing = false;

    // Jika key adalah string (e.g. UUID), guna 'string'. Jika masih integer, kekalkan 'int'
    protected $keyType = 'string'; // atau 'int' jika guna manual nombor

    protected $fillable = [
        'UserID',
        'name',
        'email',
        'password',
    ];
}

