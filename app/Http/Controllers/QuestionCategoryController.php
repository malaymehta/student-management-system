<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionCategoryPost;
use App\Repositories\QuestionCategoryRepository;
use App\Repositories\CourseRepository;
use Exception;
use DB;
use Yajra\Datatables\Datatables;

/**
 * Class QuestionCategoryController
 *
 * @package App\Http\Controllers
 */
class QuestionCategoryController extends Controller
{
    /**
     * @var \App\Repositories\QuestionCategoryRepository
     */
    protected $questionCategoryRepo;

    /**
     * @var \App\Repositories\CourseRepository
     */
    protected $courseRepo;


    /**
     * @param \App\Repositories\QuestionCategoryRepository $questionCategoryRepository
     * @param \App\Repositories\CourseRepository           $courseRepository
     */
    public function __construct(QuestionCategoryRepository $questionCategoryRepository, CourseRepository $courseRepository)
    {
        $this->questionCategoryRepo = $questionCategoryRepository;
        $this->courseRepo           = $courseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('question_category.list');
    }


    /**
     * @return mixed
     */
    public function getIndexPaginated()
    {
        $questionCat = $this->questionCategoryRepo->getWithRelationAll(['course']);
        $data_tables = Datatables::of($questionCat);

        $data_tables->editColumn('course', function ($questionCat) {
            return $questionCat->course->name;
        });

        $data_tables->editColumn('options', function ($questionCat) {
            return "<a href='" . route('question-category.edit', ['id' => $questionCat->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-pencil-square-o'></i></a>&nbsp;<a onClick='return confirm(`Are you sure ?`);' href='" . route('questionCat_delete',
                ['id' => $questionCat->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-trash-o'></i></a>";
        });

        return $data_tables->rawColumns(['course', 'options'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courseObj = $this->courseRepo->getAll();
        $course = $courseObj->pluck('name', 'id')->all();
        return view('question_category.manage', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCategoryPost $request)
    {
        try{
            $req = $request->only('name', 'course_id', 'description');
            $this->questionCategoryRepo->store($req);
            flash('Question category added successfully!')->success();
        }catch (Exception $e){
            flash('Question category has not been added!')->error();
        }

        return redirect()->route('question-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questionCat = $this->questionCategoryRepo->getWithRelationById($id, ['course']);
        $courseObj = $this->courseRepo->getAll();
        $course = $courseObj->pluck('name', 'id')->all();
        return view('question_category.manage', compact('questionCat', 'course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionCategoryPost $request, $id)
    {
        try{
            $req = $request->only('name', 'course_id', 'description');
            $this->questionCategoryRepo->store($req, $id);
            flash('Question category updated successfully!')->success();
        }catch (Exception $e){
            flash('Question category has not been added!')->error();
        }

        return redirect()->route('question-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->questionCategoryRepo->delete($id);
            flash('Question category deleted successfully')->success();
        }catch (Exception $e){
            flash('Question category has not been deleted!')->error();
        }

        return redirect()->route('question-category.index');
    }
}
