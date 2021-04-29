<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    use HasFactory;

    protected $fillable = ['status_code','user','massage','file','trace','trace_as_string','line','previous'];
}
