<?php

namespace App\Model\Resource;

use App\Model\Comment;
use App\Model\Database;

class CommentResource extends AbstractResource
{
    public function getParentComments($id): array
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = 'select player.username, comment.id, comment.text_of_comment, comment.date_of_writing
                from player
                left join comment on comment.username = player.id
                where comment.game = :ID and comment.id not in (select discussion.child_comment from discussion);';
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
        $db = new Database();
        $connection = $db->getConnection();
        $sql = "insert into comment
                    set `game` = :game,
                    `text_of_comment` = :text_of_comment,
                    `date_of_writing` = :date_of_writing,
                    `username` = :username
                    ";
        try {
            $query = $connection->prepare($sql);
        } catch (\Exception $exception) {
            $exception->getMessage();
        }

        $this->prepareDataOfComment($query, $post);
        $query->execute();
    }

    protected function prepareDataOfComment(\PDOStatement $query, array $post)
    {
        $query->bindValue('game', $post['game'], \PDO::PARAM_INT);
        $query->bindValue('text_of_comment', $post['text_of_comment'], \PDO::PARAM_STR);
        $query->bindValue('date_of_writing', $post['date_of_writing'], \PDO::PARAM_STR);
        $query->bindValue('username', $post['username'], \PDO::PARAM_INT);
    }
}