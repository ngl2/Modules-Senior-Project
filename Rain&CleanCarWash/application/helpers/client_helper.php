<?php 

// client html table to manage items
function client_items_manage_table($items,$controller)
{
	$CI =& get_instance();
	$allItems='<div class="col-xs-12"><div class="row">';
	$allItems.=client_items_manage_table_data_rows($items,$controller);
	$allItems.='</div></div>';
	
	return $allItems;
}

// return the html data rows for the items
function client_items_manage_table_data_rows($items,$controller)
{
	$CI =& get_instance();
	$client_item_rows='';
	
	foreach($items->result() as $item)
	{
		$client_item_rows.=client_item_data_row($item,$controller);
	}
	
	return $client_item_rows;
}

function client_item_data_row($item,$controller)
{
	$CI =& get_instance();
	$item_tax_info=$CI->Item_taxes->get_info($item->item_id);
	$tax_percents = '';
	foreach($item_tax_info as $tax_info)
	{
		$tax_percents.=$tax_info['percent']. '%, ';
	}
	$tax_percents=substr($tax_percents, 0, -2);
	$controller_name=$CI->uri->segment(1);
	$width = $controller->get_form_width();

	$table_data_row='<div class="col-md-4 car_item">';
	$table_data_row.='<h2>'.$item->name.'</h2>';
	$table_data_row.='<h3>'.$item->category.'</h3>';
	$table_data_row.='<h4>'.$CI->lang->line('items_cost_price') . ':' .to_currency($item->cost_price).'</h4>';
	$table_data_row.='<h4>'.$CI->lang->line('items_unit_price') . ':' .to_currency($item->unit_price).'</h4>';
	$table_data_row.='<h5>'.$CI->lang->line('items_tax_percents') . ':' .$tax_percents.'</h5>';	
	$table_data_row.='<h5>'.$CI->lang->line('items_quantity') . ':' .$item->quantity.'</h5>';
	$table_data_row.='<button class="btn btn-primary">Buy</button>';
	$table_data_row.='</div>';
	
	return $table_data_row;
}
?>