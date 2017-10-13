<?php
namespace App\Repositories;

use App\Models\AcademicYears;
use Exception;

/**
 * Class AcademicYearRepository
 *
 * @package App\Repositories
 */
class AcademicYearRepository
{
    /**
     * @var \App\Models\AcademicYears
     */
    protected $model;

    /**
     *
     */
    public function __construct()
    {

        $this->model = new AcademicYears();
    }

    /**
     * @return static
     */
    public function getAll()
    {
        return $this->model->get()->sortByDesc("created_at");
    }

    /**
     * @param        $req
     * @param string $id
     * @return bool
     */
    public function store($req, $id = '')
    {
        try {
            //To store records\
            if (empty($id)) {
                return $this->model->fill($req)->save();
            }//To update record
            else {
                return $this->model->find($id)->update($req);
            }
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        try {
            return $this->model->find($id)->delete();
        } catch (Exception $e) {
            return false;
        }
    }


    /**
     * @param $id
     * @return bool
     */
    public function getById($id)
    {
        try {
            return $this->model->find($id);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getAllActive()
    {
        return $this->model->where('status', '1')->orderBy('name', 'ASC')->get();
    }


}

?>