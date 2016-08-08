<meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>

<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/i18n/ru.js"></script>

<!-- 
<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/jquery.ui.plupload/jquery.ui.plupload.js"></script> 


<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/ui-lightness/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="/vendor/jildertmiedema/laravel-plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" />


<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/jquery.ui.plupload/jquery.ui.plupload.min.js"></script>


 -->


<div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
<!-- <input id="filefield1" type="text" value=""> -->
<br />
 
<div id="container">
    <a id="pickfiles" href="javascript:;">Выбрать файл для загрузки</a>
</div>
 
    <a id="uploadfiles" href="javascript:;">Загрузить файл</a> 

<br />
<pre id="console"></pre>
 
 
<script type="text/javascript">
// Custom example logic
 
var uploader = new plupload.Uploader({
    runtimes : 'html5,flash,silverlight,html4',
     
    browse_button : 'pickfiles', // you can pass in id...
    container: document.getElementById('container'), // ... or DOM Element itself
     

        url : "{{ action('FilePrintController@upload') }}",
 
		 headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
     
    filters : {

    	//min_file_size: "100kb",
        max_file_size : '20mb',
        chunk_size: '1mb',
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
	//multi_selection: false,
 
    init: {
        PostInit: function() {
            document.getElementById('filelist').innerHTML = '';
 			//$('#filelist').html('');

 			document.getElementById('uploadfiles').onclick = function() {
                uploader.start();
                return false;
            };

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
             plupload.each(files, function(file) {
                  document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
              });

        	//up.start();

        },
 
        UploadProgress: function(up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            
            //document.getElementById(file.id).innerHTML = file.percent + "%";
            //$('.progress-bar').html(file.percent + "%");
        },
 
        Error: function(up, err) {
            document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
        }
    }
});
 
uploader.init();
 
</script>





<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/jquery.ui.plupload/jquery.ui.plupload.js"></script> -->

<!-- 
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/ui-lightness/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="/vendor/jildertmiedema/laravel-plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/jquery.ui.plupload/jquery.ui.plupload.min.js"></script>

<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/i18n/ru.js"></script>

 <div id="uploader">
    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
</div>
 
<script type="text/javascript">
// Initialize the widget when the DOM is ready
$(function() {
    $("#uploader").plupload({
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url : "{{ action('FilePrintController@upload') }}",
 
		 headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },

        // Maximum file size
        max_file_size : '2000mb',
 
        chunk_size: '2mb',
 
        // Resize images on clientside if we can
        // resize : {
        //     width : 200,
        //     height : 200,
        //     quality : 90,
        //     crop: true // crop to exact dimensions
        // },
 
        // Specify what files to browse for
        filters : [
            {title : "Image files", extensions : "jpg,gif,png"},
            {title : "Zip files", extensions : "zip,avi,mts"}
        ],
 
        // Rename files by clicking on their titles
        rename: true,
         
        // Sort files
        sortable: true,
 
        // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
        dragdrop: true,
 
        // Views to activate
        // views: {
        //     list: true,
        //     thumbs: true, // Show thumbs
        //     active: 'thumbs'
        // },
 
        // Flash settings
        flash_swf_url : '/vendor/jildertmiedema/laravel-plupload/js/Moxie.swf',
     
        // Silverlight settings
        silverlight_xap_url : '/vendor/jildertmiedema/laravel-plupload/js/Moxie.xap'
    });



});
</script>
 -->

{{--
Plupload::init([
    'url' => action('FilePrintController@upload'),
    'chunk_size' => '5Mb',
])->withPrefix('current')->createHtml()
--}}


{{-- Plupload::make([
	'url' => action('FilePrintController@upload'),

	'runtimes' => 'html5',
	'chunk_size' => '1Mb',
	'max_file_size' => '20Mb',

		'filters' => [
		  'mime_types' => [
		    [ 'title' => "Image files", 'extensions' => "jpg,gif,png" ],
		    [ 'title' => "Zip files", 'extensions' => "zip" ]
		  ],

		  'prevent_duplicates' => true,
		],

		'views' => ['list' => 'true',
				'thumbs' => 'true',
				'active' => 'thumbs'],

		'flash_swf_url' => '/vendor/jildertmiedema/laravel-plupload/js/Moxie.swf',
        'silverlight_xap_url' => '/vendor/jildertmiedema/laravel-plupload/js/Moxie.xap',

]) --}}
 


