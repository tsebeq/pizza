<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pizzas catalog</title>
    </head>
    <body>
        <div class="wrapper">
            <div clas="row">
                <div class="col-6">
                    <a href="/pizza">Pizzas</a>
                </div>
                <div class="col-6">
                    <a href="/ingredient">Ingredients</a>
                </div>
            </div>
            @if (@isset($errors) && $errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif