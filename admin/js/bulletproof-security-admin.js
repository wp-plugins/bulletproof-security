jQuery(document).ready(function($){

// Tabs
	$('#tabs').tabs();
});

//$('#tabs').bind('tabsselect', function(event, ui) {
//});		

// ...open links in the current tab instead of leaving the page
// "Hijax" links after tab content has been loaded: 

//$('#tabs').tabs({
//    load: function(event, ui) {
//        $('a', ui.panel).click(function() {
//            $(ui.panel).load(this.href);
//            return false;
//        });
//    }
//});