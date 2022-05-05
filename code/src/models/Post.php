<?php 

    class PostModel extends Model implements ModelInterface
    {
        protected $table = 'post';

        protected $select = [
            '*',
        ];

        public function getAll($orderBy = "ASC", $limit = 0)
        {
            return $this->all($this->table, $this->select, $orderBy, $limit);
        }

        public function getAllWhere($orderBy = "ASC", $limit = 0, $where = '')
        {
            return $this->all($this->table, $this->select, $orderBy, $limit, $where);
        }

        public function getOne($id = 0)
        {
            return $this->one($this->table, $this->select, $id);

        }

        public function createOne($data = [])
        {
            return $this->store($this->table, $data);
        }

        public function updateOne($data = [])
        {
            return $this->edit($this->table, $data['id'], $data);
        }

        public function deleteOne($id = 0)
        {
            return $this->remove($this->table, $id);
        }

        public function hasMany($join = [], $limit = 0)
        {
            return $this->has($this->table, $this->select, $join, $limit);
        }
    }