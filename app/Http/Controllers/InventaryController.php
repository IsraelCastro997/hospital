<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventary;
class InventaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        return view('inventary.index');
    }
    public function showall()
    {
        return Inventary::with('area')->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('inventary.create');
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
            $inventary=[];
            if($request->id==null){
                $inventary=new Inventary();
            }else{
                $inventary = Inventary:: findOrFail($request -> id);
            }
            $inventary->name=$request->name;
            $inventary->quantity=$request->quantity;
            $inventary->id_area=$request->id_area;
            $inventary->save();
            return ['response'=>$inventary->id];
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
        $inventary=Inventary::findOrFail($id);
        return $inventary;
    }
    public function show($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];     
        return view('inventary/detail',$params);
    }
    public function showedit($id)
    {
        //
        $detailId=$id;
        $params = [
            'detailN' => $detailId
        ];     
        return view('inventary/edit',$params);

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
                $inventary=Inventary::findOrFail($id);
                $inventary->delete();
                return 1;
            }catch(\Illuminate\Database\QueryException $e){
                return 0;
            }
            
        }
    }
}
