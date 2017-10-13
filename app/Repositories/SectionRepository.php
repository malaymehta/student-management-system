<?php
namespace App\Repositories;

use Exception;
use App\Models\Sections;

/**
 * Class SectionRepository
 *
 * @package App\Repositories
 */
class SectionRepository{

    /**
     * @var \App\Models\Sections
     */
    protected $model;

    /**
     * @param \App\Models\Sections $sections
     */
    public function __construct(Sections $sections)
    {
        $this->model = new Sections();
    }

    /**
     * @return static
     */
    public function getAll()
    {
        return $this->model->all()->sortByDesc('created_at');
    }


    /**
     * @param $id
     * @param $relation
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getWithRelationsById($id, $relation)
    {
        return $this->model->with($relation)->find($id);
    }

    /**
     * @param $relation
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getWithRelationsAll($relation)
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


    public function getByBatchId($id)
    {
        return $this->model->where('batch_id', $id)->get();
    }
}

?>