<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function customer(){
        return $this->belongsTo(Customer::class , 'customer_id');
    }

    public function user(){
        return $this->belongsTo(User::class , 'created_by');
    }

    public function scopeFilter($query , array $dates){
        if (isset($dates['from']) && isset($dates['to'])) {
            $query->whereBetween('created_at', [$dates['from'], $dates['to']]);
        }
    }
}
