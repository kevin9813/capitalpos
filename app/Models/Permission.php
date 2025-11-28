<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    //
    use HasFactory;
    protected $table = "permissions";
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions',
            'permission_id',     // FK hacia permissions
            'role_id'            // FK hacia roles
        );
    }
    
}
