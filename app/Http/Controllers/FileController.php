<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            if ($request -> hasFile('imagen')) {
                $file = new File();
                $path = Storage::putFile('public', $request->file('imagen'));
                $file->name=$request->imagen->getClientOriginalName();
                $ur = (string)$request -> imagen-> hashName();
                $file -> ulr_file=$ur;
                $file->id_diagnose=$request->diagnose;
                DB::beginTransaction();
                DB::commit();
                $file -> save();
                return $file->id;
            }
        }
        catch(\Exception $exception){
            return $exception;
        }
        return "Error";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        if(request()->isMethod("DELETE")){
            try{
                $file=File::findOrFail($id);
                if ($file -> image != null) {
                    Storage:: delete ('public/'.$file -> ulr_file);
                }
                $file->delete();
                return 1;
            }catch(\Illuminate\Database\QueryException $e){
                return 0;
            }
            
        }
    }
}
