/**
 * Scripts for Admin Panel
 */

$(document).ready(function() {
	console.log("Admin Panel");
	
	// Sortable
	var el = $('.sortable');
	for (var i=0; i<el.length; i++) {
		var sortable = Sortable.create(el[i]);
	}

	// Spectrum color picker
	$(".colorpicker").spectrum({
		// options here
	});
});