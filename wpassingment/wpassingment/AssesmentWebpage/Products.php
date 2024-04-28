<?php
        include_once 'Header.php'
?>
        <div id="searchbar">
                <form action="Search.result.php" method="post">
                        <input type="text" name="search" placeholder="Search Products">
                        <button type="submit" name="submitSearchQuery"></button>
                </form>
        </div>
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
                                                                                <li>£<?php echo $row['item_cost'];?></li>
                                                                                <li>In Stock: <?php echo $row['item_stock']; ?></li>
                                                                        </ul>
                                                                <section class="productSelectionForm">

                                                                        <form id="productSelect" action="Inclusions\Product.link.table.include.php" method="post">
                                                                                <input type="hidden" name="productId" value="<?php echo $id;?>">
                                                                                <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']?>">
                                                                                <button type="submit" name="productItemTrack">Track this item</button>
                                                                        </form>
                                                                        <br>
                                                                </section>   

                                                        <?php
                                                }
                                }
                }
                
?>

<?php
        include_once 'Footer.php'
?>