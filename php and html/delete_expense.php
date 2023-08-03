<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('location:log.php');
}

require "dbcon.php";
$conn = new mysqli($hn, $un, $pw, $db);
$id = $_GET['id'];

// Verify that the user is authorized to delete the expense with the specified ID
$sql = "SELECT * FROM expense WHERE expense_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row || $row['user_id'] != $_SESSION['id']) {
    die("You are not authorized to delete this expense.");
}

// Delete the expense from the database using a SQL query
$sql = "DELETE FROM expense WHERE expense_id = $id";
if (mysqli_query($conn, $sql)) {
    // Redirect to the expenses page
    header('location:expense.php');
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>