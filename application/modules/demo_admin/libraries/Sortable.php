<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to generate items for Sortable.js
 */
class Sortable {

	protected $CI;
	protected $mItems;
	protected $mPostName = 'sortable_ids';

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('parser');
		$this->CI->load->library('system_message');
	}

	// Get items to be sorted
	public function init($model, $order_field = 'pos')
	{
		$this->CI->load->model($model, 'm');
		$ids = $this->CI->input->post($this->mPostName);

		// save to database
		if ( !empty($ids) )
		{
			for ($i=0; $i<count($ids); $i++)
			{
				$updated = $this->CI->m->update($ids[$i], array($order_field => $i+1));
			}

			// refresh page (interrupt other logic)
			$this->CI->system_message->set_success('Successfully updated sort order.');
			refresh();
		}

		// return all records in sorted order
		$this->CI->db->order_by($order_field, 'ASC');
		$items = $this->CI->m->get_all();
		$this->mItems = $items;

		return $this;
	}

	// Render template
	public function render($label_template = '{title}', $back_url = NULL)
	{
		if ( empty($this->mItems) )
		{
			return '<p>No records are found.</p>';
		}
		else
		{
			$html = modules::run('adminlte/widget/box_open', 'Sort Order', 'primary');

			// Render form with alert message
			$html.= '<form action="'.current_full_url().'" method="POST">';
			$html.= $this->CI->system_message->render();
			$html.= '<p>Drag and drop below items to sort them in ascending order:</p>';

			// Generate item list by CodeIgniter Template Parser
			$template = '<ul class="sortable list-group">
				{items}
				<li class="list-group-item">
					<strong>'.$label_template.'</strong>
					<input type="hidden" name="'.$this->mPostName.'[]" value="{id}" />
				</li>
				{/items}
			</ul>';
			$data = array('items' => $this->mItems);
			$html.= $this->CI->parser->parse_string($template, $data, TRUE);

			if ($back_url!=NULL)
				$html.= modules::run('adminlte/widget/btn', 'Back', $back_url, 'fa fa-reply', 'bg-purple').' ';

			$html.= modules::run('adminlte/widget/btn_submit', 'Save');
			$html.= '</form>';
			$html.= modules::run('adminlte/widget/box_close');
			return $html;
		}
	}
}