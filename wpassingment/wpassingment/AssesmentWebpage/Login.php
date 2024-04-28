<?php
        include_once 'Header.php'
?>

<?php
    if(isset($_GET['error'])) //This is the error hanleing code that pulls info from the url and prints it onto the page to be easyer to read. 
        {
            if ($_GET['error'] == "emptyfields") 
                    {
                            echo 'Please fill in all fields';
                    }
                elseif ($_GET['error'] == "wrongpasswword")
                    {
                            echo 'Passwords incorrect';
                    }
                elseif ($_GET['error'] == "sqlerror")
                    {
                            echo 'Fatal SQL error, please contact an IT technician';
                    }                          
        }
?>

<main>
    <section class="logInForm">
        <h2>Log In</h2>
        <form id="loginForm" action="Inclusions/Login.include.php" method="post">
            <input type="text" name="logInEmailUsername" placeholder="Email or Username">
            <input type="password" name="logInPassword" placeholder="Password">

            <button type="submit" name="loginSubmit">Log In</button>
        </form>
    </section>
</main>

        <h2>or</h2>
            <button id="SignUp" type="button" onclick="document.location='SignUp.php'">Sign Up</button>



        <?php
                if (isset($_SESSION['userId']))
                        {
                                echo "Sucsessfuly logged in";
                        }
                else
                        {
                                echo "Sucsessfuly logged out";
                        }
        ?>

<?php
        include_once 'Footer.php'
?>