<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mst_gewog extends Model
{
    protected $primaryKey='gewog_id';
    
    public function displayDzongkhag()
    {
    	return $this->belongsTo('App\mstdzongkhag','dzongkhag_id','dzongkhag_id');
    }
}
