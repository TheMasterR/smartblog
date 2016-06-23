<?php

/**
 * undocumented class
 *
 * @package default
 * @author `g:snips_author`
 */
interface DBMySqlInterface
{
    public function connect();
    public function query($query_text);
}