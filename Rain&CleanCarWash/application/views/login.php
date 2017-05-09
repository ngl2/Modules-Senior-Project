<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" rev="stylesheet" href="<?php echo base_url();?>css/vendor/bootstrap.min.css" />
<link rel="stylesheet" rev="stylesheet" href="<?php echo base_url();?>css/login.css" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>r&c systems <?php echo $this->lang->line('login_login'); ?></title>
<script src="<?php echo base_url();?>js/jquery-1.2.6.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$("#login_form input:first").focus();
});
</script>
</head>
<body>
<h1>Rain & Clean systems</h1>

<?php echo form_open('login') ?>
<div id="container" class="container">
<?php echo validation_errors(); ?>
	<div class="row">
	</div>
	<div class="row">
		<div id="login_form" class="col-md-6 col-md-offset-3">
			<div id="welcome_message">
				<h4><?php echo "Hello and welcome, login below"; ?></h4>
			</div>
			<div class="form_field_label"><?php echo $this->lang->line('login_username'); ?> </div>
			<div class="form_field">
			<?php echo form_input(array(
			'name'=>'username',
			'value'=>set_value('username'))); ?>
			</div>

			<div class="form_field_label"><?php echo $this->lang->line('login_password'); ?> </div>
			<div class="form_field">
			<?php echo form_password(array(
			'name'=>'password',
			'value'=>set_value('password'))); ?>
			</div>
			<div id="submit_button">
			<?php echo form_submit('loginButton','Go', 'class="btn btn-primary btn-block"'); ?>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
</body>
</html>
