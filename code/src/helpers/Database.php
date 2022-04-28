<?php
    class Database
    {
        public function connect()
        {
            $link = mysqli_connect("database", "root", $_ENV['MYSQL_ROOT_PASSWORD'], null);

            if(mysqli_connect_errno() === 0)
                return $link;
            
            return false;
        }
    }