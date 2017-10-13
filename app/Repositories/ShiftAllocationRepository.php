<?php
namespace App\Repositories;

use App\Models\ShiftAllocation;
use Exception;

class ShiftAllocationRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new ShiftAllocation();
    }

    public function getAll()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

    public function store($shiftId, $effectiveDate, $employeeIds)
    {
        try {
            if (sizeof($employeeIds > 0)) {
                for ($i = 0; $i < sizeof($employeeIds); $i++) {
                    $recExists = $this->getByUserId($employeeIds[$i]);
                    //If record already inserted into the table for particular user, then only update the record
                    if ($recExists) {
                        $this->model->where('user_id', $employeeIds[$i])->update(['effective_date'=>$effectiveDate, 'shift_id'=>$shiftId]);
                    }//Else insert the new record for the user
                    else {
                        $this->model->create(['effective_date'=>$effectiveDate, 'shift_id'=>$shiftId, 'user_id'=> $employeeIds[$i]]);
                    }
                }
            }

        } catch (Exception $e) {
            return false;
        }
    }

    public function getByUserId($id)
    {
        return $this->model->where('user_id', $id)->count();
    }

}

?>