<?php

namespace App\blog\service\comment;

use App\blog\common\entities\CommentEntity;

interface IComment
{
    public function getAll();

    public function create(CommentEntity $commentEntity);

    public function update(CommentEntity $commentEntity);

    public function delete(CommentEntity $commentEntity);
}