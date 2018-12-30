<?php

namespace App\blog\service\post;

use App\blog\common\entities\PostEntity;

interface IPost
{
    public function getAll();

    public function create(PostEntity $postEntity);

    public function update(PostEntity $postEntity);

    public function delete(PostEntity $postEntity);
}