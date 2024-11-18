<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Task extends Model
{
    //
    use HasFactory , HasApiTokens;

    protected $fillable = ['title' , 'description' , 'status' , 'user_id' , 'due_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}