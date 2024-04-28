<?php //The data to connect to the database, seperated from any main page to prevent data leaks (Same use as the download.database file, however it contains the connection var insted)
        $username = "s5309947";
        $password = "Dankdog101"; 
        $host = "db.bucomputing.uk";
        $port = 6612; 
        $database = $username;  

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
            }