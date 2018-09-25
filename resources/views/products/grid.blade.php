@section('grid')
<div class="row">
    @forelse ($products as $product)
        <div class="card product">
          <img class="card-img-top product__thumbnail" src="{{ $product->image }}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title product__title">{{ $product->title }}</h5>
            <p class="card-text product__description">
                {{ str_limit($product->description, $limit = 150, $end = '...') }} 
            </p>

            <div class="product__category">
                <b>Категории:</b>

                @forelse ($product->categories as $category)
                    <a href="{{ route('category', $category->alias) }}">{{ $category->title }}</a>
                @empty
                    <span>No categories</span>
                @endforelse
            </div>
            
            <b>Количество покупок: {{ $product->sum }}</b>
            <a href="{{ $product->url }}" class="btn btn-primary">Смотреть на Markethot</a>
          </div>
        </div>
    @empty
        <p>No products</p>
    @endforelse
<div>
@endsection