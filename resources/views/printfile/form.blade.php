
<?php
if(isset($order)) {
	$file = $order->userfiles($side);
}
?>

<div class="col-md-6 file{{$side}}_block">
    <div id="console{{$side}}"></div>

    <div id="container{{$side}}">
        <button type="button" class="btn btn-lg" style="width:100%" id="pickfiles{{$side}}" href="javascript:;">
            @if(isset($file))<div class="text-center thumbnail"><img src="{{ route('system.tiff2jpg', ['filename' => $file->filename]) }}"></div>@endif
          <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <div id="filelist{{$side}}">{{ $file->name or $side_name }}</div>
        </button>
    </div>

@if(isset($file))
<input id="width_file0" type="hidden" name="width_file0" value="{{ $file->width or null }}">
<input id="height_file0" type="hidden" name="height_file0" value="{{ $file->height or null }}">
@else
<input id="width_file{{$side}}" type="hidden" name="width_file{{$side}}" value="{{ $file->width or null }}">
<input id="height_file{{$side}}" type="hidden" name="height_file{{$side}}" value="{{ $file->height or null }}">
@endif

</div>