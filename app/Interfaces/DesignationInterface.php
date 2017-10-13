<?php
namespace App\Interfaces;


interface DesignationInterface
{
    public function getDesignations();

    public function store($data);

    public function getDesignationById($id);

    public function update($data, $id);

    public function destroy($id);

}