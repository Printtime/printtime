

<div class="col-md-6 file{{$side}}_block">
    <div id="console{{$side}}"></div>

    <div id="container{{$side}}">
        <button type="button" class="btn btn-lg" style="width:100%" id="pickfiles{{$side}}" href="javascript:;">
            @if(isset($order->files[$side]))<div class="text-center thumbnail"><img src="{{ route('system.tiff2jpg', ['filename' => $order->files[$side]->filename]) }}"></div>@endif
          <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <div id="filelist{{$side}}">{{ $order->files[$side]->name or $side_name }}</div>
        </button>
    </div>

@if(isset($order->files[$side]))
<input id="width_file{{$side}}" type="hidden" name="width_file{{$side}}" value="{{ $order->files[$side]->width or null }}">
<input id="height_file{{$side}}" type="hidden" name="height_file{{$side}}" value="{{ $order->files[$side]->height or null }}">
@endif

</div>