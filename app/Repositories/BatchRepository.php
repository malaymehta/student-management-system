<?php
namespace App\Repositories;

use App\Models\Batches;
use App\Models\BatchImages;
use Exception;
use ImageService;

/**
 * Class ClassRepository
 *
 * @package App\Repositories
 */
class BatchRepository
{

    /**
     * @var \App\Models\Batches
     */
    private $model;

    /**
     * @var \App\Models\BatchImages
     */
    private $batchImageModel;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new Batches();
        $this->batchImageModel = new BatchImages();
    }


    /**
     * get all the records from class table
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll(){
        return $this->model->get()->sortByDesc('created_at');

    }


    /**
     * @param        $req
     * @param string $id
     * @param        $imagesArray
     * @param        $imagesIDArray
     * @return bool
     */
    public function store($req, $id='', $imagesArray, $imagesIDArray)
    {
        try{
            //If record store
            if(empty($id)){
                $this->model->fill($req)->save();
                $batchId = $this->model->id;
            }//If record update
            else{
                $this->model->find($id)->update($req);
                $batchId = $id;
            }
            //Call the image service provider to store image name into the table
            $imageInsertIdArray = ImageService::imageStore($imagesArray, $imagesIDArray);

            //Sync the data into the student images table
            $this->storeImages($imageInsertIdArray, $batchId);

            return true;

        }catch (Exception $e){
            return false;
        }
    }


    /**
     * @param $imageInsertIdArray
     * @param $lastInsertedId
     * @return bool
     */
    public function storeImages($imageInsertIdArray, $lastInsertedId)
    {
        try {
            if (sizeof($imageInsertIdArray) > 0) {
                for ($j = 0; $j < sizeof($imageInsertIdArray); $j++) {
                    $this->batchImageModel->create(['batch_id' => $lastInsertedId, 'image_id' => $imageInsertIdArray[$j]]);
                }
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $batchID
     * @param $imageID
     * @return bool
     */
    public function deleteImages($batchID, $imageID)
    {
        try {
            $this->batchImageModel->where(['batch_id' => $batchID, 'image_id' => $imageID])->delete();
            return true;
        } catch (Exception $e) {
            return false;
        }
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


    /**
     * @param $id
     * @return mixed
     */
    public function getByYearId($id)
    {
        return $this->model->where('academic_year_id', $id)->where('status', '1')->get();
    }

    /**
     * @return mixed
     */
    public function getAllActive()
    {
        return $this->model->where('status', '1')->get()->sortByDesc('created_at');
    }


}

?>