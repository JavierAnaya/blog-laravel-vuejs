<?php

namespace App\blog\service\comment;

use App\blog\common\entities\CommentEntity;
use App\blog\common\utils\Response;

class CommentCommand
{
    private $commentRepository;

    /**
     * CommentCommand constructor.
     * @param IComment $IComment
     */
    public function __construct(IComment $comment)
    {
        $this->commentRepository = $comment;
    }

    /**
     * @return Response
     */
    public function getAll()
    {
        $all = $this->commentRepository->getAll();
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
     * @param CommentEntity $commentEntity
     * @return Response
     */
    public function create(CommentEntity $commentEntity)
    {
        $create = $this->commentRepository->create($commentEntity);
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
     * @param CommentEntity $commentEntity
     * @return Response
     */
    public function update(CommentEntity $commentEntity)
    {
        $update = $this->commentRepository->update($commentEntity);
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
     * @param $commenttId
     * @return Response
     */
    public function delete($commentId)
    {
        $commentEntity = new CommentEntity();
        $commentEntity->setId($commentId);
        try
        {
            $delete = $this->commentRepository->delete($commentEntity);
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