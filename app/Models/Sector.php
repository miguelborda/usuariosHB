<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $fillable=['codigo_sector','nombre_sector','creatoruser_id',
    'updateduser_id','created_at','updated_at'];
}
