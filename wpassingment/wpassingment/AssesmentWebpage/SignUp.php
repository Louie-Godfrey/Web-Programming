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
            elseif ($_GET['error'] == "invalidEmail")
                    {
                            echo 'Please enter a valid Email';
                    }
            elseif ($_GET['error'] == "paswordCheck")
                    {
                            echo 'Passwords dont match';
                    }
            elseif ($_GET['error'] == "sqlerror")
                    {
                            echo 'Fatal SQL error, please contact an IT technician';
                    } 
            elseif ($_GET['error'] == "UsernameTaken")
                    {
                            echo 'Sorry, that username is already taken';
                    }     
            elseif ($_GET['error'] == "sucsessful")
                    {
                            echo 'Congratulations, your signed up!';
                    }                                    
        }
?>

<main>
    <section class="signUpForm"> <!--Here is the signup form, it requiers that bot the password match and that the username is not in use -->
        <h2>Sign Up</h2>
        <form id="signUpForm" action="Inclusions\Signup.include.php" method="post"> 
            <input type="text" name="signUpUsername" placeholder="Username">
            <input type="text" name="signUpEmail" placeholder="Email address">
            <input type="password" name="signUpPassword" placeholder="Password">
            <input type="password" name="signUpPasswordRepeat" placeholder="Reapeat password">

            <button type="submit" name="signupSubmit">Create Account</button>
        </form>
        <button id="return" type="button" onclick="document.location='Login.php'">Go Back</button>
    </section>
</main>



<?php
        include_once 'Footer.php'
?>