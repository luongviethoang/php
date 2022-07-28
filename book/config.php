<?php

define('DB_SERVE', 'Localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME','books');

$Link = mysqli_connect(DB_SERVE, DB_USERNAME,DB_PASSWORD,DB_NAME);

if($Link === false){
    die("ERROR: Could not connect. ". mysqli_connect_error());
}
?><?php
