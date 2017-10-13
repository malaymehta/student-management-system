<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentPost;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use ImageService;
use App\Repositories\StudentsRepository;
use App\Repositories\BatchRepository;
use App\Repositories\AcademicYearRepository;
use App\Repositories\CourseRepository;
use App\Repositories\SectionRepository;
use DB;
use Exception;

/**
 * Class StudentsController
 *
 * @package App\Http\Controllers
 */
class StudentsController extends Controller
{
    /**
     * @var \App\Repositories\StudentsRepository
     */
    protected $studRepo;

    /**
     * @var \App\Repositories\BatchRepository
     */
    protected $batchRepo;

    /**
     * @var \App\Repositories\AcademicYearRepository
     */
    protected $yearRepo;
    /**
     * @var \App\Repositories\CourseRepository
     */
    protected $courseRepo;
    /**
     * @var \App\Repositories\SectionRepository
     */
    protected $sectionRepo;


    /**
     * @param \App\Repositories\StudentsRepository     $studRepo
     * @param \App\Repositories\BatchRepository        $batchRepo
     * @param \App\Repositories\AcademicYearRepository $academicYearRepository
     * @param \App\Repositories\SectionRepository      $sectionRepository
     * @param \App\Repositories\CourseRepository       $courseRepository
     */
    public function __construct(StudentsRepository $studRepo, BatchRepository $batchRepo, AcademicYearRepository $academicYearRepository, SectionRepository $sectionRepository, CourseRepository $courseRepository)
    {
        $this->studRepo    = $studRepo;
        $this->batchRepo   = $batchRepo;
        $this->yearRepo    = $academicYearRepository;
        $this->courseRepo  = $courseRepository;
        $this->sectionRepo = $sectionRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('students.list');
    }


    /**
     * ajax call for datatable
     *
     * @return mixed
     * @throws \Exception
     */
    public function getIndexPaginated()
    {
        $stud        = $this->studRepo->getAll();
        $data_tables = Datatables::of($stud);

        $data_tables->editColumn('class_name', function ($stud) {
            return $stud->batches->name;
        });
        $data_tables->editColumn('course', function ($stud) {
            return $stud->course->name;
        });
        $data_tables->editColumn('options', function ($stud) {
            return "<a href='" . route('students.edit', ['id' => $stud->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-pencil-square-o'></i></a> &nbsp; <a href='" . route('students.show', ['id' => $stud->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-trash-o'></i></a>";
        });

        return $data_tables->rawColumns(['class_name', 'course', 'options'])->make(true);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //Fetch all batches name and id
        $batchesObj = $this->batchRepo->getAll();
        $batches    = $batchesObj->pluck('name', 'id')->all();
        //Fetch academic year name and id
        $academicYearObj = $this->yearRepo->getAll();
        $academicYears   = $academicYearObj->pluck('name', 'id')->all();
        //Fetch Courses name and id
        $courseObj = $this->courseRepo->getAll();
        $courses   = $courseObj->pluck('name', 'id')->all();
        //Fetch sections name and id
        $sectionObj = $this->sectionRepo->getAll();
        $sections   = $sectionObj->pluck('name', 'id')->all();

        return view('students.manage', compact('batches', 'academicYears', 'courses', 'sections'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StudentPost $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StudentPost $request)
    {
        DB::beginTransaction();
        try {
            $req           = $request->only('name', 'email', 'gr_no', 'academic_year_id', 'course_id', 'batch_id', 'section_id');
            $imagesArray   = $request->image_name;
            $imagesIDArray = $request->image_id;

            //To perform store operations
            $this->studRepo->store($req, '', $imagesArray, $imagesIDArray);

            DB::commit();
            flash('Student created successfully!')->success();

        } catch (Exception $e) {
            DB::rollback();
            flash('Student has not been created!')->error();
        }

        return redirect()->route('students.index');

    }


    /**
     * Function to upload image using ajax
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function imageUpload(Request $request)
    {
        //Call imageServiceProvider to store image into upload folder
        return ImageService::imageUpload($request);
    }


    /**
     *  Function to delete image from the server and database
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function imageDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $studentID = $request->entityID;
            $imageID   = $request->imageID;
            $imageName = $request->imageVal;

            //Call Image Service Provider to delete image from folder and DB
            ImageService::imageDelete($imageID, $imageName);
            //Delete the record from the database Student_Image Table
            $this->studRepo->deleteImages($studentID, $imageID);
            DB::commit();
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['success' => false]);
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $record       = $this->studRepo->getWithRelationsById($id, ['batches', 'academicYear', 'course', 'section', 'images']);
        $images       = $record->images->pluck('name')->all();
        $academicYear = $record->academicYear->pluck('name')->all();
        $course       = $record->course->pluck('name')->all();
        $batch       = $record->batches->pluck('name')->all();
        $section      = $record->section->pluck('name')->all();

        //print_r($record->course->name);

        return view('students.show', compact(['record', 'academicYear', 'batch', 'course', 'section', 'images']));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $student = $this->studRepo->getWithRelationsById($id, ['images']);

        //Fetch all batches name and id
        $batchesObj = $this->batchRepo->getAll();
        $batches    = $batchesObj->pluck('name', 'id')->all();
        //Fetch academic year name and id
        $academicYearObj = $this->yearRepo->getAll();
        $academicYears   = $academicYearObj->pluck('name', 'id')->all();
        //Fetch Courses name and id
        $courseObj = $this->courseRepo->getAll();
        $courses   = $courseObj->pluck('name', 'id')->all();
        //Fetch sections name and id
        $sectionObj = $this->sectionRepo->getAll();
        $sections   = $sectionObj->pluck('name', 'id')->all();

        //Fetch images
        $studImages = $student->images->mapWithKeys(function ($image) {
            return [$image['id'] => $image['name']];
        });

        $images = $studImages->toArray();

        return view('students.manage', compact('student', 'batches', 'academicYears', 'courses', 'sections', 'images'));
    }


    /**
     * @param \App\Http\Requests\StudentPost $request
     * @param                                $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StudentPost $request, $id)
    {
        DB::beginTransaction();
        try {
            $req           = $request->only('name', 'email', 'gr_no', 'academic_year_id', 'course_id', 'batch_id', 'section_id');
            $imagesArray   = $request->image_name;
            $imagesIDArray = $request->image_id;

            //Update Student Data
            $this->studRepo->store($req, $id, $imagesArray, $imagesIDArray);

            DB::commit();
            flash('Student updated successfully!')->success();
        } catch (Exception $e) {

            DB::rollback();
            flash('Student has not been updated successfully!')->error();
        }
        return redirect()->route('students.index');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->studRepo->delete($id);

            DB::commit();
            flash('Student deleted successfully!')->success();
        } catch (Exception $e) {
            DB::rollback();
            flash('Student has not been deleted!')->error();
        }

        return redirect()->route('students.index');
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function getBatch(Request $request)
    {
        $yearId = $request->year_id;
        $year = $this->batchRepo->getByYearId($yearId);

        $response =  "<option value=''>Pick a batch..</option>";
        foreach($year as $yr)
        {
            $response .= "<option value=".$yr->id.">".$yr->name."</option>";
        }

        return $response;
    }


    public function getSection(Request $request)
    {
        $batchId = $request->batch_id;
        $section = $this->sectionRepo->getByBatchId($batchId);

        $response =  "<option value=''>Pick a section..</option>";
        foreach($section as $sec)
        {
            $response .= "<option value=".$sec->id.">".$sec->name."</option>";
        }

        return $response;
    }
}
