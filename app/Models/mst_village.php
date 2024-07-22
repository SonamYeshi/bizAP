<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mst_village extends Model
{
    protected $primaryKey='village_id';
    
    public function displayGewog()
    {
    	return $this->belongsTo('App\Gewog','gewog_id','gewog_id');
    }

}
