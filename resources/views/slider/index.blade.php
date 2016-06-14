
<div class="container-fluid">

<div class="row">

  <div id="myCarousel" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
      @for ($i = 0; $i < count($slider); $i++)
         <li data-target="#myCarousel" data-slide-to="{{ $i }}" @if($i == 0) class="active" @endif ></li> 
      @endfor
    </ol>

    <div class="carousel-inner" role="listbox">

    @foreach($slider as $key => $slide)

      <div class="item {{ ($key == 0 ? 'active' : '') }}">
        <a href="{!! $slide->link !!}"><img src="/{!! $slide->slider !!}" alt=""></a>
      </div>
    @endforeach

    </div>

    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

</div>

</div>
