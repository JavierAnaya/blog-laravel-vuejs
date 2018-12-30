<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\blog\common\entities\PostEntity;
use App\blog\service\post\PostCommand;
use App\blog\service\post\PostRepository;

class PostWS extends Controller
{

    private $postCommand;

    /**
     * PostWS constructor.
     */
    public function __construct() {
        $this->postCommand = new PostCommand(new PostRepository());
    }

    public function getAll()
    {

    }

    public function create(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function delete($id)
    {

    }

}
        