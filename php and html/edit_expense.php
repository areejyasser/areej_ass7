<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('location:log.php');
}

require "dbcon.php";
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Fatal Error");
}

$id = $_GET['id'];

// Retrieve the existing data for the expense with the specified ID
$sql = "SELECT * FROM expense WHERE expense_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the form data submitted by the user
    $price = $_POST['price'];
    $payment = $_POST['payment'];
    $date = $_POST['date'];

    // Update the expense in the database using a SQL query
    $sql = "UPDATE expense SET price = '$price', payment = '$payment', data_exp = '$date' WHERE expense_id = $id";
    if (mysqli_query($conn, $sql)) {
        // Redirect to the expenses page
        header('location:expense.php');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Expense</title>
</head>

<body>
    <h1>Edit Expense</h1>
    <form method="post">
        <label>Price:</label>
        <input type="text" name="price" value="<?php echo $row['price']; ?>" required>
        <br><br>
        <label>Payment:</label>
        <input type="text" name="payment" value="<?php echo $row['payment']; ?>" required>
        <br><br>
        <label>Date:</label>
        <input type="date" name="date" value="<?php echo $row['data_exp']; ?>" required>
        <br><br>
        <input type="submit" value="Save">
    </form>
</body>

</html>