<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersProfile extends Model
{
    protected $table = 'userProfile';

    protected $fillable =['usersId','firstName','lastName','telephone','birthday','gender','address','avatar'];

    public function usern(){
        return $this->belongsTo("App\User","usersId",);
    }
    
    const MALE = 1;
    const FEMALE = 2;
    const OTHER = 3;

}
