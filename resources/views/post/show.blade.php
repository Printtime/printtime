@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-sm-12">
                      <h3>{!! $post->title !!}</h3>
                      {!! $post->text !!}

        </div>
  </div>
</div>

@endsection
