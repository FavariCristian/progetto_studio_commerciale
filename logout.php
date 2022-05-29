<?php
session_start();
include('template_header.php');

session_unset();
header('Location:index.php');

include('template_footer.php');
?>