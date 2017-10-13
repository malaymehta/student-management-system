<?php
namespace App\Repositories;

use App\Models\Shifts;
use Exception;

/**
 * Class ShiftRepository
 *
 * @package App\Repositories
 */
class ShiftRepository
{
    /**
     * @var \App\Models\Shifts
     */
    protected $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new Shifts();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->orderBY('created_at', 'DESC')->get();
    }

    /**
     * @param        $req
     * @param string $id
     * @return bool
     */
    public function store($req, $id = '')
    {
        try {
            //store new record into the database
            if (empty($id)) {
                return $this->model->fill($req)->save();
            } //update the records in database
            else {
                return $this->model->find($id)->update($req);
            }
        }catch (Exception $e){
            return false;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }


}

?>