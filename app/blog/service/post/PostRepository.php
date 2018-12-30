<?php

namespace App\blog\service\post;

use Exception;
use App\Post;
use App\blog\common\entities\PostEntity;
use Illuminate\Database\QueryException;

class PostRepository implements IPost
{

    /**
     * @return mixed
     * @throws Exception
     */
    public function getAll()
    {
        try
        {
            $posts = Post::all();
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return $posts;
    }

    /**
     * @param PostEntity $postEntity
     * @return mixed
     * @throws Exception
     */
    public function create(PostEntity $postEntity)
    {
        try
        {
            $post = Post::create($postEntity->toArray());
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return $post;
    }

    /**
     * @param PostEntity $postEntity
     * @return mixed
     * @throws Exception
     */
    public function update(PostEntity $postEntity)
    {
        try
        {
            $post = Post::find($postEntity->getId())
                ->update($postEntity->toArray());
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return $post;
    }

    /**
     * @param PostEntity $postEntity
     * @return mixed
     * @throws Exception
     */
    public function delete(PostEntity $postEntity)
    {
        try
        {
            $post = Post::find($postEntity->getId())
                ->delete();
        } catch (QueryException $queryException)
        {
            throw new Exception($queryException->getMessage());
        } catch (Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }

        return $post;
    }
}