@include('partials.header')

<form method="POST" action="/pizza">
    <input name="name" type="text" value="@isset($preset) {{ $preset['name'] }} @endisset">
    <select name="ingredients[]" multiple>
        @foreach($ingredients as $ingr)
        <option @if(isset($preset['ingredients']) && in_array($ingr->id, $preset['ingredients'])) selected @endif value="{{ $ingr->id }}">{{ $ingr->name }}</option>
        @endforeach
    </select>
    <input type="submit" name="Add">
    @csrf
</form>

@foreach ($pizzas as $pizza)
<div class="">
    <div class="">
        <a href="/pizza/{{ $pizza->name }}">{{ $pizza->name }}</a>
    </div>
    <div class="">
        {{ $pizza->price }}
    </div>
    <div class="delete">
        <a href="/pizza/remove/{{ $pizza->id }}" >X</a>
    </div>
</div>
@endforeach
@include('partials.footer')
