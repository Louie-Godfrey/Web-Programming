<?php
        include_once 'Header.php'
?>
<?php
        include_once (realpath(dirname(__FILE__)."/Inclusions/Download.database.include.php"));// I had alot of issues getting this Include to work, in the end i used this system that reflects the name and directory of the currently running script.    

        $connection = mysqli_init(); 
        if (!$connection) 
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
                                        header("Location: ../TrackedItems.php?error=sqlerror");
                                        exit();
                                } 
                        else
                                {
                                        $userId = $_SESSION['userId'];
                                        $query = "SELECT * FROM  products, products_users_link WHERE id = product_id AND user_id = '".$userId."'"; //This is the SQL code that will be input into the database to retrive the whole table 
                                        $result = mysqli_query($connection, $query);//execute query on the server

                                        while ($row =  mysqli_fetch_assoc($result))// loop throught the database table while there are still results left(aka loop through all data)
                                                {
                                                        ?>
                                                                <?php $id = $row['id']; ?>
                                                                <h2><?php echo $row['item_name']; ?></h2>
                                                                        <ul>
                                                                                <li><?php echo $row['item_description']; ?></li>
                                                                                <li>£<?php echo $row['item_cost'];?></li>
                                                                                <li>In Stock: <?php echo $row['item_stock']; ?></li>
                                                                        </ul>
                                                        <?php
                                                }
                                }
                }
        
?>

<?php
        include_once 'Footer.php'
?>