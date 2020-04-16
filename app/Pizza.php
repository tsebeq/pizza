<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pizza extends Model
{
    use SoftDeletes;
    protected $table = 'pizzas';
    protected $fillable = ['name', 'price'];
    
    public function get()
    {
        return Pizza::all();
    }
    
    public function setPrice()
    {
        $total = 0;
        if($this->ingredients()->exists()) {
            foreach($this->ingredients as $ingr) {
                $total += $ingr->cost;
            }
        }
        $this->price = round($total*1.5, 2)*100;
        return $this;
    }
    
    public function getPriceAttribute()
    {
        //$this->setPrice();
        return number_format($this->attributes['price']/100, 2);
    }
    
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
}
