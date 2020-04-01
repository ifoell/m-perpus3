<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

    protected $table = 'person';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'address',
        'phone',
        'description',
    ];

    public function book()
    {
        return $this->hasMany('App\Book');
    }

    public function borrow()
    {
        return $this->belongsToMany('App\Borrow');
    }

}
