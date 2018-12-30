<?php

namespace App\blog\service\client;

use Exception;
use App\Client;
use App\blog\common\entities\ClientEntity;
use Illuminate\Database\QueryException;

class ClientRepository implements IClient
{

    /**
     * @return mixed
     * @throws Exception
     */
    public function getAll()
    {
        try
        {
            $clients = Client::all();
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return $clients;
    }

    /**
     * @param ClientEntity $clientEntity
     * @return mixed
     * @throws Exception
     */
    public function create(ClientEntity $clientEntity)
    {
        try
        {
            $client = Client::create($clientEntity->toArray());
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return $client;
    }

    /**
     * @param ClientEntity $clientEntity
     * @return mixed
     * @throws Exception
     */
    public function update(ClientEntity $clientEntity)
    {
        try
        {
            $client = Client::find($clientEntity->getId())
                ->update($clientEntity->toArray());
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return $client;
    }

    /**
     * @param ClientEntity $clientEntity
     * @return mixed
     * @throws Exception
     */
    public function delete(ClientEntity $clientEntity)
    {
        try
        {
            $client = Client::find($clientEntity->getId())
                ->delete();
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return $client;
    }
}