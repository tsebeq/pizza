<?php

namespace App\Http\Controllers;

use App\Pizza;
use App\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($data = [])
    {
        //dd($data);
        return view('pizza', array_merge([
            'pizzas' => (new Pizza)->get(),
            'ingredients' => (new Ingredient)->get()
        ], $data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'ingredients.*' => 'integer'
        ]);

        $product = new Pizza;
        Log::debug('Pizza ', [$request->input()]);
        if($same = Pizza::withTrashed()->where('name', $request->name)->first()) {
            if ($same->trashed()) {
                $same->restore();
            }
            $product = $same;
        } else {
            $product->name = $request->name;
            $product->save();
        }
        //
        $ingredients = Ingredient::find($request->ingredients);
        $product->ingredients()->detach();
        $product->ingredients()->attach($ingredients);
        $product->setPrice()->save();
        return redirect('pizza')->withErrors([$product->name . ' updated']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function show(Pizza $pizza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pizza  $pizza
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pizza $pizza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pizza $pizza)
    {
        //
    }
}
