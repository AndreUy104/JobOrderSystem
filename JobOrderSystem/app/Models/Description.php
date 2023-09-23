<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Description extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function customer(){
        return $this->hasMany(Customer::class , 'customer_id');
    }
}
