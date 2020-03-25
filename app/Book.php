<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    //
    use SoftDeletes;
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'title_translate',
        'author',
        'editor',
        'copy_editor',
        'publisher_id',
        'isbn',
        'edition',
        'description'
    ];
    public function publisher()
    {
        return $this->belongsTo('App\publisher');
    }
}
