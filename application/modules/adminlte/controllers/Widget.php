<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Reference:
 * https://almsaeedstudio.com/themes/AdminLTE/pages/widgets.html
 */
class Widget extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	function info_box($color, $number, $label, $icon, $url = '#')
	{
		$data = array(
			'color'		=> $color,
			'number'	=> $number,
			'label'		=> $label,
			'icon'		=> $icon,
			'url'		=> $url,
		);
		$this->load->view('widget/info_box', $data);
	}

	function app_btn($icon, $label, $url = '#', $badge = '', $badge_color = 'purple')
	{
		$data = array(
			'icon'		=> $icon,
			'label'		=> $label,
			'url'		=> $url,
			'badge'		=> isset($badge) ? "<span class='badge bg-$badge_color'>$badge</span>": '',
			'target'	=> starts_with($url, 'http') ? '_blank' : '_self',
		);
		$this->load->view('widget/app_btn', $data);
	}

	function box($title, $body, $style = 'primary', $solid = FALSE, $footer = '')
	{
		$data = array(
			'title'		=> $title,
			'style'		=> empty($style) ? '' : 'box-'.$style,
			'solid'		=> $solid ? 'box-solid' : '',
			'body'		=> $body,
			'footer'	=> $footer,
		);
		$this->load->view('widget/box', $data);
	}

	function box_open($title, $style = 'primary', $solid = FALSE)
	{
		$data = array(
			'title'		=> $title,
			'style'		=> empty($style) ? '' : 'box-'.$style,
			'solid'		=> $solid ? 'box-solid' : '',
		);
		$this->load->view('widget/box_open', $data);
	}

	function box_close($footer = '')
	{
		$data = array(
			'footer'	=> $footer,
		);
		$this->load->view('widget/box_close', $data);
	}

	function small_box($color, $number, $label, $icon, $url = '#')
	{
		$data = array(
			'color'		=> $color,
			'number'	=> $number,
			'label'		=> $label,
			'icon'		=> $icon,
			'url'		=> $url,
			'more_info'	=> empty($url) ? '&nbsp;' : "More info <i class='fa fa-arrow-circle-right'></i>",
		);
		$this->load->view('widget/small_box', $data);
	}

	function btn($label, $url = '#', $icon = '', $style = 'btn-primary', $size = '')
	{
		$data = array(
			'label'		=> $label,
			'url'		=> $url,
			'icon'		=> empty($icon) ? '' : "<i class='$icon'></i>",
			'style'		=> $style,
			'size'		=> empty($size) ? '' : 'btn-'.$size,
		);
		$this->load->view('widget/btn', $data);
	}

	function btn_submit($label = 'Submit', $style = 'bg-olive')
	{
		$data = array(
			'label'		=> $label,
			'style'		=> $style,
		);
		$this->load->view('widget/btn_submit', $data);
	}
}