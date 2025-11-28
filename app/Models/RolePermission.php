<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class RolePermission extends Model
{
    use HasFactory;
    protected $table = "role_permissions";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['role_id', 'permission_id'];

    public function permissions(){
        return $this->belongsTo(Permission::class, 'role_id', 'id');
    }

}
