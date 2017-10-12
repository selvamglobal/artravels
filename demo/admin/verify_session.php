<?php
session_start();
if(!isset($_SESSION['uname']) && !isset($_SESSION['pass'])){
exit;
}
date_default_timezone_set('Asia/Kolkata');
?>