<?php

namespace App\Http\Controllers;

use App\Http\Requests\BatchPost;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Repositories\BatchRepository;
use App\Repositories\AcademicYearRepository;
use App\Repositories\CourseRepository;
use ImageService;
use Exception;
use DB;
use Carbon\Carbon;

/**
 * Class ClassController
 *
 * @package App\Http\Controllers
 */
class BatchController extends Controller
{

    /**
     * @var \App\Repositories\BatchRepository
     */
    protected $batchRepo;
    /**
     * @var \App\Repositories\AcademicYearRepository
     */
    protected $academicYearRepo;
    /**
     * @var \App\Repositories\CourseRepository
     */
    protected $courseRepo;

    /**
     * @param \App\Repositories\BatchRepository        $batchRepository
     * @param \App\Repositories\AcademicYearRepository $academicYearRepository
     * @param \App\Repositories\CourseRepository       $courseRepository
     */
    public function __construct(BatchRepository $batchRepository, AcademicYearRepository $academicYearRepository, CourseRepository $courseRepository)
    {
        $this->batchRepo        = $batchRepository;
        $this->academicYearRepo = $academicYearRepository;
        $this->courseRepo       = $courseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('batch.list');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getIndexPaginated()
    {
        $batches     = $this->batchRepo->getAll();
        $data_tables = Datatables::of($batches)->editColumn('options', function ($batches) {
            return "<a href='" . route('batches.edit', ['id' => $batches->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-pencil-square-o'></i></a>&nbsp;<a href='" . route('batches.show', ['id' => $batches->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-trash-o'></i></a>";
        });

        return $data_tables->rawColumns(['options'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academicYearObj = $this->academicYearRepo->getAllActive();
        $academicYear    = $academicYearObj->pluck('name', 'id')->all();

        $courseObj = $this->courseRepo->getAll();
        $course    = $courseObj->pluck('name', 'id')->all();

        return view('batch.manage', compact('academicYear', 'course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BatchPost $request)
    {
        DB::beginTransaction();
        try {
            $req           = [
                'name'             => $request->name,
                'alias'            => $request->alias,
                'start_date'       => Carbon::parse($request->start_date)->format('Y-m-d'),
                'end_date'         => Carbon::parse($request->end_date)->format('Y-m-d'),
                'academic_year_id' => $request->academic_year_id,
                'course_id'        => $request->course_id,
                'status'           => $request->status
            ];
            $imagesArray   = $request->image_name;
            $imagesIDArray = $request->image_id;

            //Call repository function to perform store
            $this->batchRepo->store($req, '', $imagesArray, $imagesIDArray);

            DB::commit();
            flash('Batch created successfully!')->success();

        } catch (Exception $e) {
            DB::rollback();
            flash('Batch has not been created!')->error();
        }

        return redirect()->route('batches.index');
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function imageUpload(Request $request)
    {
        //Call imageServiceProvider to store image into upload folder
        return ImageService::imageUpload($request);
    }

    /** Function to delete image from the server and database
     *
     * @param \Illuminate\Http\Request $request
     */
    public function imageDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $batchID   = $request->entityID;
            $imageID   = $request->imageID;
            $imageName = $request->imageVal;

            //Call Image Service Provider to delete image from folder and DB
            ImageService::imageDelete($imageID, $imageName);
            //Delete the record from the database Student_Image Table
            $this->batchRepo->deleteImages($batchID, $imageID);

            DB::commit();
            return response()->json(['success' => true]);

        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['success' => false]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $batch = $this->batchRepo->getWithRelationsById($id, ['students', 'images', 'academicYear', 'courses']);

        //Fetch the image from the images table
        $images       = $batch->images->pluck('name')->all();
        $academicYear = $batch->academicYear->pluck('name')->all();
        $course       = $batch->courses->pluck('name')->all();

        return view('batch.show', compact('batch', 'images', 'academicYear', 'course'));
    }

    /**
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $batch = $this->batchRepo->getById($id);

        $academicYearObj = $this->academicYearRepo->getAllActive();
        $academicYear    = $academicYearObj->pluck('name', 'id')->all();

        $courseObj = $this->courseRepo->getAll();
        $course    = $courseObj->pluck('name', 'id')->all();

        $batchObj          = $this->batchRepo->getWithRelationsById($id, ['images', 'courses', 'academicYear']);
        $batchAcademicYear = $batchObj->academicYear->pluck('id')->all();
        $batchCourse       = $batchObj->courses->pluck('id')->all();

        $batchImages = $batchObj->images->mapWithKeys(function ($image) {
            return [$image['id'] => $image['name']];
        });
        $images      = $batchImages->toArray();
        return view('batch.manage', compact('batch', 'images', 'academicYear', 'course', 'batchAcademicYear', 'batchCourse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(BatchPost $request, $id)
    {
        DB::beginTransaction();
        try {
            $req           = [
                'name'             => $request->name,
                'alias'            => $request->alias,
                'start_date'       => Carbon::parse($request->start_date)->format('Y-m-d'),
                'end_date'         => Carbon::parse($request->end_date)->format('Y-m-d'),
                'academic_year_id' => $request->academic_year_id,
                'course_id'        => $request->course_id,
                'status'           => $request->status
            ];
            $imagesArray   = $request->image_name;
            $imagesIDArray = $request->image_id;

            //Save student id and image id into the entities table
            $this->batchRepo->store($req, $id, $imagesArray, $imagesIDArray);
            DB::commit();
            flash('Batch updated successfully!')->success();

        } catch (Exception $e) {
            DB::rollback();
            flash('Batch has not been updated!')->error();
        }

        return redirect()->route('batches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //$this->model->find($id)->students()->delete();
            $this->batchRepo->delete($id);
            flash('Batch deleted successfully!')->success();

        } catch (Exception $e) {
            flash('Batch has not been deleted!')->error();
        }
        return redirect()->route('batches.index');
    }
}
