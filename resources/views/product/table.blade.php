@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
 

<style type="text/css">

tr.group,
tr.group:hover {
    background-color: #f1672a !important;
    color:#fff;
}

</style>


<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12">

<h1>{{ $title or '' }}</h1>

	<table id="example" class="table table-striped table-hover">
		<thead>
			<tr>
			<th style="width: 400px;">Товары и услуги</th>
			<th>Название</th>
			@foreach($headers as $header)
				<th>
					{!! $header->label !!}<br>
					<small style="color:#777; font-weight:300">{!! $header->title !!}</small>
				</th>
			@endforeach
			</tr>
		</thead>


	<tbody>
		@foreach($types as $type) 
				<tr>
					<td><a style="color:#000" data-toggle="tooltip" data-html="true" data-placement="top" title="Что такое «{!! $type->products_title !!}»?" href="{!! route('catalog.product.show', ['catalog'=>$type->catalog_id, 'product'=>$type->product_id]) !!}">{!! $type->title !!}</a></td>
					
					<td>{!! $type->products_title !!}</td>

							@if(isset($type->res))
							@foreach($type->res as $r)
								@if($r != 'no-data')
												<td>
													@if(auth()->user()->discount > 0)
														<a data-toggle="tooltip" data-html="true" href="{!! route('order.create', $r->type_var_id) !!}" data-placement="top" title="<span class='label label-success'>-{!! auth()->user()->discount !!}% скидка</span> <h4>{!! $r->price -  $r->price * auth()->user()->discount / 100 !!} грн.</h4>">{!! $r->price !!}</a>
													@else
														<a href="{!! route('order.create', $r->type_var_id) !!}">{!! $r->price !!}</a>
													@endif
												</td>
									@else
									<td>-</td>
								@endif
							@endforeach
							@endif
				</tr>
				
		@endforeach
	</tbody>



	</table>

</div>
</div>
</div>



  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/v/bs-3.3.6/dt-1.10.12/datatables.min.js"></script>
  <script type="text/javascript">

    var table = $('#example').DataTable({

    	"searching": false,
    	"paging": false,
    	"bInfo" : false,


        "columnDefs": [
            { "visible": false, "targets": 1 }
        ],
        "order": [[ 1, 'asc' ]],
        "displayLength": 100,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="10" style="font-weight: bold">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 
    // Order by the grouping
  /*
    $('#example tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 1 && currentOrder[1] === 'asc' ) {
            table.order( [ 1, 'desc' ] ).draw();
        }
        else {
            table.order( [ 1, 'asc' ] ).draw();
        }
    } );

    */
  </script>


@endsection
