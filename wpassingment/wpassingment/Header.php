<?php
        session_start(); //The session is started in the header to ensure that any data from the user logging in can be retrieved at any point on the web page 
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="CSS/styles.css"> <!--My own style sheet, found in the CSS file, it is loaded in the header file so that every page has acess to it-->
</head>
    <body>
        <img id="sitelogo" src="Images/sitelogo.png" alt="Site Logo"> <!--A fitting logo for the websites use case, i use google tools to ensure it has no copyright linked to it-->
        <!--Image link-->

        <div id="loginLogout"> <!--This is the log in form located in the top left of the page, it allows the user to acess the dedicated login page and log in or sign up from there.-->
                <?php
                        if (isset($_SESSION['userId'])) //Here is an example of the SESSION data being pulled to tell if there is a user logged in or not
                        {
                                echo '  <form action="Inclusions/Logout.include.php">
                                        <button type="submit" name="logOut">Log Out</button>
                                        </form>';
                        }
                        else
                        {
                                echo '  <form action="Login.php"> 
                                        <input type="submit" value="Log In" />
                                        </form>'; //The log out function is not a button but rather a form input as it directly logs the current user out without having to go the login page
                        }
                ?>           

        </div>

        <!--navbar-->
        <div id="navbar"> <!--Here is the navigation bar, since the Tracked items page isnt necssicery for a non-logged user it isnt loaded unless a user id can be found-->
                <ul>
                        <li id="navbarBox"><a href="HomePage.php">Home</a></li>
                        <li id="navbarBox"><a href="Products.php">Products</a></li>
                                <?php
                                if (isset($_SESSION['userId']))
                                        {
                                                echo '<li id="navbarBox"><a href="TrackedItems.php">Tracked items</a></li>';
                                        }
                                ?>
                        <li id="navbarBox" style="float: right;border-left: 1px solid white;"><a href="ContactUs.php">Contact us</a></li>
                </ul>
        </div>