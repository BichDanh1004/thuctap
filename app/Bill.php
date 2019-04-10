<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
  protected $table="bills";
  protected $primaryKey= "id_bill";
  protected $fillable = ['date_order', 'total', 'payment', 'created_at'];
  public function products(){
    return $this->belongsToMany('App\Product','bill_details','id_bill','id_product')->withPivot('id_bill_detail','quantity','total');
}
public function users(){
    return $this->belongsTo('App\User','id_customer','id_bill');
}
}
