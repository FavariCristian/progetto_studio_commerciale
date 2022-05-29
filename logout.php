<?php
if(!isset($_SESSION)) { 
    session_start(); 
  } 
include('template_header.php');

session_unset();
header('Location:login.php');

include('template_footer.php');
?>