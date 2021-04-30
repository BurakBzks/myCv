<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationAddRequest;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function educationList()
    {
        //eklenmiş olanların hepsini listeye gönderme işlemi yapıldı.
        $list=Education::all();
        return view('admin.education_list',compact('list'));
    }
    public function changeStatus(Request $request)
    {
        $id=$request->educationID;
        $newStatus=null;
        $findEducation=Education::find($id);
        $status=$findEducation->status;

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
        $findEducation->status=$status;
        $findEducation->save();

        return response()->json([
           'newStatus'=>$newStatus,
           'educationID'=>$id,
            'status'=>$status
        ],200);

    }
    public function addShow(Request $request)
    {
        $id=$request->educationID;
        $education=null;
        if (!is_null($id))
        {
            $education=Education::find($id);
        }

        //Compact -> viev'e gönderme.
        return view('admin.education_add',compact('education'));
    }
    public function add(EducationAddRequest $request)
    {

        $status=0;
        //order requestten alıp direk aşağıda kullanamayız çünkü boş bırakılamaz yaptık hata alırız . bu şekilde yapıp tek satırda if kullanıcaz.
        $order=$request->order;
        if (isset($request->status))
        {
            $status=1;
        }

        if (isset($request->educationID))
        {
            $id=$request->educationID;
           Education::where('id',$id)->update([
                "university_date"=>$request->university_date,
                "university_name"=>$request->university_name,
                "university_branch"=>$request->university_branch,
                "description"=>$request->description,
                "order"=>$order ? $order : 999,
                "status"=>$status
            ]);
            alert()->success('Başarılı!', $id . "ID'sine sahip eğitim durumu güncellendi.")->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);

            return redirect()->route('admin.education.list');
        }
        else
        {
            $data=[
                "university_date"=>$request->university_date,
                "university_name"=>$request->university_name,
                "university_branch"=>$request->university_branch,
                "description"=>$request->description,
                "order"=>$order ? $order : 999,
                "status"=>$status
            ];
            Education::create($data);

            alert()->success('Başarılı!','Eğitim durumu kayıt edildi.')->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);

            return redirect()->route('admin.education.list');
        }


    }
    public function delete(Request $request)
    {
        $id=$request->educationID;
        Education::where('id',$id)->delete();
        //eğer silme işlemi başarılıysa status 200 dönüyor(başarılı demek)
        return response()->json([],200);
    }
}
