<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShiftPost;
use Exception;
use Yajra\Datatables\Datatables;
use App\Repositories\ShiftRepository;
use Carbon\Carbon;
/**
 * Class ShiftController
 *
 * @package App\Http\Controllers
 */
class ShiftController extends Controller
{
    /**
     * @var \App\Repositories\ShiftRepository
     */
    protected $shiftRepo;

    /**
     * @param \App\Repositories\ShiftRepository $shiftRepository
     */
    public function __construct(ShiftRepository $shiftRepository)
    {
        $this->shiftRepo = $shiftRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shift.list');
    }


    /**
     * @return mixed
     * @throws \Exception
     */
    public function getIndexPaginated()
    {
        $shifts      = $this->shiftRepo->getAll();
        $data_tables = Datatables::of($shifts);

        $data_tables->editColumn('start_time', function ($shifts) {
            return date('h:i A', strtotime($shifts->start_time));
        });

        $data_tables->editColumn('end_time', function ($shifts) {
            return date('h:i A', strtotime($shifts->end_time));
        });

        $data_tables->editColumn('options', function ($shifts) {
            return "<a href='" . route('shifts.edit', ['id' => $shifts->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-pencil-square-o'></i></a>&nbsp;<a href='" . route('shift_delete', ['id' => $shifts->id]) . "' class='btn btn-default btn-sm'><i class='fa fa-trash-o'></i></a>";
        });

        return $data_tables->rawColumns(['start_time', 'end_time', 'options'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shift.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShiftPost $request)
    {
        try {
            $req = [
                'name' => $request->name,
                'start_time' => Carbon::parse($request->start_time)->format('H:i:s'),
                'end_time' => Carbon::parse($request->end_time)->format('H:i:s')
            ];

            $this->shiftRepo->store($req, '');
            flash('Shift created successfully!')->success();
        } catch (Exceptio $e) {
            flash('Shift has not been created!')->error();
        }

        return redirect()->route('shifts.index');
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
        $shift = $this->shiftRepo->getById($id);
        return view('shift.manage', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShiftPost $request, $id)
    {
        try{
            $req = [
                'name' => $request->name,
                'start_time' => Carbon::parse($request->start_time)->format('H:i:s'),
                'end_time' => Carbon::parse($request->end_time)->format('H:i:s')
            ];

            $this->shiftRepo->store($req, $id);
            flash('Shifts updated sucessfully!')->success();
        }catch (Exception $e){
            flash('Shifts has not been updated!')->error();
        }

        return redirect()->route('shifts.index');
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
            $this->shiftRepo->delete($id);
            flash('Shift deleted successfully!')->success();
        }catch (Exception $e){
            flash('Shift has not been deleted!')->error();
        }

        return redirect()->route('shifts.index');
    }
}
