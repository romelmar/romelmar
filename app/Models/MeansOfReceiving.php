<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeansOfReceiving extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    
    public function document(){
        return $this->belongsTo(Document::class);
    }
}
