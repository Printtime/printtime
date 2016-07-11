<footer class="footer">
      <div class="container">


        <div class="row">
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

      </div>


</footer>

<div class="top-container">
    <div class="container">
            <div class="col-md-12 top-contacts text-center">Украина, г.Кривой Рог, ул. Волгоградская, 12 <i class="icon logo-icon"></i> (067) 812 81 11 

        </div>
    </div>
</div>
