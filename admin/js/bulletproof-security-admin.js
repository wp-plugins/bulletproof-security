jQuery(document).ready(function($){

// BPS jQuery Tab Menus
	$('#bps-tabs').tabs();
	$('#bps-edittabs').tabs();
});

// Uploadify BPS Upload Setup - If your WordPress installation is in a subfolder (not your website root folder) then you will need to add your subfolder name as shown in the example below to ALL 4 Uploadify variables (uploader, script, cancelImg and folder). 
//	Example: 'folder'    : '/add-your-subfolder-name-here/wp-content/plugins/bulletproof-security/admin/htaccess',

//jQuery(document).ready(function() {
//  $('#file_upload').uploadify({
//    'uploader'  : '/wp-content/plugins/bulletproof-security/admin/uploadify/uploadify.swf',
//    'script'    : '/wp-content/plugins/bulletproof-security/admin/uploadify/uploadify.php',
//    'cancelImg' : '/wp-content/plugins/bulletproof-security/admin/uploadify/cancel.png',
//    'folder'    : '/wp-content/plugins/bulletproof-security/admin/htaccess',
//   	'auto'      : true
//  });
//});