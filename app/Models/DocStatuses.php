<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocStatuses extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id',
        'status_id'
    ];

    public function document(){
        return $this->belongsTo(Document::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function latest(){
        return $this->belongsTo(Status::class);
    }

}
