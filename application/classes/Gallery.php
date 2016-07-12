<?php
class Gallery extends BaseObject
{
    protected static $TABLE_NAME = 'gallery';
    protected static $FIELDS = array('id', 'name');

    public $id, $name;
}