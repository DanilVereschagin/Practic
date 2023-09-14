<?php

namespace App\Model\Resource;

use App\Model\Comment;
use App\Model\Database;

class CommentResource
{
    public function getParentComments($id): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select player.username, comment.id, comment.text_of_comment, comment.date_of_writing
                from player
                left join comment on comment.username = player.id
                where comment.game = :ID and comment.id in (select discussion.parent_comment from discussion);';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $id]);
        $rowset = $query->fetchAll();

        $comments = [];
        foreach ($rowset as $row) {
            $comment = new Comment($row);
            $comments[] = $comment;
        }

        return $comments;
    }

    public function getChildComments($id): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select 
                        player.username,
                        comment.id,
                        discussion.parent_comment, 
                        comment.text_of_comment, 
                        comment.date_of_writing
                from player
                left join comment on comment.username = player.id
                left join discussion on discussion.child_comment = comment.id
                where comment.game = :ID and comment.id in (select discussion.child_comment from discussion);';
        $query = $connection->prepare($sql);
        $query->execute(['ID' => $id]);
        $rowset = $query->fetchAll();

        $comments = [];
        foreach ($rowset as $row) {
            $comment = new Comment($row);
            $comments[] = $comment;
        }

        return $comments;
    }

    public function add(array $post)
    {

    }
}