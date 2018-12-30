<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\blog\common\entities\CommentEntity;
use App\blog\service\comment\CommentCommand;
use App\blog\service\comment\CommentRepository;

class CommentWS extends Controller
{

    private $commentCommand;

    /**
     * CommentWS constructor.
     */
    public function __construct() {
        $this->commentCommand = new CommentCommand(new CommentRepository());
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
        