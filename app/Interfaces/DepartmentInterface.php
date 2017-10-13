<?php
namespace App\Interfaces;


interface DepartmentInterface
{
    public function getDepartments();

    public function store($data);

    public function getDepartmentById($id);

    public function update($data, $id);

    public function destroy($id);

}