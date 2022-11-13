<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusChamado extends Model
{
    use HasFactory;
    protected $fillable = ['status','font_color','background_color'];
}
