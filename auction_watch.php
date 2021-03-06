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

include 'common.php';

// If user is not logged in redirect to login page
if (!$user->is_logged_in())
{
	$_SESSION['REDIRECT_AFTER_LOGIN'] = 'auction_watch.php';
	header('location: user_login.php');
	exit;
}

// insert a new watch item
if (isset($_GET['insert']) && $_GET['insert'] == 'true' && !empty($_REQUEST['add']))
{
	$requestadd = $system->cleanvars($_REQUEST['add']);
	// Check if this keyword is not already added
	$auctions = trim($user->user_data['auc_watch']);
	unset($match); // just incase
	if (!empty($auctions))
	{
		$checkarray = explode(' ', $requestadd);
		$requestadd = '';
		foreach ($checkarray as $check)
		{
			if (strpos($auctions, $check) === false)
			{
				$requestadd .= $check . ' ';
			}
		}
	}

	if (!isset($match) || empty($match))
	{
		$auction_watch = trim($auctions . ' ' . $requestadd);
		$query = "UPDATE " . $DBPrefix . "users SET auc_watch = '" . $auction_watch . "' WHERE id = " . $user->user_data['id'];
		$system->check_mysql(mysql_query($query), $query, __LINE__, __FILE__);
		$user->user_data['auc_watch'] = $auction_watch;
	}
}

// Delete auction from auction watch
if (isset($_GET['delete']))
{
	$auctions = trim($user->user_data['auc_watch']);
	$auc_id = preg_split('/ /', $auctions);
	$auction_watch = '';
	for ($j = 0; $j < count($auc_id); $j++)
	{
		$match = strstr($auc_id[$j], $_GET['delete']);
		if ($match)
		{
			$auction_watch = $auction_watch;
		}
		else
		{
			$auction_watch = $auc_id[$j] . ' ' . $auction_watch;
		}
	}
	$auction_watch = trim($auction_watch);
	$query = "UPDATE " . $DBPrefix . "users SET auc_watch = '" . $auction_watch . "' WHERE id = " . $user->user_data['id'];
	$system->check_mysql(mysql_query($query), $query, __LINE__, __FILE__);
	$user->user_data['auc_watch'] = $auction_watch;
}

$auctions = trim($user->user_data['auc_watch']);

if ($auctions != '')
{
	$auction = preg_split('/ /', $auctions);
	for ($j = 0; $j < count($auction); $j++)
	{
		$template->assign_block_vars('items', array(
				'ITEM' => $auction[$j],
				'ITEMENCODE' => urlencode($auction[$j])
				));
	}
}

include 'header.php';
$TMP_usmenutitle = $MSG['471'];
include $include_path . 'user_cp.php';
$template->set_filenames(array(
		'body' => 'auction_watch.tpl'
		));
$template->display('body');
include 'footer.php';

?>