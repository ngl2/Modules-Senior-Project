<?php  $this->load->view("partial/header"); ?>
<br />
<h3><?php echo $this->lang->line('common_welcome_message'); ?></h3>
<div id="home_module_list" class="row">
	<?php 
	foreach($allowed_modules->result() as $module)
	{
	?>
	<a href="<?php echo site_url("$module->module_id");?>" class="module_item col-sm-3">
		<img src="<?php echo base_url().'images/menubar/'.$module->module_id.'.png';?>" border="0" alt="Menubar Image" /><br />
		<h5><?php echo $this->lang->line("module_".$module->module_id) ?></h5>
		<h6><?php echo $this->lang->line('module_'.$module->module_id.'_desc');?></h6>
	</a>
	<?php 
	}
	?>  
</div>
<?php  $this->load->view("partial/footer"); ?>