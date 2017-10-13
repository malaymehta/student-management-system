<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Exception;
use App\Http\Requests\UserPost;
use Yajra\Datatables\Datatables;
use App\Repositories\DepartmentRepository;
use App\Repositories\DesignationRepository;
use App\Repositories\UserRoleRepository;
use Event;
use App\Events\SendUserRegistrationMail;
use Carbon\Carbon;

class UserController extends Controller
{
    protected $userRepo;
    protected $departmentRepo;
    protected $designationRepo;
    protected $userRoleRepo;

    public function __construct(UserRepository $userRepository, DepartmentRepository $departmentRepository, DesignationRepository $designationRepository, UserRoleRepository $userRoleRepository)
    {
        $this->userRepo        = $userRepository;
        $this->departmentRepo  = $departmentRepository;
        $this->designationRepo = $designationRepository;
        $this->userRoleRepo    = $userRoleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.list');
    }

    public function getIndexPaginated()
    {
        $users       = $this->userRepo->getWithRelation(['userRole']);
        $data_tables = Datatables::of($users);

        $data_tables->editColumn('role', function ($users) {
            return $users->userRole->role_name;
        });

        $data_tables->editColumn('doj', function ($users) {
            return (($users->doj != '') && ($users->doj != null)) ? date('d M Y', strtotime($users->doj)) : 'NA';
        });

        $data_tables->editColumn('options', function ($users) {
            return "<a href='" . route('employees.edit', ['id' => $users->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-pencil-square-o'></i></a>&nbsp;<a href='" . route('employees.show', ['id' => $users->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-trash-o'></i></a>";
        });

        return $data_tables->rawColumns(['role', 'doj', 'options'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departmentsObj = $this->departmentRepo->getAll();
        $departments    = $departmentsObj->pluck('name', 'id')->all();

        $designationObj = $this->designationRepo->getAll();
        $designations   = $designationObj->pluck('name', 'id')->all();

        $userRoleObj = $this->userRoleRepo->getAll();
        $userRoles   = $userRoleObj->pluck('role_name', 'id')->all();

        return view('user.manage', compact('departments', 'designations', 'userRoles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPost $request)
    {
        try {
            $req = [
                'name'            => $request->name,
                'role_id'         => $request->role_id,
                'dob'             => Carbon::parse($request->dob)->format('Y-m-d'),
                'doj'             => Carbon::parse($request->doj)->format('Y-m-d'),
                'title'           => $request->title,
                'email'           => $request->email,
                'mob_no'          => $request->mob_no,
                'gender'          => $request->gender,
                'total_exp_year'  => $request->total_exp_year,
                'total_exp_month' => $request->total_exp_month,
                'department_id'   => $request->department_id,
                'designation_id'  => $request->designation_id,
                'password'        => bcrypt($request->password),
            ];

            $insertedId = $this->userRepo->store($req, '');
            //Send an email to user
            Event::fire(new SendUserRegistrationMail($insertedId));
            flash('Employee created successfully!')->success();

        } catch (Exception $e) {
            flash('Employee has not been created!')->error();
        }

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = $this->userRepo->getWithRelationId($id, ['userRole', 'department', 'designation']);

        return view('user.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = $this->userRepo->getById($id);

        $departmentsObj = $this->departmentRepo->getAll();
        $departments    = $departmentsObj->pluck('name', 'id')->all();

        $designationObj = $this->designationRepo->getAll();
        $designations   = $designationObj->pluck('name', 'id')->all();

        $userRoleObj = $this->userRoleRepo->getAll();
        $userRoles   = $userRoleObj->pluck('role_name', 'id')->all();

        return view('user.manage', compact('employee', 'departments', 'designations', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPost $request, $id)
    {
        try {
            $req = [
                'name'            => $request->name,
                'role_id'         => $request->role_id,
                'dob'             => Carbon::parse($request->dob)->format('Y-m-d'),
                'doj'             => Carbon::parse($request->doj)->format('Y-m-d'),
                'title'           => $request->title,
                'email'           => $request->email,
                'mob_no'          => $request->mob_no,
                'gender'          => $request->gender,
                'total_exp_year'  => $request->total_exp_year,
                'total_exp_month' => $request->total_exp_month,
                'department_id'   => $request->department_id,
                'designation_id'  => $request->designation_id,
                'password'        => bcrypt($request->password),
            ];

            $this->userRepo->store($req, $id);
            flash('Employee updated successfully!')->success();

        } catch (Exception $e) {
            flash('Employee has not been updated!')->error();
        }

        return redirect()->route('employees.index');
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
            $this->userRepo->delete($id);
            flash('Employee deleted successfully!')->success();

        }catch (Exception $e){
            flash('Employee has not been delete!')->error();
        }

        return redirect()->route('employees.index');
    }
}
