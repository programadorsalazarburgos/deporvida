<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
			var base ="<?php echo e(url('/')); ?>";
		</script>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
		<title>elFinder</title>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.2/require.min.js"></script>




		<script type="text/javascript" charset="utf-8">
		    $().ready(function() {
		        var elf = $('#elfinder').elfinder({
		            // lang: 'ru',             // language (OPTIONAL)
		            url : 'filemanager1/php/connector.php'  // connector URL (REQUIRED)
		        }).elfinder('instance');            
		    });
		</script>










		<script type="text/javascript">
			function elFinderBrowser (field_name, url, type, win) 
			{
			  	tinymce.activeEditor.windowManager.open({
				    file: '<?= route('elfinder.tinymce4') ?>',// use an absolute path!
				    title: 'elFinder 2.0',
				    width: 900,
				    height: 450,
				    resizable: 'yes'
				}, 
				{
			    	setUrl: function (url) 
			    	{
			      		win.document.getElementById(field_name).value = url;
			    	}
			  	});
				return false;
			}
		</script>
	</head>
	<body>
		<div id="elfinder"></div>
	</body>
</html>
