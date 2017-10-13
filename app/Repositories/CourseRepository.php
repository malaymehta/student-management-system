<?php
namespace App\Repositories;

use App\Models\Courses;
use Exception;

/**
 * Class CourseRepository
 *
 * @package App\Repositories
 */
class CourseRepository
{

    /**
     * @var \App\Models\Courses
     */
    protected $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new Courses();
    }

    /**
     * @return static
     */
    public function getAll()
    {
        return $this->model->all()->sortByDesc('created_at');
    }

    /**
     * @param        $req
     * @param string $id
     * @return bool
     */
    public function store($req, $id = '')
    {
        try {
            //if store record
            if (empty($id)) {
                return $this->model->fill($req)->save();
            }//if update record
            else {
                return $this->model->find($id)->update($req);
            }
        } catch (Exception $e) {
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
     * @return bool
     */
    public function delete($id)
    {
        try{
            return $this->model->find($id)->delete();
        }catch (Exception $e){
            return false;
        }
    }

}

?>