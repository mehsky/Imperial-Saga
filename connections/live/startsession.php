<?php
//
//
//	
//  session_start();
//
//  // If the session vars aren't set, try to set them with a cookie
//  if (!isset($_SESSION['player_id'])) {
//    if (isset($_COOKIE['player_id']) && isset($_COOKIE['user_name'])) {
//      $_SESSION['player_id'] = $_COOKIE['player_id'];
//      $_SESSION['user_name'] = $_COOKIE['user_name'];
//    }
//  }




define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : 'forum/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

?>
