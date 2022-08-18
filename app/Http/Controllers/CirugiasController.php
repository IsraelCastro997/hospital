<?php

namespace App\Http\Controllers;

use App\Models\Cirugy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CirugiasController extends Controller
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
        return view('cirugy.index');
    }
    public function showall()
    {
        return Cirugy::with('patient')->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cirugy.create');
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
        return view('cirugy/adding',$params);
    }

    public function store(Request $request)
    {
        //
        try{
           // return $request;
            $Cirugy=[];
            if($request->id==null){
                $Cirugy=new Cirugy();
            }else{
                $Cirugy = Cirugy:: findOrFail($request -> id);
            }
            $Cirugy->id_patient=$request->id_patient;
            $Cirugy->id_doctor=$request->id_doctor;
            $Cirugy->type=$request->type;
            $Cirugy->dateline=$request->dateline;
            $Cirugy->comments=$request->comments;
            $Cirugy->save();
            return ['response'=>$Cirugy->id];
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
        $Cirugy=Cirugy::with("patient")->findOrFail($id);
        return $Cirugy;
    }

    public function show($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];     
        return view('cirugy/detail',$params);
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
        return view('cirugy/edit',$params);

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
                $Cirugy=Cirugy::findOrFail($id);
                
                $Cirugy->delete();
                return 1;
            }catch(\Illuminate\Database\QueryException $e){
                return 0;
            }
            
        }
    }

}
