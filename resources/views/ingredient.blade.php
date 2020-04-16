@include('partials.header')

<form method="POST" action="/ingredient">
    <input name="name" type="text" value="@isset($preset) {{ $preset['name'] }} @endisset">
    <input name="cost" type="text" value="@isset($preset) {{ $preset['cost'] }} @endisset">
    <input type="submit" name="Add">
    @csrf
</form>

@foreach ($ingredients as $ingr)
<div class="">
    <div class="">
        <a href="/ingredient/{{ $ingr->name }}">{{ $ingr->name }}</a>
    </div>
    <div class="">
        {{ $ingr->cost }}
    </div>
    <div class="delete">
        <a href="/ingredient/remove/{{ $ingr->id }}" >X</a>
    </div>
</div>
@endforeach
@include('partials.footer')
