<?php 
    class Model extends Database 
    {
        public function __construct()
        {
            $this->connect();
        }

        private function __query($sql)
        {
            return mysqli_query($this->connect(), $sql);
        }

        public function all($table, $column = ['*'], $orderBy = 'asc', $limit = '')
        {
            $column = implode(',', $column);

            if($limit != 0)
                $sql = "SELECT ${column} FROM ${table} ORDER BY id ${orderBy} LIMIT ${limit}";
            else
                $sql = "SELECT ${column} FROM ${table} ORDER BY id ${orderBy}";

            $data = [];
            
            $query = $this->__query($sql);

            while($row = mysqli_fetch_assoc($query))
            {
                array_push($data, $row);
            }

            return $data;
        }

        public function allWhere($table, $column = ['*'], $orderBy = 'asc', $limit = '', $whereRaw = '')
        {
            $column = implode(',', $column);

            if($limit != 0)
                $sql = "SELECT ${column} FROM ${table}". (isset($whereRaw) ? " WHERE ${whereRaw} " : " ") . "ORDER BY id ${orderBy} LIMIT ${limit}";
            else
                $sql = "SELECT ${column} FROM ${table}". (isset($whereRaw) ? " WHERE ${whereRaw} " : " ") . "ORDER BY id ${orderBy}";

            $data = [];
            
            $query = $this->__query($sql);

            while($row = mysqli_fetch_assoc($query))
            {
                array_push($data, $row);
            }

            return $data;
        }

        public function one($table, $column = ['*'], $id = '')
        {
            $column = implode(',', $column);

            $sql = "SELECT ${column} FROM ${table} WHERE id = ${id}";
            
            $query = $this->__query($sql);

            $row = mysqli_fetch_assoc($query);

            return $row;
        }

        public function store($table, $data = [])
        {
            $column = implode(',', array_keys($data));

            $values = array_map(function($value){
                return "'" . $value . "'";
            }, array_values($data));

            $values = implode(',', array_values($values));

            $sql = "INSERT INTO ${table}(${column}) VALUES (${values})";

            return $this->__query($sql);
        }

        public function edit($table, $id, $data = [])
        {
            $update = [];

            foreach($data as $key => $value)
            {
                array_push($update, $key . " = " . "'" . $value . "'"); 
            }

            $update = implode(',', $update);

            $sql = "UPDATE ${table} SET ${update} WHERE id = ${id}";

            return $this->__query($sql);
        }

        public function remove($table, $id)
        {
            $sql = "DELETE FROM ${table} WHERE id = ${id}";

            return $this->__query($sql);
        }

        public function has($table, $column = ['*'], $join = [], $limit = '')
        {
            $column = implode(',', $column);

            $joined = implode(',', array_keys($join));

            $foreign = implode(',', array_values($join));

            if($limit != 0)
                $sql = "SELECT ${column} FROM ${table} JOIN ${joined} ON ${joined}.id = ${table}.${joined}_id WHERE ${joined}.id = ${foreign} LIMIT ${limit}";
            else
                $sql = "SELECT ${column} FROM ${table} JOIN ${joined} ON ${joined}.id = ${table}.${joined}_id WHERE ${joined}.id = ${foreign}";

            $data = [];
            
            $query = $this->__query($sql);

            while($row = mysqli_fetch_assoc($query))
            {
                array_push($data, $row);
            }

            return $data;
        }
    }