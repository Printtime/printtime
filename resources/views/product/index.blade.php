@extends('layouts.app')

@section('content')

<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12">





@foreach($products as $product)

<table class="table table-hover">

	<thead>
		<tr>
		<th>{!! $product->title !!}</th>

@foreach($product->types as $type)
	@foreach($typevars as $typevar)
		@if($type->id == $typevar->type_id)
			{!! collect($typevar)->groupBy('var_id') !!}
		@endif
	@endforeach
@endforeach

	{{--

@foreach($typevars as $typevar)
	@foreach($vars as $var)
			@if($var->id == $typevar->var_id)
					@foreach($product->types as $type)
						@foreach($typevarsHeaders as $typevarsHeader)
							@if($type->id == $typevarsHeader->type_id)
								<th>{!! $var->title !!}</th>
							@endif
						@endforeach
					@endforeach
			@endif
	@endforeach
@endforeach



	
		@foreach($typevarsHeader as $typevar)

			@foreach($product->types as $type)


				@foreach($vars as $var)

							@if($var->id == $typevar->var_id AND $type->id == $typevar->type_id)
									<th>{!! $var->title !!}</th>
							@endif

				@endforeach
			@endforeach

		@endforeach
		--}}
		</tr>
	</thead>
	<tbody>

	@foreach($product->types as $type)
			
				<tr>
					<td>{!! $type->title !!}</td>

				@foreach($typevars as $typevar)
								@if($type->id == $typevar->type_id)
									@foreach($vars as $var)
											@if($var->id == $typevar->var_id)
														<td>
														@if(auth()->user()->discount > 0)
															<a data-toggle="tooltip" data-html="true" href="{!! $typevar->id !!}" data-placement="top" title="<span class='label label-success'>-{!! auth()->user()->discount !!}% скидка</span> <h4>{!! $typevar->price -  $typevar->price * auth()->user()->discount / 100 !!} грн.</h4>">{!! $typevar->price !!}</a>
														@else
															<a href="#">{!! $typevar->price !!}</a>
														@endif
															</td>
											@endif
									@endforeach
								@else

									@foreach($product->types as $type)
										@if($type->id == $typevar->type_id)<td>-</td>@endif
									@endforeach

								@endif
				@endforeach

				</tr>
	@endforeach


	</tbody>
</table>


<hr>

@endforeach




</div>
</div>
</div>

@endsection
