<?php
if (isset($_POST['loginSubmit']))
    {
        /*loads the database connection file*/
        require 'Signup.database.include.php';

        $emailOrUsername = $_POST['logInEmailUsername'];
        $password = $_POST['logInPassword'];

        if (empty($emailOrUsername) || empty($password))// this code checks if the input fields are left empty
            {
                header("Location: ../Login.php?error=emptyfields");
                exit();
            }
        else
            {
                $query  = "SELECT * FROM users WHERE full_name=? OR email_address=?;";//This is the sql code that is sent to the database
                $statement = mysqli_stmt_init($connection);
                if (!mysqli_stmt_prepare($statement, $query))
                    {
                        header("Location: ../Login.php?error=sqlerror");
                        exit();
                    }
                else
                    {
                        mysqli_stmt_bind_param($statement,"ss",$emailOrUsername, $emailOrUsername);
                        mysqli_stmt_execute($statement);
                        $result = mysqli_stmt_get_result($statement);
                        if ($row = mysqli_fetch_assoc($result))
                            {
                                $passwordVerify = password_verify($password, $row['password']);// various check like if the passord is wrong or if username input cannot be found
                                    if ($passwordVerify == false)
                                        {
                                            header("Location: ../Login.php?error=wrongpasswword");
                                            exit();
                                        }
                                    elseif ($passwordVerify == true)
                                        {
                                            session_start();
                                            $_SESSION['userId'] = $row['id'];
                                            $_SESSION['userUsername'] = $row['full_name'];

                                            header("Location: ../Login.php?login=sucsessful");
                                            exit();
                                        }
                                    else
                                        {
                                            header("Location: ../Login.php?error=wrongpasswword");
                                            exit();
                                        }
                            }
                        else
                            {
                                header("Location: ../Login.php?error=nouserfound");
                                exit();
                            }
                    }
            }
    }
else
    {
        header("Location: ../Login.php");
        exit();
    }