<?php
class Upload
{
    public $file_to_upload = array();
    public $target_dir = '';
    protected $errors = array();
    protected $max_size = 20971520; // 20MB
    protected $acceptable = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');

    public function __construct($file, $path='public/uploads/') {
        $this->file_to_upload = $file;
        $this->target_dir = $path;
    }

    protected function check() {
        if (!isset($this->file_to_upload['name'])) {
            $this->errors[] = 'No file selected!';
        }
        if (($this->file_to_upload['size'] >= $this->max_size) || ($this->file_to_upload['size'] == 0)) {
            $this->errors[] = 'File to large or 0 size file selected!';
        }
        if ((!in_array($this->file_to_upload['type'], $this->acceptable)) && (!empty($this->file_to_upload['type']))) {
            $this->errors[] = 'wrong file type or no extension';
        }
        // code for file exist error toadd here to prevent overwrite
        return $this->errors;
    }

    public function move() {
        $this->errors = $this->check();
        if (count($this->errors) === 0) {
            echo $this->target_dir.basename($this->file_to_upload['name']);
            if (!move_uploaded_file($this->file_to_upload['tmp_name'], $this->target_dir.basename($this->file_to_upload['name']))) {
                echo error_get_last();
                return false;
            } else {
                return $this->target_dir.$this->file_to_upload['name'];;
            }
        } else {
            foreach ($this->errors as $error) {
                echo $error.'<br />';
            }
            die();
            return false;
        }
    }
}