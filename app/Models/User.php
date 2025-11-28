<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "users";
    protected $primaryKey = 'id';
    public $timestamps = true;

    
    protected $fillable = [
        'name',
        'usuario',
        'password',
        'company_id',
        'status',
        'role_id',
    ];
   

    public function role()
    {
        return $this->belongsTo(Roles::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function cashShifts()
    {
        return $this->hasMany(CashShift::class, 'user_id');
    }
}
