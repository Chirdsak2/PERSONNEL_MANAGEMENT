<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function getPrefixName ($prefix_id) : string {
        $users = Prefix::select('prefix_name_th')
            ->where('id','=',$prefix_id)
            ->first();

        return $users->prefix_name_th;

    }
    
}
