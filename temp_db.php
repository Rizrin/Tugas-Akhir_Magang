<?php
$m = new mysqli('localhost', 'root', 'root');
if ($m->connect_error) {
    die("Connection failed: " . $m->connect_error);
}
$m->query('CREATE DATABASE IF NOT EXISTS SBU');
echo "DB created.";
