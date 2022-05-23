<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id',
        'name'
    ];

    public function docStatus(){
        return $this->belongsToMany(DocStatuses::class);
    }
}
