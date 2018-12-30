<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\blog\common\entities\ClientEntity;
use App\blog\service\client\ClientCommand;
use App\blog\service\client\ClientRepository;

class ClientWS extends Controller
{

    private $clientCommand;

    /**
     * ClientWS constructor.
     */
    public function __construct() {
        $this->clientCommand = new ClientCommand(new ClientRepository());
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
        