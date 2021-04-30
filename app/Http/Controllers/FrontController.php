<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $experienceList=Experience::query()->where('status',1)
            ->select('task_name','company_name','description','data')->orderBy('order','ASC')->get();

        //query=kodumuz daha anlamlı olur,
        //Where kullanma amacımız status alanı 1 olanları göstermek için.
        //select kullanma amacımız veri tabanından hepsini çekip şişirmeye gerek yok lazım olanları çekiyoruz.
        //statusActive()=laravel scope where koşulusu her defasında status olarak yazmamak için modelde oluiturup her yerde çağıra biliyoruz.
        $educationList=Education::query()->statusActive()
            ->select('university_date','university_name','university_branch','description')->orderBy('order','ASC')->get();
        //dd($educationList);

        //,['educationList'=>$educationList] diğer kullanımı
        //compact kullanımında birden fazla gönderme yapabiliyoruz
        return view('pages.index',compact('educationList','experienceList'));
    }
    public function blog()
    {
        return view('pages.blog');
    }
    public function resume()
    {
        return view('pages.resume');
    }
    public function contact()
    {
        return view('pages.contact');
    }
    public function portfolio()
    {
        return view('pages.portfolio');
    }

}
