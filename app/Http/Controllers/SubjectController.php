<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use Exception;
use App\Repositories\SubjectRepository;
use App\Http\Requests\SubjectPost;

/**
 * Class SubjectController
 *
 * @package App\Http\Controllers
 */
class SubjectController extends Controller
{
    /**
     * @var
     */
    protected $subRepo;

    /**
     * @param \App\Repositories\SubjectRepository $subjectRepository
     */
    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subRepo = $subjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('subject.list');
    }


    /**
     * @return mixed
     */
    public function getIndexPaginated()
    {
        $subjects       = $this->subRepo->getAll();
        $data_tables = Datatables::of($subjects)->editColumn('options', function ($subjects) {
            return "<a href='" . route('subjects.edit', ['id' => $subjects->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-pencil-square-o'></i></a>&nbsp;<a onClick='return confirm(`Are you sure ?`);' href='" . route('subjects.show', ['id' => $subjects->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-trash-o'></i></a>";
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
        return view('subject.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectPost $request)
    {
        try{
            $req = $request->only('name', 'alias', 'code');
            $this->subRepo->store($req);
            flash('Subject added successfully!')->success();
        }catch (Exception $e){
            flash('Subject has not been added!')->error();
        }

        return redirect()->route('subjects.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $subject = $this->subRepo->getById($id);
        return view('subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = $this->subRepo->getById($id);
        return view('subject.manage', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectPost $request, $id)
    {
        try{
            $req = $request->only('name', 'alias', 'code');
            $this->subRepo->store($req, $id);
            flash('Subject updated successfully!')->success();
        }catch (Exception $e){
            flash('Subject has not been added!')->error();
        }

        return redirect()->route('subjects.index');
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
            $this->subRepo->delete($id);
            flash('Subject deleted successfully')->success();
        }catch (Exception $e){
            flash('Subject has not been deleted!')->error();
        }

        return redirect()->route('subjects.index');
    }
}
