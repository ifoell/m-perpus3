<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
{
    use SoftDeletes;

    protected $table = 'borrow';
    protected $primaryKey = 'id';
    protected $fillable = [
        'book_id',
        'ownership',
        'person_id',
        'status',
        'borrow_at',
        'return_at'
    ];

    public function book()
    {
        return $this->hasMany('App\Book');
    }

    public function person()
    {
        return $this->hasMany('App\Person');
    }
}
