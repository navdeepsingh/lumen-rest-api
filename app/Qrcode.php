<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Qrcode extends Model
{
   //
   protected $table = 'qrcode';
   protected $fillable = ['qrcode','user_id'];
}
