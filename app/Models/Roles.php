<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Roles extends Model
{
    use HasFactory;
    protected $table = "roles";
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    
    public function users(){
        return $this->hasMany(User::class, 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 
            'role_id',           // columna FK hacia roles
            'permission_id'      // columna FK hacia permissions
        );
    }
    
}
