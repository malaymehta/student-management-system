<?php
namespace App\Repositories;
use Exception;
use App\Models\QuestionCategories;

/**
 * Class QuestionCategoryRepository
 *
 * @package App\Repositories
 */
class QuestionCategoryRepository{

    /**
     * @var \App\Models\QuestionCategories
     */
    protected $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new QuestionCategories();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * @param $relation
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getWithRelationAll($relation)
    {
        return $this->model->with($relation)->get();
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
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @param $relation
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getWithRelationById($id, $relation)
    {
        return $this->model->with($relation)->find($id);
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function delete($id)
    {
        try {
            return $this->model->find($id)->delete();
        }catch (Exception $e){
            return false;
        }
    }

}

?>