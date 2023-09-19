<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resttime extends Model
{
    use HasFactory;
    protected $fillable = [
        'worktime_id',
        'start',
        'end'
    ];
    public function worktime()
    {
        return $this->belongsTo(worktime::class);
    }

}
