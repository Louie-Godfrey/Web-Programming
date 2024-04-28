<?php
if (isset($_POST['signupSubmit'])) 
    {
        /*loads the database connection file*/
        require 'Signup.database.include.php';

        /*takes the users data from the SignUp form*/
        $username = $_POST['signUpUsername'];
        $email = $_POST['signUpEmail'];
        $password = $_POST['signUpPassword'];
        $passwordRepeat = $_POST['signUpPasswordRepeat'];

        /*a check to see if the input fields are empty*/
        if (empty($email) || empty($password) || empty($passwordRepeat))
            {
                header("Location: ../SignUp.php?error=emptyfields&email=".$email."&username=".$username);
                exit();
            }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))/*Validates if an email adress is correct*/ 
            {
                    header("Location: ../SignUp.php?error=invalidEmail");
                    exit();
            }
        elseif ($password !== $passwordRepeat)/*enures that both password attempts match*/
            {
                header("Location: ../SignUp.php?error=paswordCheck&email=".$email."&username=".$username);
                    exit();
            }
        else 
            {
                /*loads a query onto the sql database*/
                $query = "SELECT full_name FROM users WHERE full_name=?";
                $statement = mysqli_stmt_init($connection);
                if (!mysqli_stmt_prepare($statement, $query))
                    {
                        header("Location: ../SignUp.php?error=sqlerror");
                        exit();
                    }
                else
                    {
                        mysqli_stmt_bind_param($statement, "s", $username);
                        mysqli_stmt_execute($statement);
                        mysqli_stmt_store_result($statement);
                        $resultCheck = mysqli_stmt_num_rows($statement);
                        if ($resultCheck > 0)
                            {
                                header("Location: ../SignUp.php?error=UsernameTaken&email=".$email);
                                exit();
                            }  
                        else 
                            {
                                $query = "INSERT INTO users (full_name, email_address, password, admin_status) VALUES (?, ?, ?, 'N')";
                                $statement = mysqli_stmt_init($connection);
                                if (!mysqli_stmt_prepare($statement, $query))
                                {
                                    header("Location: ../SignUp.php?error=sqlerror");
                                    exit();
                                }
                                else
                                {
                                    /*bcrypt is apparently the most up to date hashing function*/
                                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                                    mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPassword);
                                    mysqli_stmt_execute($statement);
                                    mysqli_stmt_store_result($statement);
                                    header("Location: ../SignUp.php?SignUp=sucsessful");
                                    exit();
                                }
                            }
                    }
            }
            mysqli_stmt_close($statement);
            mysqli_close($connection);
    }
    else 
    {
        header("Location: ../SignUp.php");
        exit();
    }
