<?php
    class Database
    {
        public function connect()
        {
            $link = mysqli_connect("database", "root", $_ENV['MYSQL_ROOT_PASSWORD'], $_ENV['MYSQL_DATABASE']);

            if(mysqli_connect_errno() === 0) {
                return $link;
            }
            
            return false;
        }
    }