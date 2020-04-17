@include('partials.header')

<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-12">
                <h4>Manage ingredient</h4>
                <p>Add or edit ingredient</p>
            </div>
            <div class="col-12">
                <form method="POST" action="/ingredient">
                    <input class="form-control" name="name" type="text" placeholder="Name" value="@isset($preset) {{ $preset['name'] }} @endisset">
                    <input class="form-control" name="cost" type="text" placeholder="Price" value="@isset($preset) {{ $preset['cost'] }} @endisset">
                    <input class="btn btn-primary" type="submit" value="Submit">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-12"><h4>Ingredient list</h4></div>
            <div class="col-5">Name</div>
            <div class="col-5">Price, €</div>
            <div class="col-2">Delete</div>
        </div>
        @foreach ($ingredients as $ingr)
        <div class="row">
            <div class="col-5">
                <a href="/ingredient/{{ $ingr->name }}">{{ $ingr->name }}</a>
            </div>
            <div class="col-5">
                {{ $ingr->cost }}
            </div>
            <div class="col-2 delete">
                <a href="/ingredient/remove/{{ $ingr->id }}" >X</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include('partials.footer')
