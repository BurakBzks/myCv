<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    //tablo ismi,keyanahtarı belirtme.
    protected $table='experience';
    protected $primaryKey='id';
    //tablo ellenecek alanlar.
    //protected $fillable=[kullanılacak alanları burada belirtiyoruz];
    //tüm alanlar
    protected $guarded=[];



}
