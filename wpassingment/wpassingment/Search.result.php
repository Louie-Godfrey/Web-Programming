<?php
            include_once 'Header.php'
?>

<!--Unfotunatly i could not get the search function to work, the sql code works and the code runs withount error but the varible isnt picked up by the sql statment -->

<?php 
    include_once (realpath(dirname(__FILE__)."/Inclusions/Download.database.include.php"));

    $search = mysqli_real_escape_string($connection, $_POST['search']);

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
                        
                                        $query = "SELECT * FROM products WHERE item_name LIKE '$search'"; //This is the SQL code that will be input into the database to retrive the whole table 
                                        $result = mysqli_query($connection, $query);//execute query on the server
                                        $queryResults = mysqli_num_rows($result);

                                        if ($queryResults > 0)
                                        {
                                            while ($row = mysqli_fetch_assoc($result))
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
                                    else
                                        {
                                            header("Location: ../AssesmentWebpage/Products.php?error=nomatches&search=".$search);
                                            exit(); 
                                        }
                                }
                }

/*
    if (isset($_POST['submitSearchQuery']))
        {
            $search = mysqli_real_escape_string($connection, $_POST['search']);
            $query = "SELECT * FROM products WHERE item_name LIKE '$search'";
            $result = mysqli_query($connection, $query);
            $queryResults = mysqli_num_rows($result);

                if ($queryResults > 0)
                    {
                        while ($row = mysqli_fetch_assoc($result))
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
                else
                    {
                        header("Location: ../AssesmentWebpage/Products.php?error=nomatches&search=".$search);
                        exit(); 
                    }
        }

*/
?>
<?php
        include_once 'Footer.php'
?>

