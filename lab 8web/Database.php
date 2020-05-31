<?php


class Database
{
    var $host   = "localhost";
    var $user     = "root";
    var $pass     = "";
    var $database = "lab8";

    public $link;

    public function Database($host, $user, $pass, $database)
    {
        $this->host=$host;
        $this->user=$user;
        $this->pass=$pass;
        $this->database=$database;

    }

    public function connect()
    {
        $this->link = new mysqli($this->host,$this->user,$this->pass,$this->database);
        if (mysqli_connect_error())
        {
            return null;
        }
        else
            return $this->link;

    }
}