<?php

interface BaseObjectInterface
{
    public static function getAll($cond = '');
    public function read($field, $value);
    public function save();
}