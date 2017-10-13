<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SectionPost;
use Exception;
use App\Repositories\SectionRepository;
use App\Repositories\AcademicYearRepository;
use App\Repositories\BatchRepository;
use DB;
use Yajra\Datatables\Facades\Datatables;

/**
 * Class SectionController
 *
 * @package App\Http\Controllers
 */
class SectionController extends Controller
{

    /**
     * @var \App\Repositories\SectionRepository
     */
    protected $secrepo;

    /**
     * @var \App\Repositories\AcademicYearRepository
     */
    protected $yearRepo;

    /**
     * @var \App\Repositories\BatchRepository
     */
    protected $batchRepo;


    /**
     * @param \App\Repositories\SectionRepository      $sectionRepository
     * @param \App\Repositories\AcademicYearRepository $academicYearRepository
     * @param \App\Repositories\BatchRepository        $batchRepository
     */
    public function __construct(SectionRepository $sectionRepository, AcademicYearRepository $academicYearRepository, BatchRepository $batchRepository)
    {
        $this->secrepo = $sectionRepository;
        $this->yearRepo = $academicYearRepository;
        $this->batchRepo = $batchRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('section.list');
    }

    /**
     * @return mixed
     */
    public function getIndexPaginated()
    {
        $sections    = $this->secrepo->getWithRelationsAll(['academicYear', 'batch']);
        $data_tables = Datatables::of($sections)->editColumn('options', function ($sections) {
            return "<a href='" . route('sections.edit', ['id' => $sections->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-pencil-square-o'></i></a>&nbsp;<a onClick='return confirm(`Are you sure ?`);' href='" . route('sections.show', ['id' => $sections->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-trash-o'></i></a>";
        });

        $data_tables->editColumn('academic_year', function ($sections) {
            $year = $sections->academicYear->pluck('name')->all();
            return $year[0];
        });

        $data_tables->editColumn('batch', function ($sections) {
            $batch = $sections->batch->pluck('name')->all();
            return $batch[0];
        });

        $data_tables->editColumn('status', function ($sections) {
            return ($sections->status==1) ? 'Active' : 'InActive';
        });

        return $data_tables->rawColumns(['academic_year', 'batch', 'status', 'options'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academicYearObj = $this->yearRepo->getAll();
        $academicYear = $academicYearObj->pluck('name', 'id')->all();

        $batchObj = $this->batchRepo->getAllActive();
        $batch = $batchObj->pluck('name', 'id')->all();

        return view('section.manage', compact('academicYear', 'batch'));
    }


    /**
     * @param \Illuminate\Http\Request $request
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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionPost $request)
    {
        try {
            $req = $request->only('name', 'academic_year_id', 'batch_id', 'status');
            $this->secrepo->store($req, '');
            flash('Section created successfully!')->success();

        }catch (Exception $e)
        {
            flash('Section has not been created!')->error();
        }

        return redirect()->route('sections.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = $this->secrepo->getWithRelationsById($id, ['academicYear', 'batch']);
        $academicYear = $section->academicYear->pluck('name')->all();
        $batch = $section->batch->pluck('name')->all();

        return view('section.show', compact('section', 'academicYear', 'batch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $academicYearObj = $this->yearRepo->getAll();
        $academicYear = $academicYearObj->pluck('name', 'id')->all();

        $batchObj = $this->batchRepo->getAll();
        $batch = $batchObj->pluck('name', 'id')->all();

        $section = $this->secrepo->getWithRelationsById($id, ['academicYear', 'batch']);

        $sectionAcademicYear = $section->academicYear->pluck('id')->all();
        $sectionBatch = $section->academicYear->pluck('id')->all();

        return view('section.manage', compact('academicYear', 'batch', 'section', 'sectionAcademicYear', 'sectionBatch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(SectionPost $request, $id)
    {
        try{
            $req = $request->only('name', 'academic_year_id', 'batch_id', 'status');
            $this->secrepo->store($req, $id);
            flash('Section updated successfully!')->success();

        }catch (Exception $e){
            flash('Section has not been updated')->error();
        }

        return redirect()->route('sections.index');
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
            $this->secrepo->delete($id);
            flash('Section deleted successfully!')->success();
        }catch (Exception $e){
            flash('Section not deleted!')->error();
        }

        return redirect()->route('sections.index');
    }
}
