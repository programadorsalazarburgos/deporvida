<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
		<title>elFinder 2.1.x source version with PHP connector</title>
		<script data-main="./main.default.js" src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.5/require.min.js"></script>
		<script>
			define('elFinderConfig', {
				defaultOpts : 
				{
					url : 'php/connector.minimal.php?user=<?= $_GET['user'] ?>', // connector URL (REQUIRED)
					commandsOptions : 
					{
						edit : 
						{
							extraOptions : 
							{
								creativeCloudApiKey : '',
								managerUrl : ''
							}
						},
						quicklook : 
						{
							googleDocsMimes : ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
						}
					},
					bootCallback : function(fm, extraObj) 
					{
						fm.bind('init', function() {
							// any your code
						});
						var title = document.title;
						fm.bind('open', function() 
						{
							var path = '', 
								cwd  = fm.cwd();
							if (cwd)
							{
								path = fm.path(cwd.hash) || null;
							}
							document.title = path? path + ':' + title : title;
						}).
						bind('destroy', function() 
						{
							document.title = title;
						});
					}
				},
				managers : 
				{
					'elfinder': {}
				}
			});
		</script>
	</head>
	<body>
		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>
	</body>
</html>
