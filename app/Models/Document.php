<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OriginOffice;
use Carbon\Carbon;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'origin_id','mor_id','doctype_id','employee_id','status_id','date_received',
        'deadline','control_number', 'subject','action_taken','required_action'
    ];

    public function origin_office()
    {
        return $this->belongsTo(OriginOffice::class, 'origin_id');
    }

    public function meansOfReceiving(){
        return $this->belongsTo(meansOfReceiving::class, 'mor_id');
    }

    public function docType()
    {
        return $this->belongsTo(docType::class, 'doctype_id');
    }

    public function employee(){
        // return $this->belongsTo(employee::class);
        return $this->belongsTo(Employee::class,"employee_id");
    }

    // public function status(){
    //     return $this->hasMany(Status::class);
    // }

    public function docRoutes(){
        return $this->hasMany(DocRoute::class);
    }

    public function images(){
        return $this->hasMany(images::class);
    }

    public function statuses(){
        return $this->hasMany(DocStatuses::class);
    }

    public function expired(){
        $today =  Carbon::now('Asia/Manila')->format('Y-m-d');
        $thisweek =  Carbon::now('Asia/Manila')->addDays(6)->format('Y-m-d');

        if( $this->deadline >= $today){
            if($this->deadline < $thisweek && $this->deadline != $today) return "success";
            else if( $this->deadline == $today) return "warning";
            else return "success";
        }
        else return "danger";
    }


    public function get_status(){
        $latestStatus_obj  =  DocStatus::select('status_id')->where('document_id',$this->id)->latest()->first();
        if($latestStatus_obj){
            $status_id  =      $latestStatus_obj->status_id;
            $latestStatus = Status::find($status_id, ['name']);
            return $latestStatus->name;
        }
        return "No Available updates";
    }


}
