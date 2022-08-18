<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        return view('schedules.index');
    }
    public function showall()
    {
        return Schedule::with('area','users')->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('schedules.create');
    }

    public function changeusers($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $id
        ];
        return view('schedules.users',$params);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            $schedule=[];
            if($request->id==null){
                $schedule=new Schedule();
            }else{
                $schedule = Schedule:: findOrFail($request -> id);
            }
            $schedule->name=$request->name;
            $schedule->all_schedule=$request->all_schedule;
            $schedule->id_area=$request->id_area;
            $schedule->start_date=$request->start_date;
            $schedule->end_date=$request->end_date;
            $schedule->save();
            return ['response'=>$schedule->id];
        }
        catch(\Exception $exception){
            return $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showone($id){
        $schedule=Schedule::findOrFail($id);
        return $schedule;
    }
    public function show($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];
        return view('schedules/detail',$params);
    }
    public function showedit($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];
        return view('schedules/edit',$params);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(request()->isMethod("DELETE")){
            try{
                $schedule=Schedule::findOrFail($id);
                $schedule->delete();
                return 1;
            }catch(\Illuminate\Database\QueryException $e){
                return 0;
            }

        }
    }
}
