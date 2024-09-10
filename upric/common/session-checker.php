<?php
session_start();
require("url-base.php");
if (session_status() === 1 || !isset($_SESSION['valid'])) {
  header("Location: $url_base_http/pages/login.php");

  echo "<script>window.location.replace('$url_base_http/pages/login.php')</script>";
}
?>