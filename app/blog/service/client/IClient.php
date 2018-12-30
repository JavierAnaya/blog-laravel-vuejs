<?php

namespace App\blog\service\client;

use App\blog\common\entities\ClientEntity;

interface IClient
{
    public function getAll();

    public function create(ClientEntity $clientEntity);

    public function update(ClientEntity $clientEntity);

    public function delete(ClientEntity $clientEntity);
}