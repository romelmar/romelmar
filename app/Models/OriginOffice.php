<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

class OriginOffice extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    // public function document(){
    //     return $this->belongsTo(Document::class,'origin_id');
    // }
}
