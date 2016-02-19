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
		return "<div class='info-box'>
			<a href='$url'>
				<span class='info-box-icon bg-$color'><i class='$icon'></i></span>
			</a>
			<div class='info-box-content'>
				<span class='info-box-text'>$label</span>
				<span class='info-box-number'>$number</span>
			</div>
		</div>";
	}

	function app_btn($icon, $label, $url = '#', $badge = '', $badge_color = 'purple')
	{
		$badge = isset($badge) ? "<span class='badge bg-$badge_color'>$badge</span>": '';
		$target = starts_with($url, 'http') ? '_blank' : '_self';
		return "<a class='btn btn-app' href='$url' target='$target'>$badge<i class='$icon'></i> $label</a>";
	}

	function box_open($title, $style = 'primary', $solid = FALSE)
	{
		$solid = $solid ? 'box-solid' : '';
		$style = empty($style) ? '' : 'box-'.$style;
		return "<div class='box $style $solid'>
			<div class='box-header with-border'>
				<h3 class='box-title'>$title</h3>
			</div>
			<div class='box-body'>";
	}

	function box_close($footer = '')
	{
		$footer = empty($footer) ? '' : "<div class='box-footer'>$footer</div>";
		return "</div>$footer</div>";
	}

	function small_box($color, $number, $label, $icon, $url = '#')
	{
		$more_info = empty($url) ? '&nbsp;' : "More info <i class='fa fa-arrow-circle-right'></i>";
		
		return "<div class='small-box bg-$color'>
			<div class='inner'>
				<h3>$number</h3>
				<p>$label</p>
			</div>
			<div class='icon'>
				<i class='$icon'></i>
			</div>
			<a href='$url' class='small-box-footer'>$more_info</a>
		</div>";
	}

	function btn($label, $url = '#', $icon = '', $style = 'btn-primary', $size = '')
	{
		$size = empty($size) ? '' : 'btn-'.$size;
		$icon = empty($icon) ? '' : "<i class='$icon'></i>";

		if ( $url==='#' )
			return "<button class='btn btn-flat $style $size'>$icon $label</button>";
		else
			return "<a class='btn btn-flat $style $size' href='$url'>$icon $label</a>";
	}

	function btn_submit($label = 'Submit', $style = 'bg-olive')
	{
		return "<button class='btn btn-flat $style' type='submit'>$label</button>";
	}
	
	function table_open($headers = '')
	{
		$header_rows = '';
		if ( !empty($headers) && is_array($headers) )
		{
			$header_rows = "<thead><tr>";
			foreach ($headers as $header)
			{
				$header_rows.= "<th>$header</th>";
			}
			$header_rows.= "</tr></thead></tbody>";
		}

		return "<table class='table table-bordered table-hover'>".$header_rows;
	}

	function table_close($close_body = TRUE)
	{
		return $close_body ? "</tbody></table>" : "</table>";
	}
}