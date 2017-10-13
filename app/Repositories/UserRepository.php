<?php
namespace App\Repositories;

use App\Models\User;
use Exception;
use DB;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository
{
    /**
     * @var \App\Models\User
     */
    protected $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->where('role_id','!=', '1')->get()->sortByDesc('created_at');
    }

    /**
     * @param $relation
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getWithRelation($relation)
    {
        return $this->model->with($relation)->where('role_id','!=', '1')->get();
    }

    /**
     * @param        $req
     * @param string $id
     * @return bool
     */
    public function store($req, $id='')
    {
        try{
            //If record store
            if(empty($id)){
                $this->model->fill($req)->save();
                return $this->model->id;
            }//If record update
            else{
                return $this->model->find($id)->update($req);
            }

        }catch (Exception $e){
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
        }catch (Exception $e){
            return false;
        }
    }

    /**
     * @param $id
     * @param $relation
     * @return bool|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getWithRelationId($id, $relation)
    {
        try {
            return $this->model->with($relation)->find($id);
        }catch (Exception $e)
        {
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
        }catch (Exception $e){
            return false;
        }
    }


    /**
     * @param string $departmentId
     * @param string $designationId
     * @param string $name
     * @return mixed
     */
    public function searchEmp($departmentId='', $designationId='', $name='', $relation)
    {
        $query = $this->model->with($relation);//DB::table('users');
        if($departmentId!='')
            $query->where('department_id', $departmentId);
        if($designationId!='')
            $query->where('designation_id', $designationId);
        if($name!='')
            $query->where('name', 'like', '%'.$name.'%');

        $query->where('role_id','!=', '1')->get();
        //print_r($query->toSql());
        return $query;
    }

}

?>