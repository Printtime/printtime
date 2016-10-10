
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>

<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="/vendor/jildertmiedema/laravel-plupload/js/i18n/ru.js"></script>

<style type="text/css">
    /*#container1 input, #container2 input { font-size: 0px !important; cursor: pointer !important;  }*/
</style>

    <input id="file1" type="hidden" name="file1">
    <input id="file2" type="hidden" name="file2">


<div class="container">
	<div class="row">

<div class="col-md-6 file1_block">

    <div id="console"></div>


    <div id="container1">
        <button type="button" class="btn btn-lg" id="pickfiles1" href="javascript:;">
          <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <div id="filelist1">Загрузить лицевую сторону *</div>
        </button>
    </div>

    <ul id="valid_file1"></ul>

</div>

<div class="col-md-6 file2_block">

    <div id="console2"></div>

    <div id="container2">
        <button type="button" class="btn btn-lg" id="pickfiles2" href="javascript:;">
          <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <div id="filelist2">Загрузить обратную сторону</div>
        </button>
    </div>

    <ul id="valid_file2"></ul>

</div>

</div></div>
 
<script type="text/javascript">

var uploader = new plupload.Uploader({
    runtimes : 'html5,flash,silverlight,html4',
     
    browse_button : 'pickfiles1',
    container: document.getElementById('container1'), 
     
        url : "{{ route('printfile.upload') }}",
    
        chunk_size: '1mb',

         headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
     
    filters : {

        max_file_size : '2048000kb',
        mime_types: [
            {title : "Tiff files", extensions : "tif,tiff"},
            //{title : "Image files", extensions : "jpg,gif,png"}
        ]
    },

    flash_swf_url : '/vendor/jildertmiedema/laravel-plupload/js/Moxie.swf',
    silverlight_xap_url : '/vendor/jildertmiedema/laravel-plupload/js/Moxie.xap',
     
    multi_selection: false,
 
    init: {
        PostInit: function() {
        },
 
        FilesAdded: function(up, files) {
            res_data = '<div id="' + files[0].id + '">' + files[0].name + ' - ' + plupload.formatSize(files[0].size) + ' - <b></b></div>';
            $('#filelist1').html(res_data);
            up.start();
        },
 
        UploadProgress: function(up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            document.getElementById('console').innerHTML = '';
        },
    

        FileUploaded: function(up, file, response) {
            
        res = JSON.parse(response.response);
            $( "#file1" ).val( res.result.fname );

            $( "#valid_file1" ).html('');
            $.each( res.result, function( key, value ) {
                $( "#valid_file1" ).append( '<li>'+key+': '+value+'</li>' );
            });
        },

        Error: function(up, err) {

            document.getElementById('console').innerHTML = '<div class="console alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+ err.message +'</div>';
        }
    }
});


var uploader2 = new plupload.Uploader({
    runtimes : 'html5,flash,silverlight,html4',
     
    browse_button : 'pickfiles2',
    container: document.getElementById('container2'), 
     
        url : "{{ route('printfile.upload') }}",
    
        chunk_size: '1mb',

         headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
     
    filters : {

        max_file_size : '2048000kb',
        mime_types: [
            {title : "Tiff files", extensions : "tif,tiff"},
            //{title : "Image files", extensions : "jpg,gif,png"}
        ]
    },

    flash_swf_url : '/vendor/jildertmiedema/laravel-plupload/js/Moxie.swf',
    silverlight_xap_url : '/vendor/jildertmiedema/laravel-plupload/js/Moxie.xap',
     
    multi_selection: false,
 
    init: {
        PostInit: function() {
        },
 
        FilesAdded: function(up, files) {
            res_data = '<div id="' + files[0].id + '">' + files[0].name + ' - ' + plupload.formatSize(files[0].size) + ' - <b></b></div>';
            $('#filelist2').html(res_data);
            up.start();
        },
 
        UploadProgress: function(up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            document.getElementById('console2').innerHTML = '';
        },
    

        FileUploaded: function(up, file, response) {
            
        res = JSON.parse(response.response);
            $( "#file2" ).val( res.result.fname );

            
            $( "#valid_file2" ).html('');
            $.each( res.result, function( key, value ) {
                $( "#valid_file2" ).append( '<li>'+key+': '+value+'</li>' );
            });
        },

        Error: function(up, err) {

            document.getElementById('console2').innerHTML = '<div class="console2 alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+ err.message +'</div>';
        }
    }
});

uploader.init();
uploader2.init();
 
</script>
