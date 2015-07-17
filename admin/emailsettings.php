<?php
/***************************************************************************
 *   copyright				: (C) 2008, 2009 WeBid
 *   site					: http://www.webidsupport.com/
 ***************************************************************************/

/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version. Although none of the code may be
 *   sold. If you have been sold this script, get a refund.
 ***************************************************************************/

define('InAdmin', 1);
$current_page = 'settings';
include '../common.php';
include $include_path . 'functions_admin.php';
include 'loggedin.inc.php';

unset($ERR);


$MSG['entry_mail_protocol']          = 'Mail Protocol:';
$MSG['entry_mail_parameter']         = 'Webid Mail Parameters:';
$MSG['entry_mail_parameter_info']    = '*When using \'Webid Mail\', additional mail parameters can be added here (e.g. "-femail@yourwebid.com").';
$MSG['entry_smtp_host']              = 'SMTP Host:';
$MSG['entry_smtp_host_info']         = '*For Gmail accounts. Set the encryption system using a prefix of [<b>ssl://</b>] or [<b>tls://</b>] Examples:<br>[ ssl://smtp.googlemail.com ], [ tls://smtp.googlemail.com ]';
$MSG['entry_smtp_username']          = 'SMTP Username:';
$MSG['entry_smtp_password']          = 'SMTP Password:';
$MSG['entry_smtp_port']              = 'SMTP Port:';
$MSG['entry_smtp_security']          = 'SMTP Security:';
$MSG['entry_smtp_authentication']    = 'SMTP Authentication';
$MSG['entry_alert_emails']           = 'Additional Admin E-Mails:';
$MSG['entry_alert_emails_info']      = 'Additional email accounts you want to receive admin related email, in addition to the main site email address of %s. (comma separated)';
$MSG['page_name']                    = 'Email Settings';
$MSG['error_empty']                  = 'Please enter missing or incorrect SMTP settings'; 
$MSG['smtp_title']                   = "SMTP Specific Options:";
// modal and js
$MSG['modal_title']                  = "Email Test and Response";
$MSG['input_test_email']             = "Enter a message for the test email.";
$MSG['button_send_email']            = "Send Test Email";
$MSG['modal_test']                   = "Email Test";
$MSG['text_subject']                 = "Test email from Admin";
$MSG['text_admin']                   = "Admin";
$MSG['modal_close']                   = "I have finished testing";

$mail_protocol = array('0' => 'WEBID MAIL', '1' => 'MAIL', '2' => 'SMTP', '4' => 'SENDMAIL', '5'=> 'QMAIL', '3' => 'NEVER SEND EMAILS (may be useful for testing purposes)');
$smtp_secure_options =array('none' => 'None', 'tls' => 'TLS', 'ssl' => 'SSL');

// Installation script
$query = "SHOW COLUMNS FROM `".$DBPrefix."settings` LIKE 'mail_protocol'";
$res = mysql_query($query);
$system->check_mysql($res, $query, __LINE__, __FILE__);	
if (!mysql_num_rows($res)) {
    $query = "ALTER TABLE `".$DBPrefix."settings` ADD COLUMN (
	          `mail_protocol` VARCHAR(128) NOT NULL DEFAULT 0,
			  `mail_parameter` VARCHAR(128) NOT NULL,
			  `smtp_authentication`  enum('y', 'n') NOT NULL DEFAULT 'n',
			  `smtp_security` enum('none', 'tls', 'ssl') NOT NULL DEFAULT 'none',
			  `smtp_port`  VARCHAR(128) NOT NULL DEFAULT 25,
			  `smtp_host` VARCHAR(128) NOT NULL,
			  `smtp_username`  VARCHAR(128) NOT NULL,
			  `smtp_password`  VARCHAR(128) NOT NULL,
			  `alert_emails`  VARCHAR(128) NOT NULL
			 )";
	$system->check_mysql(mysql_query($query), $query, __LINE__, __FILE__);
}



if (isset($_POST['action']) && $_POST['action'] == 'update')
{

	// checks 
	if (intval($_POST['mail_protocol']) == 2) {
	 if (empty($_POST['smtp_host']) || empty($_POST['smtp_username']) || empty($_POST['smtp_password']) || empty($_POST['smtp_port']) || intval($_POST['smtp_port']) <= 0 ) { 
	 $ERR = $MSG['error_empty'];
	 }
	}
	
	if (array_key_exists(intval($_POST['mail_protocol']), $mail_protocol) ) {
	
	  if  (intval($_POST['mail_protocol']) !== 2) {
	   // Update database
	    $query = "UPDATE ". $DBPrefix . "settings SET
			  mail_protocol = " . intval($_POST['mail_protocol']) . ",
			  mail_parameter = '" . $_POST['mail_parameter'] . "',
			  alert_emails = '" . $_POST['alert_emails'] . "'";
			  
	    $system->check_mysql(mysql_query($query), $query, __LINE__, __FILE__);
	    } else {
	    $query = "UPDATE ". $DBPrefix . "settings SET
			  mail_protocol = 2,
			  smtp_authentication = '" . $_POST['smtp_authentication'] . "',
			  smtp_security = '" . $_POST['smtp_security'] . "',
			  smtp_port = " . intval($_POST['smtp_port']) . ",
			  smtp_username = '" . (!empty($_POST['smtp_username'])? $_POST['smtp_username'] : '') . "',
			  smtp_password = '" . (!empty($_POST['smtp_password'])? $_POST['smtp_password'] : '') . "',
			  smtp_host = '" . (!empty($_POST['smtp_host'])? $_POST['smtp_host'] : '') . "',
			  alert_emails = '" . $_POST['alert_emails'] . "'";
	    $system->check_mysql(mysql_query($query), $query, __LINE__, __FILE__);		  
		
	    }
	  $ERR = $MSG['895'];
	} 
	
    $system->SETTINGS['mail_protocol'] = intval($_POST['mail_protocol']);
	$system->SETTINGS['mail_parameter'] = $_POST['mail_parameter'];
	$system->SETTINGS['smtp_authentication'] = $_POST['smtp_authentication'];
	$system->SETTINGS['smtp_security'] = $_POST['smtp_security'];
	$system->SETTINGS['smtp_port'] = (!empty($_POST['smtp_port']) && is_numeric($_POST['smtp_port']))? (int)($_POST['smtp_port']) : '';
	$system->SETTINGS['smtp_username'] = $_POST['smtp_username'];
	$system->SETTINGS['smtp_password'] = $_POST['smtp_password'];
	$system->SETTINGS['smtp_host'] = $_POST['smtp_host'];
	$system->SETTINGS['alert_emails'] = $_POST['alert_emails'];
}


$selectsetting = isset($system->SETTINGS['mail_protocol'])? $system->SETTINGS['mail_protocol'] : '0';
loadblock($MSG['entry_mail_protocol'], '', generateSelect('mail_protocol', $mail_protocol));
loadblock($MSG['entry_mail_parameter'] , '<span class="non_smtp para">' . $MSG['entry_mail_parameter_info'] , 'text', 'mail_parameter', $system->SETTINGS['mail_parameter']);
loadblock($MSG['smtp_title'] .'<span class="smtp"></span></b><br><br> Used <b>only</b> for SMTP mail<br><b>', '','','','',array(),true );
loadblock($MSG['entry_smtp_authentication'], '<span class="smtp"></span>', 'yesno', 'smtp_authentication', $system->SETTINGS['smtp_authentication'], array($MSG['030'], $MSG['029']));
$selectsetting = isset($system->SETTINGS['smtp_security'])? $system->SETTINGS['smtp_security'] : 'none';
loadblock($MSG['entry_smtp_security'] , '<span class="smtp"></span>', generateSelect('smtp_security', $smtp_secure_options));
loadblock($MSG['entry_smtp_port'] , '<span class="smtp"></span>', 'text', 'smtp_port', $system->SETTINGS['smtp_port']);
loadblock($MSG['entry_smtp_username'] , '<span class="smtp"></span>', 'text', 'smtp_username', $system->SETTINGS['smtp_username']);
loadblock($MSG['entry_smtp_password'] , '<span class="smtp"></span>', 'text', 'smtp_password', $system->SETTINGS['smtp_password']);
loadblock($MSG['entry_smtp_host'] , '<span class="smtp"></span>', 'text', 'smtp_host', $system->SETTINGS['smtp_host']);
loadblock($MSG['entry_alert_emails'] , sprintf($MSG['entry_alert_emails_info'], $system->SETTINGS['adminmail']), 'text', 'alert_emails', $system->SETTINGS['alert_emails']);

$mail_info2 = '<div class="rounded-top rounded-bottom">Mail details currently saved and used during this test:<br><br>Mail Protocol = '. $mail_protocol[$system->SETTINGS['mail_protocol']] .'<br>Smtp Authentication = ' . $system->SETTINGS['smtp_authentication'] . '<br>Smtp Security = ' . $system->SETTINGS['smtp_security'] . '<br>Smtp Port = ' . ((!empty($system->SETTINGS['smtp_port']) && is_numeric($system->SETTINGS['smtp_port']))? (int)($system->SETTINGS['smtp_port']) : '') . '<br>Smtp Username = ' . $system->SETTINGS['smtp_username'] . '<br>Smtp Password = ' . $system->SETTINGS['smtp_password'] . '<br>Smtp Host = ' . $system->SETTINGS['smtp_host'] . '<br>Alert Emails = ' . $system->SETTINGS['alert_emails'] . '<br><br>Don\'t forget to save any changes to take effect <button onclick="$(\'form[name=conf]\').submit();">Save changes</button></div><br>';


$js_test = "<p><button  onclick=\"showDialog();return false;\">" . $MSG['modal_test'] . "</button></p>
 <div id=\"dialog-modal\" title=\"" . $MSG['modal_title'] . "\" style=\"display: none;\">
$mail_info2
" . $MSG['input_test_email'] . "
<div class=\"test_m\">hi</div><br>
<div class=\"form-style\" id=\"contact_form\">
<p><button class=\"test_button\" onclick=\"showDialog();\" style=\"button\">" . $MSG['button_send_email'] . "</button></p>
<div id=\"contact_results\"></div><br>
</div>
</div>
<script type=\"text/javascript\">
$(document).ready(function() {
$(document).on('click', '.test_button',  function(e) {
	e.preventDefault();
	if ($('#text_testmail').val() == '')
	alert('Empty messages cause errors!');
	        post_data = {
                'user_name'     : '" . $MSG['text_admin'] . "', 
                'user_email'    : '" . $system->SETTINGS['adminmail'] . "', 
                'subject'       : '" . $MSG['text_subject'] . "', 
                'message'       : $('#text_testmail').val(),
				'csrftoken'     : $('input[name=csrftoken]').val()
			};
            //Ajax post data to server
            $.post('emailsettings.php?test_email', post_data, function(response){  
                if(response.type == 'error'){ //load json data from server and output message     
                    output = '<div class=\"error-box\">'+response.text+'</div>';
                }else{
                    output = '<div class=\"success-box\">'+response.text+'</div>';
                 }
                $(\"#contact_form #contact_results\").hide().html(output).slideDown();
			 }, 'json');
   });
}); 
function showDialog()
{
    $(\"#dialog-modal\").dialog(
    {
        width: 600,
        height: 500,
		buttons: {
        \"" . $MSG['modal_close'] . "\": function() {
            $(this).dialog(\"close\");
         }
		},
        open: function(event, ui)
        {
            var textarea = $('<input type=\"textarea\" id=\"text_testmail\" name=\"text_testmail\" style=\"height: 50px; width:90%;\">');
            $('.test_m').html(textarea);
        }
     });
}
</script>";
loadblock('' , $js_test);
$js_= "<script>
$(document).ready(function() {
	if ($('select[name=mail_protocol] option:selected').val() == 2) {
		$('.smtp').parent().parent().show();
		$('.non_smtp').parent().parent().hide();
	} else {
		$('.smtp').parent().parent().hide();
		$('.non_smtp').parent().parent().show();
	}
	if ($('select[name=mail_protocol] option:selected').val() == 0) {
		$('.para').parent().parent().show();
	} else {
		$('.para').parent().parent().hide();
    }
	
	$('select[name=mail_protocol]').on('change', function() {
	//alert('changid');
		if ($(this).val() == 2) {
			$('.smtp').parent().parent().show(300);
			$('.non_smtp').parent().parent().hide();
		} else {
			$('.smtp').parent().parent().hide();
			$('.non_smtp').parent().parent().show(300);
			}
		if ($(this).val() == 0) {
			$('.para').parent().parent().show(300);
		} else {
			$('.para').parent().parent().hide();
			}	
	});
});
</script>";
loadblock('' , $js_);

// send test email
if (isset($_GET['test_email'])) {

  $user_name      = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING);
  $to_email       = filter_var($_POST["user_email"], FILTER_SANITIZE_EMAIL);
  $subject        = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
  $message        = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    
	$emailer = new email_handler();
	$send_mail = $emailer->email_basic($subject, $to_email, $message);
	if($send_mail)
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.Response:<br>' . $send_mail));
        die($output);
    }else{
        $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$user_name .' Your email(s) has been processed and sent. No error(s) to report.'));
        die($output);
    }
}

$template->assign_vars(array(
		'ERROR' => (isset($ERR)) ? $ERR : '',
		'SITEURL' => $system->SETTINGS['siteurl'],
		'TYPENAME' => $MSG['524'],
		'PAGENAME' => $MSG['page_name']
		));

$template->set_filenames(array(
		'body' => 'adminpages.tpl'
		));
$template->display('body');
?>