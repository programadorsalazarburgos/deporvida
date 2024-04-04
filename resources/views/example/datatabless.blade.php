<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="{{url('')}}/local/js/jquery.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	

	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<title></title>
</head>
<body>
	<script type="text/javascript">
		$(document).ready(function() 
		{
	    	var t =$('#example').DataTable
	    	({
	        	"processing": true,
	        	"serverSide": true,
	        	"ajax": "{{url('')}}/server_processing.php",
				"columns": [
				        { data: "nombres", 	name: "Nombres" },
				        { data: "documento", 		name: "Documento" },
				        { data: "fecha_nacimiento", name: "Fecha de nacimiento" },
				    ]
	    	});
	    	/*t.on('order.dt search.dt', function () {
        		t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) 
        		{cell.innerHTML = i+1;});
    		}).draw();*/
		});
	</script>
<table id="example" class="display" style="width:100%">
	
</table>
</body>
</html>