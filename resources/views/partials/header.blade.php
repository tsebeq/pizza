<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <title>Pizzas catalog</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/pizza">Pizzas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ingredient">Ingredients</a>
                        </li>
                    </ul>
                </nav>
                @if (@isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if (session($msg))
                        <div class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</div>
                    @endif
                @endforeach