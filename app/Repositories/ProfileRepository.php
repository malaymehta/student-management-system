<?php
namespace App\Repositories;

use App\Models\Profile;
use Exception;


/**
 * Class ProfileRepository
 *
 * @package App\Repositories
 */
class ProfileRepository
{

    /**
     * @var \App\Models\Profile
     */
    protected $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new Profile();
    }

    /**
     * @param $req
     * @param $images
     * @param $id
     * @return bool
     */
    public function update($req, $images, $id)
    {
        try {
            $this->model->find($id)->update($req);
            $this->model->find($id)->update(['image'=>$images[0]]);
            return true;
        }catch (Exception $e){
            return false;
        }
    }

    /**
     * @param $userID
     * @return bool
     */
    public function deleteImages($userID)
    {
        try {
            $this->model->where(['id' => $userID])->update(['image'=>'']);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

?>