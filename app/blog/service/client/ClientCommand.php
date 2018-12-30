<?php

namespace App\blog\service\client;

use App\blog\common\entities\ClientEntity;
use App\blog\common\utils\Response;

class ClientCommand
{
    private $clientRepository;

    /**
     * ClientCommand constructor.
     * @param IClient $IClient
     */
    public function __construct(IClient $client)
    {
        $this->clientRepository = $client;
    }

    /**
     * @return Response
     */
    public function getAll()
    {
        $all = $this->clientRepository->getAll();
        if (count($all) == 0)
        {
            return new Response(
                false,
                "empty"
            );
        }

        return new Response(
            true,
            $all
        );
    }

    /**
     * @param ClientEntity $clientEntity
     * @return Response
     */
    public function create(ClientEntity $clientEntity)
    {
        $create = $this->clientRepository->create($clientEntity);
        if (count($create) == 0)
        {
            return new Response(
                false,
                "not-create"
            );
        }

        return new Response(
            true,
            "created"
        );
    }

    /**
     * @param ClientEntity $clientEntity
     * @return Response
     */
    public function update(ClientEntity $clientEntity)
    {
        $update = $this->clientRepository->update($clientEntity);
        if (!$update)
        {
            return new Response(
                false,
                "not-update"
            );
        }

        return new Response(
            true,
            "updated"
        );
    }

    /**
     * @param $clienttId
     * @return Response
     */
    public function delete($clientId)
    {
        $clientEntity = new ClientEntity();
        $clientEntity->setId($clientId);
        try
        {
            $delete = $this->clientRepository->delete($clientEntity);
        } catch (\Exception $exception)
        {
            return new Response(
                false,
                $exception->getMessage()
            );
        }

        return new Response(
            true,
            "deleted"
        );
    }
}