<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Repositories\ProfileRepository;
use App\Http\Requests\ProfilePost;
use ImageService;
use ActivityLog;
use Spatie\Activitylog\Models\Activity;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{

    /**
     * @var \App\Repositories\ProfileRepository
     */
    protected $profileRepo;
    /**
     * @var \Spatie\Activitylog\Models\Activity
     */
    protected $activityModel;

    /**
     * @param \App\Repositories\ProfileRepository $profileRepository
     * @param \Spatie\Activitylog\Models\Activity $activity
     */
    public function __construct(ProfileRepository $profileRepository, Activity $activity)
    {
        $this->profileRepo = $profileRepository;
        $this->activityModel = $activity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latestActivities =  $this->activityModel->with('user')->latest()->limit(100)->get();
        return view('profile.show', compact('latestActivities'));
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
    public function store(ProfilePost $request)
    {
        //
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
        return view('profile.manage');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfilePost $request, $id)
    {
        try {
            $req = $request->only('name', 'country', 'state', 'city');
            $images   = $request->image_name;
            $this->profileRepo->update($req, $images, $id);
            ActivityLog::log('Profile has been updated');
            flash('Profile updated successfully!')->success();
        } catch (Exception $e) {
            flash('Profile has not been updated!')->error();
        }

        return redirect()->route('profile.index');
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


    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function imageUpload(Request $request)
    {
        //Call imageServiceProvider to store image into upload folder
        return ImageService::imageUpload($request);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function imageDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $userID = $request->entityID;
            //Delete the record from the database Student_Image Table
            $this->profileRepo->deleteImages($userID);
            DB::commit();
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['success' => false]);
        }
    }
}
