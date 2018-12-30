<?php

namespace App\blog\service\post;

use App\blog\common\entities\PostEntity;
use App\blog\common\utils\Response;

class PostCommand
{
    private $postRepository;

    /**
     * PostCommand constructor.
     * @param IPost $IPost
     */
    public function __construct(IPost $post)
    {
        $this->postRepository = $post;
    }

    /**
     * @return Response
     */
    public function getAll()
    {
        $all = $this->postRepository->getAll();
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
     * @param PostEntity $postEntity
     * @return Response
     */
    public function create(PostEntity $postEntity)
    {
        $create = $this->postRepository->create($postEntity);
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
     * @param PostEntity $postEntity
     * @return Response
     */
    public function update(PostEntity $postEntity)
    {
        $update = $this->postRepository->update($postEntity);
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
     * @param $posttId
     * @return Response
     */
    public function delete($postId)
    {
        $postEntity = new PostEntity();
        $postEntity->setId($postId);
        try
        {
            $delete = $this->postRepository->delete($postEntity);
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