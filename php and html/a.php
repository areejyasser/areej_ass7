<!-- Add this section to your existing HTML form -->
<head>
    <title>Expense Tracker</title>
    <link rel="icon" href="../images/M2.png" type="LOGO">
    <link rel="stylesheet" href="../css/ex.css">
</head>
<header >
                    <img class ="logo" alt="esra alzorgani" src="../images/logoo.png" />
                        <nav class="header1">
                        <a class="a" href="home2.php"> HOME</a>
            <a class="a" href="category.php">ADD CATEGORY</a>
            <a class="a" href="updateca.php">EDIT CATEGORY</a>
            <a class="a" href="transfer.php">TRANSFER</a>
            <a class="a" href="logout.php">LOGOUT</a>
                          </nav>  
                          <?php
                echo 'User name :- '. $_SESSION['username'];
                ?> 
                </header>
<section>
    <form method="post" action="">
        <h2 class="log">Transfer Amount</h2>
        <label for="FromCategory">From Category:</label>
        <select name="FromCategory" required>
            <!-- Fetch and display the categories owned by the user from the database -->
            <?php
            $userId = $_SESSION['userid'];
            $query = "SELECT category_name FROM category WHERE user_id='$userId'";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['category_name'] . "'>" . $row['category_name'] . "</option>";
            }
            ?>
        </select><br>

        <label for="ToCategory">To Category:</label>
        <select name="ToCategory" required>
            <!-- Fetch and display the categories owned by the user from the database -->
            <?php
            mysqli_data_seek($result, 0); // Reset the result pointer
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['category_name'] . "'>" . $row['category_name'] . "</option>";
            }
            ?>
        </select>
        <br>

        <input type="number" name="TransferAmount" placeholder="Transfer Amount" required><br>
        <input type="text" name="Note" placeholder="Note"><br>
        <input type="submit" name="submit" value="Transfer"><br>
    </form>
</section>