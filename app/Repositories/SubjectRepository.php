<?php
namespace App\Repositories;

use App\Models\Subjects;
use Exception;

/**
 * Class SubjectRepository
 *
 * @package App\Repositories
 */
class SubjectRepository{

    /**
     * @var \App\Models\Subjects
     */
    protected $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new Subjects();
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
                $this->model->fill($req)->save();
            }//if update record
            else {
                $this->model->find($id)->update($req);
            }

            return true;

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
            $this->model->find($id)->delete();
            return true;
        }catch (Exception $e){
            return false;
        }
    }

}

?>