<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SVL RM Print</title>
    
    <style type="text/css" media="all">
		@page {
			size: A4 portrait; /* can use also 'landscape' for orientation */
			margin: 0in;
			border: 1px solid black;
			padding: 1em;
			
			@bottom-center {
				content: element(footer);
			}
			
			@top-center {
				content: element(header);
			}
		}
			
		#page-header {
			display: block;
			position: running(header);
			text-align: center;
		}
		
		#page-footer {
			display: block;
			position: running(footer);
		}
		
		.page-number:before {
			content: counter(page); 
		}
		
		.page-count:before {
			content: counter(pages);  
		}
	</style>

</head>


<body>

	<div id="page-header">
		<p>Header text</p>
	</div>
	
	<div id="page-footer">
		<p>Footer text</p>
		<p>Page <span class="page-number"/> of <span class="page-count"/></p>
	</div>

	<div id="page-content">
		<p>Page 1.</p>
		
		<p style="page-break-after:always;"/>
		
		<p>Page 2.</p>
	</div>
        
</body>