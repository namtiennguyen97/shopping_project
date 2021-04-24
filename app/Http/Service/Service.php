<?php


namespace App\Http\Service;


interface Service
{
    public function index();

    public function create($request);

    public function update($id, $request);

    public function findOrFail($id);

    public function delete($id);
}
