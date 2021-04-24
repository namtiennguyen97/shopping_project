<?php


namespace App\Http\Repository;


interface Repository
{
    public function index();

    public function create($data);

    public function update($object,$data);

    public function findOrFail($id);

    public function delete($id);
}
