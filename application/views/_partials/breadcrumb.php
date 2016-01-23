<ol class="breadcrumb">
<?php
	for ($i=0; $i<sizeof($breadcrumb); $i++)
	{
		$active = ($i==sizeof($breadcrumb)-1 || $breadcrumb[$i]['url']=='#') ? 'active' : '';
		$name = $breadcrumb[$i]['name'];

		if ($active)
		{
			echo "<li class='$active'>$name</li>";
		}
		else
		{
			$url = $breadcrumb[$i]['url'];
			echo "<li class='$active'><a href='$url'>$name</a></li>";
		}
	}
?>
</ol>