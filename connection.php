<?php
// define('DB_SERVER', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'sql12629011');

// define('DB_SERVER', 'sql12.freemysqlhosting.net');
// define('DB_USER', 'sql12629011');
// define('DB_PASS', 'RzlzHmeUy8');
// define('DB_NAME', 'sql12629011');

define('DB_SERVER', 'db4free.net');
define('DB_USER', 'juhosi');
define('DB_PASS', 'juhosi123');
define('DB_NAME', 'juhosi');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
