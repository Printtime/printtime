

<div class="col-md-6 file{{$side}}_block">
    <div id="console{{$side}}"></div>

    <div id="container{{$side}}">
        <button type="button" class="btn btn-lg" style="width:100%" id="pickfiles{{$side}}" href="javascript:;">
          <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <div id="filelist{{$side}}">{{ $side_name }}</div>
        </button>
    </div>


<input id="width_file{{$side}}" type="hidden" name="width_file{{$side}}" value="">
<input id="height_file{{$side}}" type="hidden" name="height_file{{$side}}" value="">


</div>