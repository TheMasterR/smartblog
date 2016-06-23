<?php

class Article extends BaseObject
{
    protected static $TABLE_NAME = 'articles';
    protected static $FIELDS = array(
        'id', 'user_id', 'title', 'content', 'media', 'date_published', 'date_created', 'status'
    );

    public $id,$user_id, $title, $content, $media = "",$date_published = NULL, $date_created, $status = 'draft';

    public function savePicture()
    {
        $uploadImage = 'public/uploads/' . $this->id;
        if (move_uploaded_file($_FILES['image-upload']['tmp_name'], $uploadImage))
        {
            return true;
        }
        return false;
    }

    public function deletePicture()
    {
        $uploadImage = 'public/uploads/' . $this->id;
        if(file_exists($uploadImage))
        {
            if(unlink($uploadImage))
            {
                return true;
            }
            return false;
        }
        return false;
    }

    public static function removeArticleComments($article_id)
    {
        $query_text = 'DELETE FROM ' . static::$TABLE_NAME . ' WHERE article_id = ' . $article_id;
        $q = self::getDBConnection();
        $data = $q->query($query_text);

        return $data;
    }

    public function isPublished()
    {
        return $this->status === 'published';
    }
} // END OF CLASS
