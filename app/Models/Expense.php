<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Expense extends Model
{
    use HasFactory;
    protected $table = "expenses";
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['cash_shift_id','description','price','status'];
}
