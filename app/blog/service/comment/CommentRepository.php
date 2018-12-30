<?php

namespace App\blog\service\comment;

use Exception;
use App\Comment;
use App\blog\common\entities\CommentEntity;
use Illuminate\Database\QueryException;

class CommentRepository implements IComment
{

    /**
     * @return mixed
     * @throws Exception
     */
    public function getAll()
    {
        try
        {
            $comments = Comment::all();
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return $comments;
    }

    /**
     * @param CommentEntity $commentEntity
     * @return mixed
     * @throws Exception
     */
    public function create(CommentEntity $commentEntity)
    {
        try
        {
            $comment = Comment::create($commentEntity->toArray());
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return $comment;
    }

    /**
     * @param CommentEntity $commentEntity
     * @return mixed
     * @throws Exception
     */
    public function update(CommentEntity $commentEntity)
    {
        try
        {
            $comment = Comment::find($commentEntity->getId())
                ->update($commentEntity->toArray());
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return $comment;
    }

    /**
     * @param CommentEntity $commentEntity
     * @return mixed
     * @throws Exception
     */
    public function delete(CommentEntity $commentEntity)
    {
        try
        {
            $comment = Comment::find($commentEntity->getId())
                ->delete();
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return $comment;
    }
}