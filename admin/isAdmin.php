<?php
session_start();
!isset($_SESSION['isAdmin']) && header("Location: index.php");
?>