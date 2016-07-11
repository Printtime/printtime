
        <div class="col-sm-4 col-md-3 menu">

                @foreach ($compose_catalog as $item)

                    @if($catalog->id == $item->id)
                        <h3>{!! link_to_route('catalog.show', $item->title, $item->id, ['class'=>'active']) !!}</h3>
                        <ul>
                        @foreach ($item->products as $product)
                            <li>{!! link_to_route('catalog.product.show', $product->title, [$catalog->id, $product->id]) !!}</li>
                        @endforeach
                        </ul>
                    @else
                        <h3>{!! link_to_route('catalog.show', $item->title, $item->id) !!}</h3>
                    @endif
                @endforeach
        </div>
