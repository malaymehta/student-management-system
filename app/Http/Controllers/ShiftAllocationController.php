<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ShiftAllocationRepository;
use App\Repositories\UserRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\DesignationRepository;
use App\Repositories\ShiftRepository;
use Exception;
use App\Http\Requests\ShiftAllocationPost;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;
/**
 * Class ShiftAllocationController
 *
 * @package App\Http\Controllers
 */
class ShiftAllocationController extends Controller
{

    /**
     * @var \App\Repositories\ShiftAllocationRepository
     */
    protected $shiftAllocationRepo;
    /**
     * @var \App\Repositories\UserRepository
     */
    protected $userRepo;
    /**
     * @var \App\Repositories\DepartmentRepository
     */
    protected $departmentRepo;
    /**
     * @var \App\Repositories\DesignationRepository
     */
    protected $designationRepo;

    /**
     * @var \App\Repositories\ShiftRepository
     */
    protected $shiftRepo;


    /**
     * @param \App\Repositories\ShiftAllocationRepository $shiftAllocationRepository
     * @param \App\Repositories\UserRepository            $userRepository
     * @param \App\Repositories\DepartmentRepository      $departmentRepository
     * @param \App\Repositories\DesignationRepository     $designationRepository
     * @param \App\Repositories\ShiftRepository           $shiftRepository
     */
    public function __construct(ShiftAllocationRepository $shiftAllocationRepository, UserRepository $userRepository, DepartmentRepository $departmentRepository, DesignationRepository $designationRepository, ShiftRepository $shiftRepository)
    {
        $this->shiftAllocationRepo = $shiftAllocationRepository;
        $this->userRepo            = $userRepository;
        $this->departmentRepo      = $departmentRepository;
        $this->designationRepo     = $designationRepository;
        $this->shiftRepo           = $shiftRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $department  = $request->department;
        $designation = $request->designation;
        $name        = $request->name;

        $departmentsObj = $this->departmentRepo->getAll();
        $departments    = $departmentsObj->pluck('name', 'id')->all();

        $designationsObj = $this->designationRepo->getAll();
        $designations    = $designationsObj->pluck('name', 'id')->all();

        $shiftsObj = $this->shiftRepo->getAll();
        $shifts    = $shiftsObj->pluck('name', 'id')->all();

        return view('shift_allocation.list', compact('departments', 'designations', 'shifts', 'department', 'designation', 'name'));
    }


    /**
     * @return mixed
     */
    public function getIndexPaginated()
    {
        $departmentId = Input::get('departmentId');
        $designationId = Input::get('designationId');
        $empName = Input::get('empName');

        if (isset($departmentId) || isset($designationId) || isset($empName)) {
            $employees = $this->userRepo->searchEmp($departmentId, $designationId, $empName, ['department', 'designation', 'shiftAllocation']);
        }else{
            $employees = $this->userRepo->getWithRelation(['department', 'designation', 'shiftAllocation']);
        }

        $data_tables = Datatables::of($employees);

        $data_tables->editColumn('checkbox', function ($employees) {
            return "<input type='checkbox' name='emp_check[]' value = '" . $employees->id . "' class='emp_check'>";
        });

        $data_tables->editColumn('name', function ($employees) {
            return $employees->name;
        });

        $data_tables->editColumn('department', function ($employees) {
            return $employees->department->name;

        });

        $data_tables->editColumn('designation', function ($employees) {
            return $employees->designation->name;

        });

        $data_tables->editColumn('shift', function ($employees) {
            if (isset($employees->shiftAllocation)) {
                return $employees->shiftAllocation->shift->name . " (" . date('h:i A', strtotime($employees->shiftAllocation->shift->start_time)) . " - " . date('h:i A', strtotime($employees->shiftAllocation->shift->end_time)) . ")";
            } else {
                return "NA";
            }
        });

        return $data_tables->rawColumns(['checkbox', 'name', 'department', 'designation', 'shift'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShiftAllocationPost $request)
    {
        DB::beginTransaction();
        try {
            $shiftId       = $request->shift_id;
            $effectiveDate = Carbon::parse($request->effective_date)->format('Y-m-d');
            $employeeIds   = $request->emp_check;
            $this->shiftAllocationRepo->store($shiftId, $effectiveDate, $employeeIds);
            DB::commit();
            flash('Shift allocated successfully!')->success();
            return redirect()->route('shift-allocations.index');

        } catch (Exception $e) {
            DB::rollback();
            flash('Something went wrong!')->error();
            return redirect()->route('shift-allocations.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShiftAllocationPost $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
