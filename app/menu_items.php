<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu_items extends Model
{
    protected $table="admin_menu_items";

    protected $fillable=['label','link','role_id','parent','sort','class','menu','depth'];
}
