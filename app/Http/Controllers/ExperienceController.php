<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationAddRequest;
use App\Http\Requests\ExperienceRequest;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExperienceController extends Controller
{
    public function list()
    {
        $list=Experience::all();
        return view('admin.experience_list',compact('list'));

    }

    //Status
    public function changeStatus(Request $request)
    {
        $id=$request->experienceID;
        $newStatus=null;
        $findExperience=Experience::find($id);
        $status=$findExperience->status;

        if ($status)
        {
            $status=0;
            $newStatus="pasif";
        }
        else
        {
            $status=1;
            $newStatus="aktif";
        }
        $findExperience->status=$status;
        $findExperience->save();

        return response()->json([
            'newStatus'=>$newStatus,
            'experienceID'=>$id,
            'status'=>$status
        ],200);

    }
    //Active
    public function activeStatus(Request $request)
    {
        $id=$request->experienceID;
        $newStatus=null;
        $findExperience=Experience::find($id);
        $active=$findExperience->active;

        if ($active)
        {
            $active=0;
            $newActive="pasif";
        }
        else
        {
            $active=1;
            $newActive="aktif";
        }
        $findExperience->active=$active;
        $findExperience->save();

        return response()->json([
            'newActive'=>$newActive,
            'experienceID'=>$id,
            'active'=>$active
        ],200);

    }




    public function addShow(Request $request)
    {
        $id=$request->experienceID;
        $experience=null;
        if (!is_null($id))
        {
            $experience=Experience::find($id);
        }

        //Compact -> viev'e gönderme.
        return view('admin.experience_add',compact('experience'));
    }
    public function add(ExperienceRequest $request)
    {

       // DB::insert("INSERT INTO experience (task_name,company_name, description, data, status, active)  VALUES('SDADSA','SAD','DASDSADSAD','2016',0,1)");
        //dd($request->all());

        $status=0;
        $active=0;
        $order=$request->order;
        if (isset($request->status))
        {
            $status=1;
        }
        if (isset($request->active))
        {
            $active=1;
        }

        if (isset($request->experienceID))
        {
            $id=$request->experienceID;
            Experience::where('id',$id)->update([
                "task_name"=>$request->task_name,
                "company_name"=>$request->company_name,
                "description"=>$request->description,
                "data"=>$request->data,
                "order"=>$order ? $order : 999,
                "status"=>$status,
                "active"=>$active
            ]);
            alert()->success('Başarılı!', $id . "ID'sine sahip deneyim durumu güncellendi.")->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);

            return redirect()->route('admin.experience.list');
        }
        else
        {
            $data=[

                "task_name"=>$request->task_name,
                "company_name"=>$request->company_name,
                "description"=>$request->description,
                "data"=>$request->data,
                "order"=>$order ? $order : 999,
                "status"=>$status,
                "active"=>$active


            ];


            Experience::create($data);

            alert()->success('Başarılı!','Deneyim durumu kayıt edildi.')->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);

            return redirect()->route('admin.experience.list');

        }




    }


}
