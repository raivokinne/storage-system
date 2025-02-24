<?php

class DBConnect {
    public $dbconn;
    private $config;

    function __construct() //connects to the db. defualt mysql
    {
        $this->config = require "../app/config.php";
        $this->dbconn = new PDO ('mysql:'.http_build_query($this->config,"",";"));
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->dbconn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    function __destruct() // Close the database connection when the object is destroyed
    {
        $this->dbconn = null;
    }
}

?>