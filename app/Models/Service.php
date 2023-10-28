<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = "service";
    protected $fillable = [
        'intitule_ser',
        'description_ser',
        'tarif',
        'id_type_ser'
    ];

    public function typeService(){
        return $this->belongsToMany(TypeService::class, 'id_type_ser');
    }
}
