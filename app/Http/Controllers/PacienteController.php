<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
class PacienteController extends Controller
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
        return view('patients.index');
    }
    public function showall()
    {
        return Patient::with('diagnoses')->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('patients.create');
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
        if ($request -> deleteImage != NULL) {
            $patient = Patient:: findOrFail($request -> deleteImage);
            if ($patient -> image != null) {
                Storage:: delete ('public/'.$patient -> image);
            }
            $patient -> image=null;
            $patient -> save();
            return 1;
        }
        if ($request -> editImage != NULL) {
            if ($request -> hasFile('imagen')) {
                $patient = Patient:: findOrFail($request -> editImage);
                Storage:: delete ('public/'.$patient -> image);
                $path = Storage::putFile('public', $request->file('imagen'));
                $ur = (string)$request -> imagen -> hashName();;
                $patient -> image=$ur;
                DB::beginTransaction();
                DB::commit();
                $patient -> save();
                return 7;
            }
            return 3;
        }
        try{
            $edit=false;
            $new=[];
            if($request->id!=null){
                $edit=true;
                $new = Patient:: findOrFail($request -> id);
            }else{
                
                $new=new Patient();
            }
            $new->name=$request->name;
            $new->email=$request->email;
            $new->address=$request->address;
            $new->birth_date=$request->birth_date;
            $new->phone=$request->phone;
            $new->ns=$request->ns;
            $new->CURP=$request->CURP;
            $new->gender=$request->gender;
            $new->occupation=$request->occupation;
            $new->marita_status=$request->marita_status;
            $new->weight=$request->weight;
            $new->height=$request->height;
            $new->phone_sec=$request->phone_sec;
            $new->status=$request->status;
            if ($request -> hasFile('imagen')) {
                $path = $request -> imagen -> store('public');
                $ur = (string)$request -> imagen -> hashName();;
                $new-> image=$ur;
            }
            $new->save();
            return ['response'=>$new->id];
        }catch(\Exception $e){
            return ['response'=>$e];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showone($id){
        $patient=Patient::with("diagnoses")->findOrFail($id);
        return $patient;
    }

    public function show($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];     
        return view('patients/detail',$params);
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
    public function showedit($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];     
        return view('patients/edit',$params);

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
                $patient=Patient::findOrFail($id);
                $patient->delete();
                return 1;
            }catch(\Illuminate\Database\QueryException $e){
                return 0;
            }
            
        }
    }
}
