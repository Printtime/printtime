
<a id="back-to-top" href="#" class="btn btn-lg back-to-top" role="button" title="Наверх!" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

<div class="modal fade" id="open-modal" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"></div></div>


    <!-- JavaScripts -->
<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="/js/wow.min.js"></script>
    <script src="/js/js.js"></script> -->
    
    <script src="{{ elixir('js/app.js') }}"></script>


    <footer class="footer">
      <div class="container">


        <div class="row">
        @foreach ($compose_catalog->chunk($compose_catalog->count()/3) as $item)
            <div class="col-md-4">
                @foreach ($item as $catalog)
                    <h3>{!! link_to_route('catalog.show', $catalog->title, $catalog->id) !!}</h3>
                    @foreach ($catalog->products as $product)
                        {!! link_to_route('catalog.product.show', $product->title, [$catalog->id, $product->id]) !!}<br>
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
