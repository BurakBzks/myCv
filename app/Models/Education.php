<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    //tablo ismi,keyanahtarı belirtme.
    protected $table='education';
    protected $primaryKey='id';
    //tablo ellenecek alanlar.
    //protected $fillable=[kullanılacak alanları burada belirtiyoruz];
    //tüm alanlar
    protected $guarded=[];

    //Status alanı için.
    public function scopeStatusActive($query)
    {
        return $query->where('status',1);
    }

}
