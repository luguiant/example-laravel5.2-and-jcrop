<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>corte</title>
        <script src="{{url('/')}}/js/jquery.js"></script>
		<script src="{{url('/')}}/js/jquery.Jcrop.js"></script>
		<script type="text/javascript">

		
		   jQuery(function($){

			    // Create variables (in this scope) to hold the API and image size
			    var jcrop_api,
			        boundx,
			        boundy,

			        // Grab some information about the preview pane
			        $preview = $('#preview-pane'),
			        $pcnt = $('#preview-pane .preview-container'),
			        $pimg = $('#preview-pane .preview-container img');

			        xsize = $pcnt.width(),
			        ysize = $pcnt.height();
			    
			    $('#target').Jcrop({
			      onChange: updatePreview,
			      onSelect: updatePreview,
			      //aspectRatio: xsize / ysize
			      onSelect: updateCoords,
                  aspectRatio: 1

			    },function(){
			      // Use the API to get the real image size
			      var bounds = this.getBounds();
			      boundx = bounds[0];
			      boundy = bounds[1];
			      // Store the API in the jcrop_api variable
			      jcrop_api = this;

			      // Move the preview into the jcrop container for css positioning
			      $preview.appendTo(jcrop_api.ui.holder);
			    });

			    function updatePreview(c)
			    {
			      if (parseInt(c.w) > 0)
			      {
			        var rx = xsize / c.w;
			        var ry = ysize / c.h;

			        $pimg.css({
			          width: Math.round(rx * boundx) + 'px',
			          height: Math.round(ry * boundy) + 'px',
			          marginLeft: '-' + Math.round(rx * c.x) + 'px',
			          marginTop: '-' + Math.round(ry * c.y) + 'px'
			        });
			      }
			    };

			    function updateCoords(c)
				  {
				    $('#x').val(c.x);
				    $('#y').val(c.y);
				    $('#w').val(c.w);
				    $('#h').val(c.h);
				};

				function checkCoords()
				{
				    if (parseInt($('#w').val())) return true;
				    alert('Please select a crop region then press submit.');
				    return false;
				};

			});

		</script>


		<style type="text/css">

		/* Apply these styles only when #preview-pane has
		   been placed within the Jcrop widget */
		.jcrop-holder #preview-pane {
		  display: block;
		  position: absolute;
		  z-index: 2000;
		  top: 10px;
		  right: -280px;
		  padding: 6px;
		  border: 1px rgba(0,0,0,.4) solid;
		  background-color: white;

		  -webkit-border-radius: 6px;
		  -moz-border-radius: 6px;
		  border-radius: 6px;

		  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
		  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
		  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
		}

		/* The Javascript code will set the aspect ratio of the crop
		   area based on the size of the thumbnail preview,
		   specified here */
		#preview-pane .preview-container {
		  width: 250px;
		  height: 170px;
		  overflow: hidden;
		}
        </style>
        <link rel="stylesheet" href="{{url('/')}}/demos/demo_files/main.css" type="text/css" />
		<link rel="stylesheet" href="{{url('/')}}/demos/demo_files/demos.css" type="text/css" />
		<link rel="stylesheet" href="{{url('/')}}/css/jquery.Jcrop.css" type="text/css" />
    </head>
    <body style="background-color: #FFFFFF;">
      
             @yield('content')
        
            <footer>
           
            </footer>
    </body>

</html>