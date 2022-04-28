<?php

interface ModelInterface
{
    public function getAll($orderBy, $limit);

    public function getOne($id);
    
    public function createOne($data);

    public function updateOne($data);

    public function deleteOne($id);

}