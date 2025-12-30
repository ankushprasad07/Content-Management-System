<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include "../includes/db.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM articles WHERE id=$id");

header("Location: dashboard.php?msg=deleted");
exit;
