<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class worktime extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'start',
        'end'
    ];
    public function User()
    {
        return $this -> belongsTo(User::class); 
    }

    public function scopeTargetSearch($query, $user_id)
    {
        if (!empty($user_id)) {
            $query->where('user_id', $user_id);
        }
    }

}
