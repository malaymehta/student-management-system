<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CourseRepository;
use App\Http\Requests\CoursePost;
use Yajra\Datatables\Facades\Datatables;
use Exception;
/**
 * Class CourseController
 *
 * @package App\Http\Controllers
 */
class CourseController extends Controller
{
    /**
     * @var
     */
    protected $courseRepo;

    /**
     * @param \App\Repositories\CourseRepository $courseRepository
     */
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepo = $courseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('course.list');
    }

    /**
     * @return mixed
     */
    public function getIndexPaginated()
    {
        $courses       = $this->courseRepo->getAll();
        $data_tables = Datatables::of($courses)->editColumn('options', function ($courses) {
            return "<a href='" . route('courses.edit', ['id' => $courses->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-pencil-square-o'></i></a>&nbsp;<a onClick='return confirm(`Are you sure ?`);' href='" . route('course_delete', ['id' => $courses->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-trash-o'></i></a>";
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
        return view('course.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoursePost $request)
    {
        try{
            $req = $request->only('name', 'alias', 'code');
            $this->courseRepo->store($req);
            flash('Course added successfully!')->success();
        }catch (Exception $e){
            flash('Course has not been added!')->error();
        }

        return redirect()->route('courses.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = $this->courseRepo->getById($id);
        return view('course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = $this->courseRepo->getById($id);
        return view('course.manage', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CoursePost $request, $id)
    {
        try{
            $req = $request->only('name', 'alias', 'code');
            $this->courseRepo->store($req, $id);
            flash('Course updated successfully!')->success();
        }catch (Exception $e){
            flash('Course has not been added!')->error();
        }

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->courseRepo->delete($id);
            flash('Course deleted successfully')->success();
        }catch (Exception $e){
            flash('Course has not been deleted!')->error();
        }

        return redirect()->route('courses.index');
    }
}
