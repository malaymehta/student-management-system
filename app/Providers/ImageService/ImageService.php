<?php

namespace App\Providers\ImageService;

use Illuminate\Http\Request;
use App\Models\Images;
use Exception;


/**
 * Class ImageService
 *
 * @package App\Providers\ImageService
 */
class ImageService
{
    protected $imageModel;
    /**
     *
     */
    public function __construct(){
        $this->imageModel = new Images();
    }


    /**
     * function to upload images into folder
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function imageUpload(Request $request)
    {
        //Save file into directory
        try {
            $image     = $request->file('file');
            $imageName = time() . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            return response()->json(['success' => $imageName, 'code' => 200]);
        }catch (Exception $e){
            $errMsg = "Something went wrong!";
            return response()->json(['error' => $errMsg, 'code' => 420]);
        }
    }


    /**
     * To store image in Images table
     * @param $imageArray
     */
    public function imageStore($imagesArray, $imagesIDArray)
    {
        try {
            $imageInsertIdArray = array();
            //Save student id and image id into the entities table
            for ($i = 0; $i < sizeof($imagesArray); $i++) {
                if (empty($imagesIDArray[$i])) {
                    $imageInsertIdArray[] = $this->imageModel->create(['name' => $imagesArray[$i]])->id;
                } else {
                    continue;
                }
            }

            return $imageInsertIdArray;
        }catch (Exception $e){
            return false;
        }
    }

    /**
     * function to delete image from the folder and DB table
     * @param \Illuminate\Http\Request $request
     */
    public function imageDelete($imageID, $imageName)
    {
        try {
            //Delete From the Folder
            unlink(public_path('uploads') . '/' . $imageName);
            //Delete the record from the database Image Table
            $this->imageModel->find($imageID)->delete();
            return true;
        }catch (Exception $e){
            return false;
        }

    }
}
