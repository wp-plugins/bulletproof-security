<?php

// BPS Class File
if ( !class_exists('Bulletproof_Security') ) :
	class Bulletproof_Security {
	var $options;
	var $errors;
		
function save_options() {
	return update_option('bulletproof_security', $this->options);
}

function set_error($code = '', $error = '', $data = '') {
	if ( empty($code) )
		$this->errors = new WP_Error();
	elseif ( is_a($code, 'WP_Error') )
		$this->errors = $code;
	elseif ( is_a($this->errors, 'WP_Error') )
		$this->errors->add($code, $error, $data);
	else
		$this->errors = new WP_Error($code, $error, $data);
}

function get_error($code = '') {
	if ( is_a($this->errors, 'WP_Error') )
	return $this->errors->get_error_message($code);
	return false;
	}
}
endif;
?>