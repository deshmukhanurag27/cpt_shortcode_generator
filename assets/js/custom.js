/**
 * CPT Shortcode Generator Base Admin JS
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @author Anurag Deshmukh
 * @copyright Copyright (c) 2018, Anurag Deshmukh
**/

jQuery(document).ready(function($) {

	// jQuery("form").submit(function (e) {
	//     e.preventDefault();
	//     if ('all' == jQuery('#cpts-select').val()) {
	//     	jQuery('#cpts-select').addClass('error-message');
	//     	return false;
	//     } else {
	//     	jQuery('#cpts-select').removeClass('error-message');
	//     	return true;
	//     }
	// });

	jQuery("#copy_shortcode").click(function(event) {
		jQuery(this).select();
	});
});