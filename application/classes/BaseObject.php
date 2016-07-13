<?php

class BaseObject implements BaseObjectInterface {
    protected static $DB;
    protected static $TABLE_NAME = '';
    protected static $FIELDS = array();

    public function __construct($id = null)
    {
        if ($id)
        {
            $this->read('id', $id);
        }
    }

    public static function getAll($cond = '')
    {
        $query_text = "SELECT * FROM `".static::$TABLE_NAME."`".$cond.";";
        $q = self::getDBConnection();
        $data = $q->query($query_text);

        return $data;
    }

    public static function getCustom($cond = '')
    {
        $query_text = $cond;
        $q = self::getDBConnection();
        $data = $q->query($query_text);

        return $data;
    }

    public function read($field, $value)
    {
        $db = self::getDBConnection();
        $query_text = " WHERE `".$field."`='".$db->realEscape($value)."' LIMIT 1;";
        $data = static::getAll($query_text);
        if ($data)
        {
            $this->setRecord($data[0]);
        } else {
            return false;
        }
    }

    public function setRecord($record)
    {
        foreach ($record as $key => $value)
        {
            if (in_array($key, static::$FIELDS))
            {
                $this->$key = $value;
            }
        }
    }

    public function save()
    {
        // daca avem id facem update, altfel insert
        if ($this->id)
        {
            $this->update();
        } else
        {
            return $this->insert();
        }
    }

   public function update()
    {
        $db = self::getDBConnection();
        $query = "UPDATE `" . static::$TABLE_NAME . "` SET ";
        foreach (static::$FIELDS as $field)
        {
            if ($field === 'id')
            {
                continue;
            }
            $query .= ' `' . $field . "` = '" . $db->realEscape($this->$field) . "',";
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE id = " . intval($this->id);
        $db->query($query);
    }

    public function remove()
    {
        $query_text = 'DELETE FROM ' . static::$TABLE_NAME . ' WHERE id = ' . $this->id;
        $q = self::getDBConnection();
        $data = $q->query($query_text);

        return $data;
    }


    public function insert()
    {
        $db = self::getDBConnection();
        $query = "INSERT INTO `" . static::$TABLE_NAME . "` SET ";
        foreach (static::$FIELDS as $field)
        {
            if ($field === 'id')
            {
                continue;
            }
            $query .= ' `' . $field . "` = '" . $db->realEscape($this->$field) . "',";
        }
        $query = substr($query,0,-1); // stergem virgula finala din query
        $db->query($query);
        $this->id = $db->insertId();
        return $db->insertId();
    }

    protected static function getDBConnection()
    {
        if(self::$DB == null)
        {
            self::$DB = new DBMySql();
            self::$DB->connect();
        }

        return self::$DB;
    }
} // END OF CLASS
