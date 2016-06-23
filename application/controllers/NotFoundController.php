<?php

class NotFoundController extends BaseController
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->params['templatePath'] = APP_PATH . 'templates/components/not-found.php';
        $this->params['pageNotFound'] = true;
    }
} // END OF CLASS
