<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'pass_mark',
    ];


    public function users(){
        return $this->belongsToMany(User::class)->withPivot('mark_obtained')->withPivot('id');
    }
}
