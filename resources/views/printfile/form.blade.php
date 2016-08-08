@extends('layouts.app')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>

<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/i18n/ru.js"></script>


<div class="container">
	<div class="row">
	    <div class="col-md-12">



<!-- <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
 -->
<div id="console"></div>


<div id="container">
	<button type="button" class="btn btn-success btn-lg" id="pickfiles" href="javascript:;">
	  <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <div id="filelist">Загрузить лицевую сторону</div>
	</button>

</div>


</div></div></div>
 
<script type="text/javascript">
// Custom example logic
 
var uploader = new plupload.Uploader({
    runtimes : 'html5,flash,silverlight,html4',
     
    browse_button : 'pickfiles', // you can pass in id...
    container: document.getElementById('container'), // ... or DOM Element itself
     

        url : "{{ route('printfile.upload') }}",
 
		 headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
     
    filters : {

    	//min_file_size: "100kb",
        max_file_size : '2048000kb',
        chunk_size: '5120kb',
        //chunk_size: '512kb',

        mime_types: [
            {title : "Image files", extensions : "jpg,gif,png"},
            {title : "Zip files", extensions : "zip"}
        ]
    },


    // Flash settings
    flash_swf_url : '/vendor/jildertmiedema/laravel-plupload/js/Moxie.swf',
 
    // Silverlight settings
    silverlight_xap_url : '/vendor/jildertmiedema/laravel-plupload/js/Moxie.xap',
     
      //dragdrop: true,
	//multipart: false,
	multi_selection: false,
 
    init: {
        PostInit: function() {
            //document.getElementById('filelist').innerHTML = '';

 			//$('#filelist').html('');

/*
 			document.getElementById('uploadfiles').onclick = function() {
                uploader.start();
                return false;
            };
            */

 			/*
            document.getElementById('uploadfiles').onclick = function() {
                uploader.start();
                return false;
            };
            */
        },
 
        FilesAdded: function(up, files) {


			//document.getElementById('filelist').innerHTML = '<div id="' + files[0].id + '">' + files[0].name + ' (' + plupload.formatSize(files[0].size) + ') <b></b></div>';
			// $('#filelist').html("<div class=\"progress\"><div id=\"' + files[0].id + '\" class=\"progress-bar progress-bar-striped active\" role=\"progressbar\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:0%\">0%</div></div>");
/*$('#filelist').html("<div class=\"progress\"><div class=\"progress-bar progress-bar-striped active\" role=\"progressbar\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:0%\">0%</div></div>");*/
			
			//document.getElementById('filelist').innerHTML += '<div id="' + files[0].id + '">' + files[0].name + ' (' + plupload.formatSize(files[0].size) + ') <b></b></div>';

			//$('#filelist').html(files[0].name);
        	//console.log(files[0].name);	
        	//$('#filefield1').val(file.name);

                  res_data = '<div id="' + files[0].id + '">' + files[0].name + ' (' + plupload.formatSize(files[0].size) + ') <b></b></div>';
                  $('#filelist').html(res_data);

             /*
             plupload.each(files, function(file) {
                  document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
              });
*/
        	up.start();

        },
 
        UploadProgress: function(up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            document.getElementById('console').innerHTML = '';
            //document.getElementById(file.id).innerHTML = file.percent + "%";
            //$('.progress-bar').html(file.percent + "%");
        },
 
        Error: function(up, err) {

            document.getElementById('console').innerHTML = '<div class="console alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+ err.message +'</div>';

            //document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
        }
    }
});
 
uploader.init();
 
</script>


{{--
<div class="container">
	<div class="row">
	    <div class="large-12 column">
				{!! Plupload::init([
				    'url' => route('printfile.upload'),
				    'chunk_size' => '5120kb',
				    'multi_selection' => false,
				    'filters' => [
				    	'mime_types' => [
				    		['title' => "Zip files", 'extensions' => "zip"],
				    	],
				    	'max_file_size'=> '2048000kb',
				    ],
				    'autostart' => true,
				])->withPrefix('printtime')->createHtml(); !!}
	    </div>
	</div>
</div>


<!-- 
<div class="container">
	<div class="row">
	    <div class="large-12 column">
	        <p>Chunk Size: 1mb (1048576 bytes)</p>
	        <input type="number" min="1048576" value="1048576" id="numChunks" />
	        <input type="file" id="afile" />
	        <div id="done"></div>
	        <div id="bars"></div>
	    </div>
	</div>
</div> -->

--}}

@endsection
