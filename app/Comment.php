<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'code', ,'client_id','post_id',];

    protected $table = 'comments';


}