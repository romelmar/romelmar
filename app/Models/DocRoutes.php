<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocRoutes extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_received',
        // 'status_id'
    ];


    public function document(){
        return $this->belongsTo(Document::class, 'doc_id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function division(){
        return $this->belongsTo(Division::class);
    }
}
