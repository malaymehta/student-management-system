<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignationRequest;
use App\Interfaces\DesignationInterface;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    protected $designation;

    public function __construct(DesignationInterface $designation)
    {
        $this->designation = $designation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('designation.index');
    }

    public function getIndexPaginated()
    {
        $data_tables = $this->designation->getDesignations();
        return $data_tables->rawColumns(['actions'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('designation.manage');
    }

    /**
     * Store a newly created resource in storage.
     * @param DesignationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DesignationRequest $request)
    {
        try {
            $data             = $request->all();
            $this->designation->store($data);
            $notification = prepare_notification_array('success', config('message.designation.add-success'));
            return redirect()->route('designation.index')->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = prepare_notification_array('danger', $e->getMessage());
            return redirect()->route('designation.create')->with('notification', $notification);
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
            $designation = $this->designation->getDesignationById($id);
            return view('designation.show', compact('designation'));
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
            $designation = $this->designation->getDesignationById($id);
            return view('designation.manage', compact('designation'));
        } catch (\Exception $e) {
            $notification = prepare_notification_array('danger', $e->getMessage());
            return redirect()->back()->with('notification', $notification);
        }
    }

    public function update(DesignationRequest $request, $id)
    {
        try {
            $data = $request->except('_method', '_token');
            $this->designation->update($data, $id);
            $notification = prepare_notification_array('success', config('message.designation.update-success'));
            return redirect()->route('designation.index')->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = prepare_notification_array('danger', $e->getMessage());
            return redirect()->route('designation.edit', ['id' => $id])->with('notification', $notification);
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
            $this->designation->destroy($id);
            $notification = prepare_notification_array('success', config('message.designation.delete-success'));
        } catch (\Exception $e) {
            $notification = prepare_notification_array('danger', $e->getMessage());
        }
        return redirect()->back()->with('notification', $notification);
    }
}
