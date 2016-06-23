<?php

class Comment extends BaseObject
{
    protected static $TABLE_NAME = 'comments';
    protected static $FIELDS = array(
        'id', 'article_id', 'user_id', 'comment_content', 'date_published'
    );
    public $id, $article_id, $user_id, $comment_content, $date_published;

    // reimplement the remove, so that the query removes by article_id
    public static function removeArticleComments($article_id)
    {
        $query_text = 'DELETE FROM ' . static::$TABLE_NAME . ' WHERE article_id = ' . $article_id;
        $q = self::getDBConnection();
        $data = $q->query($query_text);

        return $data;
    }
} // END OF CLASS
