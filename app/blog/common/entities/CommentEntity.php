<?php

namespace App\blog\common\entities;

class CommentEntity
{
    
    private $description;
    private $code;
    private $client_id;
    private $post_id;


    /**
     * @return Array
     */
    public function toArray()
    {
        $array = [
            'description' => $this->description,
            'code' => $this->code,
            'client_id' => $this->client_id,
            'post_id' => $this->post_id
        ];

        return array_filter($array);
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @param mixed $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param mixed $code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param mixed $client_id
     *
     * @return self
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;

        return $this;
    }

    /**
     * @param mixed $post_id
     *
     * @return self
     */
    public function setPostId($post_id)
    {
        $this->post_id = $post_id;

        return $this;
    }
}