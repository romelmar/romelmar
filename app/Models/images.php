<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'image_path'
    ];

    public function document(){
        return $this->belongsTo(Document::class);
    }
}
