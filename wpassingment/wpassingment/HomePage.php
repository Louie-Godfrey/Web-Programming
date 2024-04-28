<?php
        include_once 'Header.php' //this can be seen on evey page, it loads the code found in the Header.php file. this allows me to load importen things like a session and style sheet
?>

        <div id="featuredItems">

<?php
        include_once (realpath(dirname(__FILE__)."/Inclusions/Download.database.include.php"));// I had alot of issues getting this Include to work, in the end i used this system that reflects the name and directory of the currently running script.    

        $connection = mysqli_init(); //connection to the databse, the varible $connection is loaded in by the Download.database.include.php file that is included above.
        if (!$connection) //This code checks if there is an error connecting to the database
                { 
                        header("Location: ../HomePage.php?error=sqlerror");
                        exit();
                }
        else
                {
                        mysqli_ssl_set($connection, NULL, NULL, NULL, '/public_html/sys_tests', NULL);
                        mysqli_real_connect($connection, $host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
                
                        if (mysqli_connect_errno())
                                {
                                        echo "<p>Failed to connect to MySQL. " .
                                        "Error (" . mysqli_connect_errno() . "): " . mysqli_connect_error() . "</p>";
                                } 
                        else
                                {
                        
                                        $query = "SELECT * FROM products;"; //This is the SQL code that will be input into the database to retrive the whole table 
                                        $result = mysqli_query($connection, $query);//execute query on the server

                                        while ($row =  mysqli_fetch_assoc($result))// loop throught the database table while there are still results left(aka loop through all data)
                                                {
                                                        ?>
                                                                <?php $id = $row['id']; ?>
                                                                <h2><?php echo $row['item_name']; ?></h2>
                                                                        <ul>
                                                                                <li><?php echo $row['item_description']; ?></li>
                                                                                <a href="Products.php">
                                                                                <img id="featuredItem" src="Images/testImage.png" alt="a featured Item"> <!--A placeholder image -->
                                                                                </a>
                                                                                <br>
                                                                                <i>Click image to go to Product page</i>
                                                                        </ul>
                                                                        <br>
                                                        <?php
                                                }
                                }
                }
                
?>
        </div>



    </body>
    <body>
        <div id="promotedItems">
                <Img id="promotedItems" src="Images/testImage.png" alt="a promoted Item">
                <Img id="promotedItems" src="Images/testImage.png" alt="a promoted Item"> 
                <Img id="promotedItems" src="Images/testImage.png" alt="a promoted Item">

<?php
        include_once 'Footer.php'
?>