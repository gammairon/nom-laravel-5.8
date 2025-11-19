<?php
/**
 * User: Gamma-iron
 * Date: 29.06.2019
 */

namespace App\UseCases\Admin;


use App\Entity\Comment;

class CommentService extends Service
{

    public function create(array $data): ?Comment
    {
        $comment = new Comment($data);

        return $this->save($comment, $data);
    }

    public function update(Comment $comment, array $data): ?Comment
    {
        $comment->fill($data);

        return $this->save($comment, $data);
    }

    protected function save(Comment $comment, array $data): ?Comment
    {

        return $this->transaction(function () use ($comment, $data) {

            $comment->setStatus($data['status']);

            $comment->save();

            //Update commentable updated_at for SEO
            if($comment->status == Comment::PUBLIC_STATUS)
                $comment->commentable->touch();

            return $comment;
        });
    }

    public function deleteItems(iterable $itemIds)
    {
        return Comment::destroy($itemIds);
    }
}