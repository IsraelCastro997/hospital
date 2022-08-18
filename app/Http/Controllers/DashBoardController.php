<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\User;
use App\Models\Cirugy;
use App\Models\Diagnose;
use App\Models\Schedule;
use App\Models\File;
use App\Models\Inventary;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use Carbon\Carbon;
use PDF;
class DashBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard/index');
    }
    public function print(){
        $params=$this->showall();
        view()->share('all',$params);
        //view()->share('assigned_schedules/edit',$params);
         $pdf = PDF::loadView('dashboard/print', $params);

         // download PDF file with download method
         return $pdf->download('reporte.pdf');
    
    }
    public function showall()
    {
        $numberdate=[];
        $record=Cirugy::all();
        
        for($x=0;$x<=7;$x++){
            $record=Cirugy::all();
            $contdate=0;
            $past=Carbon::today()->subDays(7-$x);
            foreach($record as $element){
                $date=new \DateTime($element->dateline);
                $comp=Carbon::instance($date);
                if($comp->day==$past->day && $comp->month==$past->month && $comp->year==$past->year){
                    $contdate+=1;
                }
            }
            array_push($numberdate,['date'=>$past,'num'=>$contdate]);  
        }
        $obj=new \stdClass();
        $information=Area::all();
        $obj->area=count($information);
        $value=[];
        $assign=Patient::with("diagnoses")->get();
        $patientsall=Patient::all();
        $paatientd=[];
        $help=1;
        $array = array(0 => 'azul');
               
        foreach($patientsall as $element){
            $key = array_search($element->status, $array); // $clave = 2;
               
           if($key==false && $element->status!=null){
                $paatientd[$element->status]=1;
                array_push($array,$element->status);
           }else if($element->status!=null){
                $help= $paatientd[$element->status]+1;
                $paatientd[$element->status]=$help;
           }
           
        }
        $datestatus=[];
        $datestatus["0-12"]=0;
        $datestatus["13-25"]=0;
        $datestatus["26-50"]=0;
        $datestatus["51-70"]=0;
        $datestatus[">70"]=0;
        foreach($patientsall as $element){
            $date=new \DateTime($element->birth_date);
            $now=Carbon::now();
            $carbon=Carbon::instance($date);
            $diff = $now->diffInYears($date);
            if($diff<12){
                $datestatus["0-12"]=$datestatus["0-12"]+1;
            }
            else if($diff>12 &&$diff<=25){
                $datestatus["13-25"]=$datestatus["13-25"]+1;
            }else if($diff>25 &&$diff<=50){
                $datestatus["26-50"]=$datestatus["26-50"]+1;
            }else if($diff>50 &&$diff<=70){
                $datestatus["51-70"]=$datestatus["51-70"]+1;
            }else if($diff>70){
                $datestatus[">70"]=$datestatus[">70"]+1;
            }
            
        }
        $weightstatus=[];
        $weightstatus["<17"]=0;
        $weightstatus["17-19"]=0;
        $weightstatus["20-25"]=0;
        $weightstatus["26-40"]=0;
        $weightstatus[">40"]=0;
        foreach($patientsall as $element){
            if($element->weight!=null && $element->height!=null&& $element->height!=0){
                $element->height=$element->height/100.0;
            $diff = ($element->weight)/($element->height*$element->height);
            if($diff<17){
                $weightstatus["<17"]=$weightstatus["<17"]+1;
            }
            else if($diff>17 &&$diff<=19){
                $weightstatus["17-19"]=$weightstatus["17-19"]+1;
            }else if($diff>19 &&$diff<=25){
                $weightstatus["20-25"]=$weightstatus["20-25"]+1;
            }else if($diff>25 &&$diff<=40){
                $weightstatus["26-40"]=$weightstatus["26-40"]+1;
            }else if($diff>40){
                $weightstatus[">40"]=$weightstatus[">40"]+1;
            }
        }
        }
        
        $obj->patient=count($assign);
        $schedule=Cirugy::all();
        $obj->cirugy=count($schedule);
        $disci=[];
        $users= User::with('roles')->get();
        $userinfo=[];
        $help=1;
        $array = array(0 => 'azul');
        foreach($users as $element){
            if(sizeof($element->roles)>0){
                $key = array_search($element->roles[0]->name, $array); 
                if($key==false && $element->roles[0]!=null){
                        $userinfo[$element->roles[0]->name]=1;
                        array_push($array,$element->roles[0]->name);
                }else if($element->roles[0]!=null){
                        $help= $userinfo[$element->roles[0]->name]+1;
                        $userinfo[$element->roles[0]->name]=$help;
                }
            }
        }
        
        $obj->diagnoses=count(Diagnose::all());
        $obj->schedule=count(Schedule::all());
        $obj->user=count(User::all());
        $schedule=Schedule::with('area','users')->get();
        $inventary=Inventary::with('area')->get();
        $data = ['all'=>$obj,'register'=>$numberdate,'patient'=> $paatientd,'date'=>$datestatus,'weight'=>$weightstatus,'users'=>$userinfo,'schedule'=>$schedule,'inventary'=>$inventary,'username'=>Auth::user()->name,'dates'=>Carbon::now()];
        
        return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
       
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\UsersCdu  $usersCdu
     * @return \Illuminate\Http\Response
     */
    public function show(int $id,Request $request) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsersCdu  $usersCdu
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersCdu $usersCdu, $id) {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UsersCdu  $usersCdu
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsersCdu  $usersCdu
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id) {
        
    }
}
