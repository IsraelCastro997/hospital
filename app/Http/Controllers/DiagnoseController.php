<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnose;
class DiagnoseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('diagnoses.index');
    }
    public function showall()
    {
        return Diagnose::with('patient','files')->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('diagnoses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function patient($id){
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];     
        return view('diagnoses/adding',$params);
    }

    public function store(Request $request)
    {
        //
        try{
            $diagnose=[];
            if($request->id==null){
                $diagnose=new Diagnose();
            }else{
                $diagnose = Diagnose:: findOrFail($request -> id);
            }
            $diagnose->id_patient=$request->id_patient;
            $diagnose->id_doctor=$request->id_doctor;
            $diagnose->disease=$request->disease;
            $diagnose->description=$request->description;
            $diagnose->weight=$request->weight;
            $diagnose->notes=$request->notes;
            $diagnose->drugs=$request->drugs;
            $diagnose->save();
            return ['response'=>$diagnose->id];
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
        $diagnose=Diagnose::with("patient","files")->findOrFail($id);
        return $diagnose;
    }

    public function show($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];     
        return view('diagnoses/detail',$params);
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
    public function showedit($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];     
        return view('diagnoses/edit',$params);

    }

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
                $diagnose=Diagnose::findOrFail($id);
                foreach($diagnose->files as $one){
                    if ($one -> image != null) {
                        Storage:: delete ('public/'.$file -> ulr_file);
                    }
                }
                $diagnose->files()->delete();
                $diagnose->delete();
                return 1;
            }catch(\Illuminate\Database\QueryException $e){
                return 0;
            }
            
        }
    }
}
