<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display ingredient list
     *
     * @return view
     */
    public function index($data = [])
    {
        return view('ingredient', array_merge([
            'ingredients' => (new Ingredient)->get()
        ], $data));
    }


    /**
     * Creates or updates ingredient
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function store(Request $request)
    {        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'cost' => 'required|numeric',
        ]);

        if($same = Ingredient::withTrashed()->where('name', $request->name)->first()) {
            $same->update(['cost' => $request->cost*100]);
            if ($same->trashed()) {
                $same->restore();
            }
            return redirect('ingredient')->with('success', $same->name . ' updated');
        } else {
            $current = Ingredient::create([
                'name' => $request->name,
                'cost' => $request->cost*100
            ]);
            return redirect('ingredient')->with('success', $current->name . ' added');
        }
    }

    /**
     * Returns ingredient data to view by name
     * 
     * @param string name
     * @return view
     */
    public function edit($name)
    {
        $current = Ingredient::where('name', $name)->first();
        $preset = [
            'preset' => [
                'name' => $current->name,
                'cost' => $current->cost
            ]
        ];
        return $this->index($preset);
    }

    /**
     * Soft deletes ingredient by id
     * 
     * @param integer $id
     * @return type
     */
    public function remove($id)
    {
        $msg_type = 'warning';
        $msg = 'Ingredient not found';
        if($ingredient = Ingredient::find($id)) {
            $msg_type = 'success';
            $msg = $ingredient->name . ' removed from ingredients';
            $ingredient->delete();
        }
        return redirect('ingredient')->with($msg_type, $msg);
    }
}
