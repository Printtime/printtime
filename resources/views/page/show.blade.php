@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-sm-12">
                    	<h3>{!! $page->title !!}</h3>
                      {!! $page->text !!}

        </div>
  </div>
</div>

@endsection
