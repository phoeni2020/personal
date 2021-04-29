<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable =['title','url','author','review'];

    public function user(){
            return $this->hasOne(User::class,'id','author');
    }
}
