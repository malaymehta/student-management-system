<?php
namespace App\Repositories;

use App\Models\Students;
use App\Models\Batches;
use App\Models\Images;
use App\Models\StudentImages;
use ImageService;
use Exception;

/**
 * Class StudentsRepository
 *
 * @package App\Repositories
 */
class StudentsRepository
{


    /**
     * @var \App\Models\Students
     */
    protected $model;
    /**
     * @var \App\Models\StudentImages
     */
    protected $studImageModel;
    /**
     * @var \App\Models\Images
     */
    protected $imageModel;

    /**
     *
     */
    public function __construct()
    {
        $this->model          = new Students();
        $this->studImageModel = new StudentImages();
        $this->imageModel     = new Images();
    }

    //Fetch all students
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
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
        try {
            if (empty($id)) {
                $this->model->fill($req)->save();
                $studId = $this->model->id;
            } elseif (!empty($id)) {
                $this->model->find($id)->update($req);
                $studId = $id;
            }

            //Call the image service provider to store image name into the table
            $imageInsertIdArray = ImageService::imageStore($imagesArray, $imagesIDArray);

            //Sync the data into the student images table
            $this->storeImages($imageInsertIdArray, $studId);
            return true;
        }catch (Exception $e){
            return false;
        }
    }

    //To store student images into the student images table
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
                    $this->studImageModel->create(['student_id' => $lastInsertedId, 'image_id' => $imageInsertIdArray[$j]]);
                }
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    //Delete the record from the database Student_Image Table
    /**
     * @param $studentID
     * @param $imageID
     * @return bool
     */
    public function deleteImages($studentID, $imageID)
    {
        try {
            $this->studImageModel->where(['student_id' => $studentID, 'image_id' => $imageID])->delete();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    //fetch the student records as per the given id with classed and qualities relationships
    /**
     * @param $id
     * @param $relation
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getWithRelationsById($id, $relation)
    {
        return $this->model->with($relation)->find($id);
    }

    //Delete Student record
    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        try {
            $this->model->find($id)->delete();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    //Fetch student by id
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

}

?>

