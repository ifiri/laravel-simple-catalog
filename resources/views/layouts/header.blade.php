@section('header')
<div class="header bg-light">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a href="{{ route('root') }}" class="brand">Goods</a>
        <form class="search my-2 my-lg-0" method="GET" action="{{ route('search') }}">
            <input name="searchstring" class="search__input form-control mr-sm-2" type="search" placeholder="Search" value="{{ $searchstring }}">
            <button class="search__submit btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav>
</div>
@endsection