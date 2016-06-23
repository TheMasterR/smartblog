<?php

class DBMySql implements DBMySqlInterface
{
    protected $connection;

    ## DATABASE CREDENTIALS
    private $DB_HOST     = '127.0.0.1';
    private $DB_USERNAME = 'pantea_lucian';
    private $DB_PASSWORD = 'supersecurepassword';
    private $DB_NAME     = 'smartblog';

    function __constructor()
    {
        //TO DO;
    }

    public function connect()
    {
        $this->connection = mysqli_connect(
            $this->DB_HOST,
            $this->DB_USERNAME,
            $this->DB_PASSWORD,
            $this->DB_NAME
        );
    }

    public function query($query_text)
    {
        $result = mysqli_query($this->connection,$query_text);
        # REPORT ERRORS TO USER
        if ($result === false)
        {
            echo 'Query error:';
            deg($query_text);
            deg(mysqli_error($this->connection));
            die;
        }

        if (is_object($result))
        {
            $rows = [];
            while($row = mysqli_fetch_array($result,MYSQL_ASSOC))
            {
                $rows[] = $row;
            }
            return $rows;
        }

        return true;
    }

    public function insertId()
    {
        # Return the last querry insert id
        return mysqli_insert_id($this->connection);
    }

    # SANITIZE THE QUERY
    public function realEscape($string)
    {
        return mysqli_real_escape_string($this->connection, $string);
    }
} // END OF CLASS
