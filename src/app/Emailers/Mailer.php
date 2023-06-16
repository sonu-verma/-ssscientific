<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Ali
 * Date: 21/12/17
 * Time: 6:32 AM
 */

namespace App\Emailers;


use App\AppMail;
use App\Model\Inventory\SolutionType;
use App\Model\Product\ProductCart;
use phpDocumentor\Reflection\Types\Array_;

class Mailer extends AppMail {
    /**
     * Constructor of the class and configs default settings
     * SubletMail constructor.
     * @param $data
     */
    public function __construct($data) {
        parent::__construct($data);
        $this->data = $data;
        $this->adminEmail = env('ADMIN_EMAIL_FURNITURE', 'test@inhabitr.com');
        $this->adminName = env('ADMIN_EMAIL_NAME_FURNITURE', 'Inhabitr Furniture');
        $this->environment = env('EMAIL_ENV', 'local');
        $this->testEmail = env('TEST_EMAIL', 'test@inhabitr.com');
        $this->testName = env('TEST_EMAIL_NAME', 'Inhabitr Furniture');
        //$this->adminEmail = 'ali@inhabitr.com';
    }

    /**
     * Returns layout name with path to email directory
     * @param $layout
     * @return string
     */
    protected function apiLayout($layout) {
        return 'emails.api.furniture.' . $layout;
    }

    protected function apiHubspotLayout($layout) {
        return 'emails.api.hubspot.' . $layout;
    }

}
