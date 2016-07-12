<?php
class UploadController extends BaseController
{
    public function index()
    {
        $this->output['templatePath'] = APP_PATH . 'templates/upload.php';
    }
}