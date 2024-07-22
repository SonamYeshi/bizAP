<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationUserMap extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_user_fund_mapping';
    protected $fillable = [
        'fundappid',
        'userid'
    ];
}
