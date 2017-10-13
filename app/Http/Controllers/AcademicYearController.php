<?php

namespace App\Http\Controllers;

use App\Repositories\AcademicYearRepository;
use App\Http\Requests\AcademicYearPost;
use Yajra\Datatables\Datatables;
use Exception;
use Carbon\Carbon;

/**
 * Class AcademicYearController
 *
 * @package App\Http\Controllers
 */
class AcademicYearController extends Controller
{

    /**
     * @var \App\Repositories\AcademicYearRepository
     */
    protected $academicYearRepo;

    /**
     * @param \App\Repositories\AcademicYearRepository $academicYearRepo
     */
    public function __construct(AcademicYearRepository $academicYearRepo)
    {
        $this->academicYearRepo = $academicYearRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('academic_year.list');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getIndexPaginated()
    {
        $years       = $this->academicYearRepo->getAll();
        $data_tables = Datatables::of($years)->editColumn('options', function ($years) {
            return "<a href='" . route('academic-year.edit', ['id' => $years->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-pencil-square-o'></i></a>&nbsp;<a onClick='return confirm(`Are you sure ?`);' href='" . route('academicYear_delete', ['id' => $years->id]) . "' class='btn btn-default btn-sm delete_btn' ><i class='fa fa-trash-o'></i></a>";
        });
        $data_tables->editColumn('status', function ($years) {
            return ($years->status==1) ? 'Active' : 'InActive';
        });
        $data_tables->editColumn('start_date', function ($years) {
            return date('d-m-Y', strtotime($years->start_date));
        });
        $data_tables->editColumn('end_date', function ($years) {
            return date('d-m-Y', strtotime($years->end_date));
        });

        return $data_tables->rawColumns(['start_date', 'end_date', 'status', 'options'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic_year.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicYearPost $request)
    {
        try {
            $req = [
                'name'       => $request->name,
                'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                'end_date'   => Carbon::parse($request->end_date)->format('Y-m-d'),
                'status'     => $request->status
            ];
            $this->academicYearRepo->store($req);
            flash('Academic year created successfully!')->success();
        } catch (Exception $e) {
            flash('Academic year has not been created!')->error();
        }
        return redirect()->route('academic-year.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $year = $this->academicYearRepo->getById($id);
        return view('academic_year.show', compact('year'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $year = $this->academicYearRepo->getById($id);
        return view('academic_year.manage', compact('year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(AcademicYearPost $request, $id)
    {
        try {
            $req = [
                'name'       => $request->name,
                'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                'end_date'   => Carbon::parse($request->end_date)->format('Y-m-d'),
                'status'     => $request->status
            ];
            $this->academicYearRepo->store($req, $id);
            flash('Academic year updated successfully!')->success();
        } catch (Exception $e) {
            flash('Academic year has not been updated!')->error();
        }
        return redirect()->route('academic-year.index');
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
            $this->academicYearRepo->delete($id);
            flash('Academic year deleted successfully!')->success();
        } catch (Exception $e) {
            flash('Academic year has not been deleted!')->error();
        }
        return redirect()->route('academic-year.index');
    }
}
