<?php


namespace App\Http\Repository\EloquentImplement;


use App\Http\Repository\Repository;

abstract class EloquentImplement implements Repository
{

    protected $model;
    public function __construct()
    {
        $this->model = $this->setModel();
    }

    //lay model
    abstract public function getModel();

    public function setModel(){
        return $this->model = app()->make($this->getModel());
    }

    public function index()
    {
        return $result = $this->model->all();
    }

    public function create($data)
    {
       return $this->model->create($data);
    }

    public function update($object, $data)
    {
        // TODO: Implement update() method.
    }

    public function findOrFail($id)
    {
        // TODO: Implement findOrFail() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
