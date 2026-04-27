<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$tests = [
    ['user' => 'root', 'pass' => ''],
    ['user' => 'root', 'pass' => 'root'],
];

foreach ($tests as $t) {
    echo "Testing root with '" . $t['pass'] . "'... ";
    try {
        $m = new mysqli('localhost', $t['user'], $t['pass']);
        if ($m->connect_error) {
            echo "Failed: $m->connect_error\n";
        } else {
            echo "Success!\n";
            $m->query('CREATE DATABASE IF NOT EXISTS SBU');
            echo "DB created.\n";
            exit;
        }
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage() . "\n";
    }
}
