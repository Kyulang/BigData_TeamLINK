<?php
// start output buffering
ob_start();
// init a session
session_start(); 

// check for a $page_title value:
if (!isset($page_title)){
    $page_title = 'User Registration';
}

?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $page_title; ?></title>
</head>
