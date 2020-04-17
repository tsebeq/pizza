<?php

namespace App\Http\Controllers;

use App\Pizza;
use App\Ingredient;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    /**
     * Display pizzas list
     *
     * @return view
     */
    public function index($data = [])
    {
        return view('pizza', array_merge([
            'pizzas' => (new Pizza)->get(),
            'ingredients' => (new Ingredient)->get()
        ], $data));
    }

    /**
     * Creates or updates pizza
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'ingredients' => 'required'
        ]);

        $product = new Pizza;
        if($same = Pizza::withTrashed()->where('name', $request->name)->first()) {
            if ($same->trashed()) {
                $same->restore();
            }
            $product = $same;
            $msg = 'updated';
        } else {
            $product->name = $request->name;
            $product->save();
            $msg = 'created';
        }
        
        $ingredients = Ingredient::find($request->ingredients);
        $product->ingredients()->detach();
        $product->ingredients()->attach($ingredients);
        $product->setPrice()->save();
        
        return redirect('pizza')->with('success', $product->name . ' ' . $msg);
    }

    /**
     * Returns pizzas data to view by name
     *
     * @param  string  $pizza_name
     * @return view
     */
    public function edit($pizza_name)
    {
        $current = Pizza::where('name', $pizza_name)->first();
        $preset = [
            'preset' => [
                'name' => $current->name,
                'ingredients' => $current->ingredients->pluck('id')->toArray()
            ]
        ];
        return $this->index($preset);
    }

    /**
     * Soft deletes pizza by id
     * 
     * @param integer $id
     * @return type
     */
    public function remove($id)
    {
        $msg_type = 'warning';
        $msg = 'Pizza not found';
        if($pizza = Pizza::find($id)) {
            $msg_type = 'success';
            $msg = $pizza->name . ' removed from list';
            $pizza->delete();
        }
        return redirect('pizza')->with($msg_type, $msg);
    }
}
