<?php

$db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

if ($db) {

    echo "Database is successfully connected";

} else {

    echo "Fail to connect the database";

}