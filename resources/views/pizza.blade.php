@include('partials.header')

<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-12">
                <h4>Manage pizza</h4>
                <p>Add or edit pizza</p>
            </div>
            <div class="col-12">
                <form method="POST" action="/pizza">
                    <input class="form-control" name="name" type="text" placeholder="Name" value="@isset($preset) {{ $preset['name'] }} @endisset">
                    <select class="form-control" name="ingredients[]" multiple>
                        @foreach($ingredients as $ingr)
                        <option @if(isset($preset['ingredients']) && in_array($ingr->id, $preset['ingredients'])) selected @endif value="{{ $ingr->id }}">{{ $ingr->name }}</option>
                        @endforeach
                    </select>
                    <input class="btn btn-primary" type="submit" value="Submit">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-12"><h4>Pizzas list</h4></div>
            <div class="col-3">Name</div>
            <div class="col-2">Price, €</div>
            <div class="col-5">Ingredients</div>
            <div class="col-2">Delete</div>
        </div>
        @foreach ($pizzas as $pizza)
        <div class="row">
            <div class="col-3">
                <a href="/pizza/{{ $pizza->name }}">{{ $pizza->name }}</a>
            </div>
            <div class="col-2">
                {{ $pizza->price }}
            </div>
            <div class="col-5">
                @foreach ($pizza->ingredients as $ingr)
                    {{ $ingr->name }}
                @endforeach
            </div>
            <div class="col-2 delete">
                <a href="/pizza/remove/{{ $pizza->id }}" >X</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include('partials.footer')
