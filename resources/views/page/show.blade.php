@extends('layouts.app')

@section('content')
<div class="container">
<h1>{!! $page->title !!}</h1>
<div class="row">
	<div class="col-sm-12">{!! $page->text !!}</div>
</div>
</div>

@endsection
