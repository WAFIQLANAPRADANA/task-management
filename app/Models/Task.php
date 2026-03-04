<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
protected $fillable = [
    'title',
    'description',
    'tanggal_mulai',
    'tanggal_selesai',
    'status'
];

protected $casts = [
    'tanggal_mulai' => 'date',
    'tanggal_selesai' => 'date'
];
}
