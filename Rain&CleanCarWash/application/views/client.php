<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" rev="stylesheet" href="<?php echo base_url();?>css/vendor/bootstrap.min.css" />
<link rel="stylesheet" rev="stylesheet" href="<?php echo base_url();?>css/client.css" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>r&c systems customer view</title>
<script src="<?php echo base_url();?>js/jquery-1.2.6.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
</head>  
<body>
<h1>Rain & Clean systems</h1>

<div id="container" class="container">
	<div class="row">
		<div class="col-md-12"><h2>Items</h2></div>
	</div>
	<div id="table_holder">
	<?php  echo $client_items; ?>
	</div>
</div>
</body>
</html>
