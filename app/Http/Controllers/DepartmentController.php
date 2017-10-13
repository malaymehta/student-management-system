<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Interfaces\DepartmentInterface;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    protected $department;

    public function __construct(DepartmentInterface $department)
    {
        $this->department = $department;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('department.index');
    }

    public function getIndexPaginated()
    {
        $data_tables = $this->department->getDepartments();
        return $data_tables->rawColumns(['actions'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.manage');
    }

    /**
     * Store a newly created resource in storage.
     * @param DepartmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DepartmentRequest $request)
    {
        try {
            $data             = $request->all();
            $this->department->store($data);
            $notification = prepare_notification_array('success', config('message.department.add-success'));
            return redirect()->route('department.index')->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = prepare_notification_array('danger', $e->getMessage());
            return redirect()->route('department.create')->with('notification', $notification);
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
        try {
            $department = $this->department->getDepartmentById($id);
            return view('department.show', compact('department'));
        } catch (\Exception $e) {
            $notification = prepare_notification_array('danger', $e->getMessage());
            return redirect()->back()->with('notification', $notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $department = $this->department->getDepartmentById($id);
            return view('department.manage', compact('department'));
        } catch (\Exception $e) {
            $notification = prepare_notification_array('danger', $e->getMessage());
            return redirect()->back()->with('notification', $notification);
        }
    }

    public function update(DepartmentRequest $request, $id)
    {
        try {
            $data = $request->except('_method', '_token');
            $this->department->update($data, $id);
            $notification = prepare_notification_array('success', config('message.department.update-success'));
            return redirect()->route('department.index')->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = prepare_notification_array('danger', $e->getMessage());
            return redirect()->route('department.edit', ['id' => $id])->with('notification', $notification);
        }
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
            $this->department->destroy($id);
            $notification = prepare_notification_array('success', config('message.department.delete-success'));
        } catch (\Exception $e) {
            $notification = prepare_notification_array('danger', $e->getMessage());
        }
        return redirect()->back()->with('notification', $notification);
    }
}
