<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocRoute extends Model
{
    use HasFactory;

    public function document(){
        return $this->hasOne(Document::class);
    }

    public function division(){
        return $this->hasOne(Division::class);
    }

    public function employee(){
        return $this->hasOne(Employee::class);
    }
}
