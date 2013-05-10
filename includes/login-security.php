<?php
$BPSoptions = get_option('bulletproof_security_options_login_security');
	if ( $BPSoptions['bps_login_security_OnOff'] == 'On') {
		add_filter('authenticate', 'bpspro_wp_authenticate_username_password', 20, 3);
	}

function bpspro_wp_authenticate_username_password( $user, $username, $password ) {
global $wpdb;
$BPSoptions = get_option('bulletproof_security_options_login_security');
$options = get_option('bulletproof_security_options_email');
$bpspro_login_table = $wpdb->prefix . "bpspro_login_security";
$ip_address = $_SERVER['REMOTE_ADDR'];
$hostname = @gethostbyaddr($_SERVER['REMOTE_ADDR']);
$request_uri = $_SERVER['REQUEST_URI'];
$login_time = time();
$lockout_time = time() + (60 * $BPSoptions['bps_lockout_duration']); // default is 1 hour/3600 seconds 
$timeNow = time();
$gmt_offset = get_option( 'gmt_offset' ) * 3600;
$bps_email_to = $options['bps_send_email_to'];
$bps_email_from = $options['bps_send_email_from'];
$bps_email_cc = $options['bps_send_email_cc'];
$bps_email_bcc = $options['bps_send_email_bcc'];
$justUrl = get_site_url();
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), strtotime($date));

	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
	$subject = " BPS Pro Login Security Alert - $timestamp ";

/*
***************************************************************
// Log All Account Logins for valid Users - Good and Bad Logins
***************************************************************
*/
if ( $BPSoptions['bps_login_security_OnOff'] == 'On' && $BPSoptions['bps_login_security_logging'] == 'logAll') {

	$user = get_user_by( 'login', $username );
	$LoginSecurityRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_login_table WHERE user_id = %d", $user->ID) );

		foreach ( $LoginSecurityRows as $row ) {
	
			if ( $row->status == 'Locked' && $timeNow < $row->lockout_time && $row->failed_logins >= $BPSoptions['bps_max_logins'] ) { // greater > for testing
				$error = new WP_Error();
				$error->add('locked_account', __('<strong>ERROR</strong>: This user account has been locked until <strong>'.date_i18n(get_option('date_format').' '.get_option('time_format'), $row->lockout_time + $gmt_offset).'</strong> due to too many failed login attempts. You can login again after the Lockout Time above has expired.'));
		
				return $error;
			}
		}

		// Good Login - DB Row does NOT Exist - Create it - Email option - Any user logs in
		if ( $wpdb->num_rows == 0 && $user->ID != 0 && wp_check_password($password, $user->user_pass, $user->ID) ) {
			$status = 'Not Locked';
			$lockout_time = '0';		
			$failed_logins ='0';
		
			if ( $insert_rows = $wpdb->insert( $bpspro_login_table, array( 'status' => $status, 'user_id' => $user->ID, 'username' => $user->user_login, 'public_name' => $user->display_name, 'email' => $user->user_email, 'role' => $user->roles[0], 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $ip_address, 'hostname' => $hostname, 'request_uri' => $request_uri ) ) ) {
			
			if ( $options['bps_login_security_email'] == 'anyUserLoginLock') {
				$message = '<p><font color="blue"><strong>A User Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>';

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			
			// Option adminLoginOnly - Send Email Alert if an Administrator Logs in
			if ( $options['bps_login_security_email'] == 'adminLoginOnly' || $options['bps_login_security_email'] == 'adminLoginLock' && $user->roles[0] == 'administrator') {
				$message = '<p><font color="blue"><strong>An Administrator Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>';

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			} // end if ( $insert_rows = $wpdb->insert...
		} // end if ( $wpdb->num_rows == 0...
		
		// Good Login - DB Row Exists - Insert another DB Row - Only insert a new DB row if user status is not Locked
		if ( $wpdb->num_rows != 0 && $user->ID != 0 && wp_check_password($password, $user->user_pass, $user->ID) && $row->status != 'Locked') {
			$status = 'Not Locked';
			$lockout_time = '0';		
			$failed_logins ='0';		
			
			if ( $insert_rows = $wpdb->insert( $bpspro_login_table, array( 'status' => $status, 'user_id' => $user->ID, 'username' => $user->user_login, 'public_name' => $user->display_name, 'email' => $user->user_email, 'role' => $user->roles[0], 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $ip_address, 'hostname' => $hostname, 'request_uri' => $request_uri ) ) ) {
			
			if ( $options['bps_login_security_email'] == 'anyUserLoginLock') {
				$message = '<p><font color="blue"><strong>A User Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			
			// Option adminLoginOnly - Send Email Alert if an Administrator Logs in
			if ( $options['bps_login_security_email'] == 'adminLoginOnly' || $options['bps_login_security_email'] == 'adminLoginLock' && $user->roles[0] == 'administrator') {
				$message = '<p><font color="blue"><strong>An Administrator Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 
				
				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			} // end if ( $insert_rows = $wpdb->insert...
		} // end if ( $wpdb->num_rows != 0...

		// Bad Login - DB Row does NOT Exist - First bad login attempt = $failed_logins = '1';
		if ( $wpdb->num_rows == 0 && $user->ID != 0 && !wp_check_password($password, $user->user_pass, $user->ID) ) {
			$failed_logins = '1';

			// Insane, but someone will do this... if max bad retries is set to 1
			if ( $failed_logins >= $BPSoptions['bps_max_logins'] ) {
				$status = 'Locked';

			if ( $options['bps_login_security_email'] == 'lockoutOnly' || $options['bps_login_security_email'] == 'anyUserLoginLock' || $options['bps_login_security_email'] == 'adminLoginLock') {
				$message = '<p><font color="red"><strong>A User Account Has Been Locked</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If no action is taken then the User will be able to try and login again after the Lockout Time has expired. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>Lockout Time:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $login_time + $gmt_offset).'</p>'; 
				$message .= '<p><strong>Lockout Time Expires:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $lockout_time + $gmt_offset).'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			} else {		
				$status = 'Not Locked';			
			}

			if ( $insert_rows = $wpdb->insert( $bpspro_login_table, array( 'status' => $status, 'user_id' => $user->ID, 'username' => $user->user_login, 'public_name' => $user->display_name, 'email' => $user->user_email, 'role' => $user->roles[0], 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $ip_address, 'hostname' => $hostname, 'request_uri' => $request_uri ) ) ) {	

			} // end $insert_rows = $wpdb->insert...
		} // end if ( $wpdb->num_rows == 0...	

		// Good Login - DB Row Exists - Reset locked out account on good login if it was locked and the lockout has expired
		if ( $wpdb->num_rows != 0 && $user->ID != 0 && wp_check_password($password, $user->user_pass, $user->ID) && $row->status == 'Locked' && $timeNow > $row->lockout_time) {				
				$status = 'Not Locked';			
				$lockout_time = '0';
				$failed_logins = '0';

			if ( $update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $status, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id ) ) ) {	
			
			if ( $options['bps_login_security_email'] == 'anyUserLoginLock') {
				$message = '<p><font color="blue"><strong>A User Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>';

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
				
			// Option adminLoginOnly - Send Email Alert if an Administrator Logs in
			if ( $options['bps_login_security_email'] == 'adminLoginOnly' || $options['bps_login_security_email'] == 'adminLoginLock' && $user->roles[0] == 'administrator') {
				$message = '<p><font color="blue"><strong>An Administrator Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			} // end if ( $update_rows = $wpdb->update...
		} // end if ( $wpdb->num_rows != 0...

		// Bad Login - DB Row Exists - Count bad login attempts and Lock Account
		if ( $wpdb->num_rows != 0 && $user->ID != 0 && !wp_check_password($password, $user->user_pass, $user->ID) ) {

			foreach ( $LoginSecurityRows as $row ) {

				if ( $row->status == 'Locked' && $timeNow < $row->lockout_time && $row->failed_logins >= $BPSoptions['bps_max_logins'] ) { // greater > for testing
					$error = new WP_Error();
					$error->add('locked_account', __('<strong>ERROR</strong>: This user account has been locked until <strong>'.date_i18n(get_option('date_format').' '.get_option('time_format'), $row->lockout_time + $gmt_offset).'</strong> due to too many failed login attempts. You can login again after the Lockout Time above has expired.'));
			
					return $error;
				}
					$failed_logins = $row->failed_logins;

				if ( $row->failed_logins == 0 ) {
					for ($failed_logins = 0; $failed_logins <= 0; $failed_logins++) {
    					$failed_logins;
					} 
				} elseif ( $row->failed_logins == 1 ) {
					for ($failed_logins = 1; $failed_logins <= 1; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 2 ) {
					for ($failed_logins = 2; $failed_logins <= 2; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 3 ) {
					for ($failed_logins = 3; $failed_logins <= 3; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 4 ) {
					for ($failed_logins = 4; $failed_logins <= 4; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 5 ) {
					for ($failed_logins = 5; $failed_logins <= 5; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 6 ) {
					for ($failed_logins = 6; $failed_logins <= 6; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 7 ) {
					for ($failed_logins = 7; $failed_logins <= 7; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 8 ) {
					for ($failed_logins = 8; $failed_logins <= 8; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 9 ) {
					for ($failed_logins = 9; $failed_logins <= 9; $failed_logins++) {
    					$failed_logins;
					}
				}
			} // end foreach
			
			if ( $failed_logins >= $BPSoptions['bps_max_logins'] ) {
				$status = 'Locked';	

			if ( $options['bps_login_security_email'] == 'lockoutOnly' || $options['bps_login_security_email'] == 'anyUserLoginLock' || $options['bps_login_security_email'] == 'adminLoginLock') {
				$message = '<p><font color="red"><strong>A User Account Has Been Locked</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If no action is taken then the User will be able to try and login again after the Lockout Time has expired. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>Lockout Time:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $login_time + $gmt_offset).'</p>'; 
				$message .= '<p><strong>Lockout Time Expires:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $lockout_time + $gmt_offset).'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			} else {	
				$status = 'Not Locked';
			}

			if ( $update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $status, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id ) ) ) {	
		
			} // end if ( $update_rows = $wpdb->update...
		} // end if ( $wpdb->num_rows != 0...
} // end $BPSoptions['bps_login_security_logging'] == 'logAll') {...

/* 
*******************************************************************************************************************
// Log Only Account Lockouts for valid Users
// X failed attempts in any X amount of time = account is locked period - Duration/threshold is totally unnecessary
*******************************************************************************************************************
*/
if ( $BPSoptions['bps_login_security_OnOff'] == 'On' && $BPSoptions['bps_login_security_logging'] == 'logLockouts') {

	$user = get_user_by( 'login', $username );
	$LoginSecurityRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_login_table WHERE user_id = %d", $user->ID) );

		foreach ( $LoginSecurityRows as $row ) {
	
			if ( $row->status == 'Locked' && $timeNow < $row->lockout_time && $row->failed_logins >= $BPSoptions['bps_max_logins'] ) { // greater > for testing
				$error = new WP_Error();
				$error->add('locked_account', __('<strong>ERROR</strong>: This user account has been locked until <strong>'.date_i18n(get_option('date_format').' '.get_option('time_format'), $row->lockout_time + $gmt_offset).'</strong> due to too many failed login attempts. You can login again after the Lockout Time above has expired.'));
			
				return $error;
			}
		}
		
		// Bad Login - DB Row does NOT Exist - First bad login attempt = $failed_logins = '1';
		if ( $wpdb->num_rows == 0 && $user->ID != 0 && !wp_check_password($password, $user->user_pass, $user->ID) ) {
			$failed_logins = '1';

			// Insane, but someone will do this... if max bad retries is set to 1
			if ( $failed_logins >= $BPSoptions['bps_max_logins'] ) {
				$status = 'Locked';

			if ( $options['bps_login_security_email'] == 'lockoutOnly' || $options['bps_login_security_email'] == 'anyUserLoginLock' || $options['bps_login_security_email'] == 'adminLoginLock') {
				$message = '<p><font color="red"><strong>A User Account Has Been Locked</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If no action is taken then the User will be able to try and login again after the Lockout Time has expired. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>Lockout Time:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $login_time + $gmt_offset).'</p>'; 
				$message .= '<p><strong>Lockout Time Expires:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $lockout_time + $gmt_offset).'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			} else {		
				$status = 'Not Locked';			
			}

			if ( $insert_rows = $wpdb->insert( $bpspro_login_table, array( 'status' => $status, 'user_id' => $user->ID, 'username' => $user->user_login, 'public_name' => $user->display_name, 'email' => $user->user_email, 'role' => $user->roles[0], 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $ip_address, 'hostname' => $hostname, 'request_uri' => $request_uri ) ) ) {	

			} // end if ( $insert_rows = $wpdb->insert...
		} // end if ( $wpdb->num_rows == 0...	

			// Good Login - DB Row Exists - Reset locked out account on good login if it was locked and the lockout has expired
			if ( $wpdb->num_rows != 0 && $user->ID != 0 && wp_check_password($password, $user->user_pass, $user->ID) && $row->status == 'Locked' && $timeNow > $row->lockout_time) {				
				$status = 'Not Locked';			
				$lockout_time = '0';
				$failed_logins = '0';

			if ( $update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $status, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id ) ) ) {	

			if ( $options['bps_login_security_email'] == 'anyUserLoginLock') {
				$message = '<p><font color="blue"><strong>A User Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>';

				wp_mail($bps_email_to, $subject, $message, $headers);
			}

			// Option adminLoginOnly - Send Email Alert if an Administrator Logs in
			if ( $options['bps_login_security_email'] == 'adminLoginOnly' || $options['bps_login_security_email'] == 'adminLoginLock' && $user->roles[0] == 'administrator') {
				$message = '<p><font color="blue"><strong>An Administrator Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
			}			
			} // end if ( $update_rows = $wpdb->update...
		} // end if ( $wpdb->num_rows != 0...

		// Bad Login - DB Row Exists - Count bad login attempts and Lock Account
		if ( $wpdb->num_rows != 0 && $user->ID != 0 && !wp_check_password($password, $user->user_pass, $user->ID) ) {

			foreach ( $LoginSecurityRows as $row ) {

				if ( $row->status == 'Locked' && $timeNow < $row->lockout_time && $row->failed_logins >= $BPSoptions['bps_max_logins'] ) { // greater > for testing
					$error = new WP_Error();
					$error->add('locked_account', __('<strong>ERROR</strong>: This user account has been locked until <strong>'.date_i18n(get_option('date_format').' '.get_option('time_format'), $row->lockout_time + $gmt_offset).'</strong> due to too many failed login attempts. You can login again after the Lockout Time above has expired.'));
			
					return $error;
				}
					$failed_logins = $row->failed_logins;

				if ( $row->failed_logins == 0 ) {
					for ($failed_logins = 0; $failed_logins <= 0; $failed_logins++) {
    					$failed_logins;
					} 
				} elseif ( $row->failed_logins == 1 ) {
					for ($failed_logins = 1; $failed_logins <= 1; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 2 ) {
					for ($failed_logins = 2; $failed_logins <= 2; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 3 ) {
					for ($failed_logins = 3; $failed_logins <= 3; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 4 ) {
					for ($failed_logins = 4; $failed_logins <= 4; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 5 ) {
					for ($failed_logins = 5; $failed_logins <= 5; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 6 ) {
					for ($failed_logins = 6; $failed_logins <= 6; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 7 ) {
					for ($failed_logins = 7; $failed_logins <= 7; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 8 ) {
					for ($failed_logins = 8; $failed_logins <= 8; $failed_logins++) {
    					$failed_logins;
					}
				} elseif ( $row->failed_logins == 9 ) {
					for ($failed_logins = 9; $failed_logins <= 9; $failed_logins++) {
    					$failed_logins;
					}
				}
			} // end foreach
			
			if ( $failed_logins >= $BPSoptions['bps_max_logins'] ) {
				$status = 'Locked';

			if ( $options['bps_login_security_email'] == 'lockoutOnly' || $options['bps_login_security_email'] == 'anyUserLoginLock' || $options['bps_login_security_email'] == 'adminLoginLock') {
				$message = '<p><font color="red"><strong>A User Account Has Been Locked</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If no action is taken then the User will be able to try and login again after the Lockout Time has expired. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>Lockout Time:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $login_time + $gmt_offset).'</p>'; 
				$message .= '<p><strong>Lockout Time Expires:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $lockout_time + $gmt_offset).'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			} else {	
				$status = 'Not Locked';
			}
			
			if ( $update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $status, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id ) ) ) {	
		
			} // end if ( $update_rows = $wpdb->update...
		} // end if ( $wpdb->num_rows != 0...
} // end $BPSoptions['bps_login_security_logging'] == 'logLockouts') {...

/*
****************************************************
// WordPress Standard Authentication Processing Code
****************************************************
// Custom options for error message display will be added here in a later version of BPS
*/
if ( $BPSoptions['bps_login_security_OnOff'] == 'On') {

	if ( !$user )
		return new WP_Error('invalid_username', sprintf(__('<strong>ERROR</strong>: Invalid username. <a href="%s" title="Password Lost and Found">Lost your password</a>?'), wp_lostpassword_url()));

	$user = apply_filters('wp_authenticate_user', $user, $password);
	if ( is_wp_error($user) )
		return $user;

	if ( !wp_check_password($password, $user->user_pass, $user->ID) )

		return new WP_Error( 'incorrect_password', sprintf( __( '<strong>ERROR</strong>: The password you entered for the username <strong>%1$s</strong> is incorrect. <a href="%2$s" title="Password Lost and Found">Lost your password</a>?' ),
		$username, wp_lostpassword_url() ) );

	return $user;
}
}
?>