<?php
if (isset($_POST['productItemTrack'])) 
    {
        /*loads the database connection file*/
        require 'Signup.database.include.php';

        /*takes the users data from the SignUp form*/
        $productId = $_POST['productId'];
        $userId = $_POST['userId'];

            $query = "INSERT INTO products_users_link (product_id, user_id) VALUES (?, ?)";
            $statement = mysqli_stmt_init($connection);
            if (!mysqli_stmt_prepare($statement, $query))
            {
                header("Location: ../Products.php?error=sqlerror");
                exit();
            }
            else
            {
                mysqli_stmt_bind_param($statement, "ss", $productId, $userId);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                header("Location: ../Products.php?itemTrack=sucsessful&userid=".$userId."&productid=".$productId);
                exit();
            }
        mysqli_stmt_close($statement);
        mysqli_close($connection);
    }
    else 
    {
        header("Location: ../Products.php");
        exit();
    }