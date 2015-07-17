<?php
/***************************************************************************
 *   copyright				: (C) 2008 - 2013 WeBid
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
$current_page = 'contents';
include '../common.php';
include $include_path . 'functions_admin.php';
include 'loggedin.inc.php';
include $main_path . 'ckeditor/ckeditor.php';

unset($ERR);

if (isset($_POST['action']) && $_POST['action'] == 'update')
{
	// Update database
	$query = "UPDATE ". $DBPrefix . "settings SET
			  aboutus = '" . $_POST['aboutus'] . "',
			  aboutustext = '" . mysql_real_escape_string($_POST['aboutustext']) . "'";
	$system->check_mysql(mysql_query($query), $query, __LINE__, __FILE__);
	$system->SETTINGS['aboutus'] = $_POST['aboutus'];
	$system->SETTINGS['aboutustext'] = $_POST['aboutustext'];
	$ERR = $MSG['5079'];
}

loadblock($MSG['5077'], $MSG['5076'], 'yesno', 'aboutus', $system->SETTINGS['aboutus'], array($MSG['030'], $MSG['029']));

$CKEditor = new CKEditor();
$CKEditor->basePath = $main_path . 'ckeditor/';
$CKEditor->returnOutput = true;
$CKEditor->config['width'] = 550;
$CKEditor->config['height'] = 400;

loadblock($MSG['5078'], $MSG['5080'], $CKEditor->editor('aboutustext', stripslashes($system->SETTINGS['aboutustext'])));

$template->assign_vars(array(
		'ERROR' => (isset($ERR)) ? $ERR : '',
		'SITEURL' => $system->SETTINGS['siteurl'],
		'TYPENAME' => $MSG['25_0018'],
		'PAGENAME' => $MSG['5074']
		));

$template->set_filenames(array(
		'body' => 'adminpages.tpl'
		));
$template->display('body');
?>