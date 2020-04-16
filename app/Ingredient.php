<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Ingredient extends Model
{
    use SoftDeletes;
    protected $table = 'ingredients';
    protected $fillable = ['name', 'cost'];
    
    protected static function booted()
    {
        static::updated(function($ingredient) {
            foreach($ingredient->pizzas as $pizza) {
                $pizza->setPrice()->save();
            }
        });
    }
    
    public function get()
    {
        return Ingredient::where('cost', '>', 0)->get();
    }
    
    public function getCostAttribute()
    {
        return number_format($this->attributes['cost']/100, 2);
    }
    
    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class);
    }
}
