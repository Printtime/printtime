@extends('layouts.app')

@section('content')

<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12">

<h1>{{ $title or '' }}</h1>

	<table class="table table-hover">
		<thead>
			<tr>
			<th>Товары и услуги</th>
			@foreach($headers as $header)
				<th>
					{!! $header->label !!}<br>
					<small>{!! $header->title !!}</small>
				</th>
			@endforeach
			</tr>
		</thead>

	<tbody>
		@foreach($types as $type)
			<tr>
				<td><a style="color:#000" data-toggle="tooltip" data-html="true" data-placement="top" title="Что такое «{!! $type->order_name !!}»?" href="{!! route('catalog.product.show', ['catalog'=>$type->catalog_id, 'product'=>$type->product_id]) !!}">{!! $type->title !!}</a></td>
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

@endsection
