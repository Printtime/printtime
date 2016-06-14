<footer class="footer">
      <div class="container">
        @foreach ($compose_catalog->chunk($compose_catalog->count()/3) as $item)
            <div class="col-md-4">
                @foreach ($item as $catalog)
                    <h3>{!! link_to_route('catalog.show', $catalog->title, $catalog->id) !!}</h3>
                    @foreach ($catalog->products as $product)
                        {!! link_to_route('product.show', $product->title, $product->id) !!}<br>
                    @endforeach
                @endforeach
            </div>
        @endforeach
      </div>
</footer>