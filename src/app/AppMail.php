<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Ali
 * Date: 24/10/17
 * Time: 9:57 PM
 */

namespace App;


use App\Model\SubletUser;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AppMail extends Mail {
    protected $adminEmail = null;
    protected $adminName = null;
    public $environment = null;
    protected $data = null;
    protected $adminParams = [];
    protected $adminLayout = null;
    protected $adminSubject = null;
    protected $testEmail = null;
    protected $testName = null;

    /**
     * Constructor of the class and configs default settings
     * SubletMail constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->data = $data;
        $this->adminEmail = env('ADMIN_EMAIL', 'stagingadmin@chicagostaging.com');
        $this->adminName = env('ADMIN_EMAIL_NAME', 'Inhabitr');
        $this->environment = env('EMAIL_ENV', 'test');
        $this->testEmail = env('TEST_EMAIL', 'test@inhabitr.com');
        $this->testName = env('TEST_EMAIL_NAME', 'Inhabitr Test');
        //$this->adminEmail = 'ali@inhabitr.com';
    }

    /**
     * Send a test email
     * @param $email
     */
    public function testMail($email) {
        $customerData = new \stdClass();
        $customerData->to = $email;
        $customerData->toName = 'Email Test';
        $customerData->layout = 'emails.test';
        $customerData->data = $this->data;
        $customerData->subject = 'Test Email';
        $this->trigger($customerData);
        $this->adminLayout = 'emails.test';
        $this->adminSubject = 'Test Subject';
    }

    /**
     * Execute the send function of parent
     * @param $params Object Specify address, name, layout, data and subject
     * @return mixed
     */
    protected function trigger($params) {
        $to = $params->to;
        $toName = $params->toName;
        $subject = 'ssscientific - '.$params->subject;
        //$bcc=$params->bcc;
        if ($this->environment == 'local' || $this->environment == 'dev' || $this->environment == 'test' ) {
            $to = $this->testEmail;
            $toName = $this->testName;
            $subject = '[Admin Ignore] ssscientific - ' . $params->subject;
            if(is_array($to)){
                /*$to[]='hari@inhabitr.in';
                $to[]='faizan@inhabitr.in';
                $to[]='tamilselvan@inhabitr.in';*/
            }
            else{
                $toemail=$to;
                $to=[];
                $to[]=$toemail;
                /*$to[]='hari@inhabitr.in';
                $to[]='faizan@inhabitr.in';
                $to[]='tamilselvan@inhabitr.in';*/
            }
        }
        /*if(is_array($bcc)){
            $bcc[]='4932845@bcc.hubspot.com';
        }*/
        $user = User::where('email',$params->to)->get()->first();

        return parent::send($params->layout, $params->data, function ($message) use ($to, $toName, $subject, $params) {
            if (isset($params->replyTo) && $params->replyTo !== '') {
                $message->replyTo($params->replyTo, $params->replyToName);
            }
            if (isset($params->from) && $params->from !== '') {
                $message->from($params->from, 'Phoenix Rising');
            }
            if(is_array($to)){
                $message->to($to)
                    ->bcc('4932845@bcc.hubspot.com')
                    ->subject($subject);
            }else{
                $message->to($to, $toName)
                    ->bcc('4932845@bcc.hubspot.com')
                    ->subject($subject);
            }
            if (isset($params->attachments) && !empty($params->attachments)) {
                foreach ($params->attachments as $attach){
                    $message->attach($attach);
                }

            }
            if(isset($params->attachData) && !empty($params->attachData)){
                foreach ($params->attachData as $attach){
                    $message->attachData($attach['data'], $attach['name']);
                }
            }
        });
    }

    /**
     * Destructor triggers emails to admin if layout is specified
     */
    public function __destruct() {
        //send mail to admin
        if ($this->adminLayout !== '') {
            $to = $this->adminEmail;
            $toName = $this->adminName;
            $subject = trim($this->adminSubject) == '' ? 'Inhabitr - Admin Copy' : $this->adminSubject;
            if ($this->environment == 'local' || $this->environment == 'dev' ) {
                //$to = 'testing+1@inhabitr.com';
                $to = $this->testEmail;
                $toName = $this->testName;
                $subject = (trim($this->adminSubject) == '') ? 'Admin Copy' : $this->adminSubject;
                $subject = '[Admin Ignore] Inhabitr - ' . $subject;
            }

            parent::send($this->adminLayout, $this->data, function ($message) use ($to, $toName, $subject) {
                if (array_key_exists('replyTo', $this->adminParams)) {
                    $message->replyTo($this->adminParams['replyTo'], $this->adminParams['replyToName']);
                }
                if(trim($this->environment) === 'production'){
                    if (array_key_exists('tovhf', $this->adminParams)) {
                        if(is_array($to)){
                            $to[]='vhfurniture@inhabitr.com';
                        }
                        else{
                            $toemail=$to;
                            $to=[];
                            $to[]=$toemail;
                            $to[]='vhfurniture@inhabitr.com';
                        }
                    }
                    if (array_key_exists('toweborder', $this->adminParams)) {
                        if(is_array($to)){
                            $to[]='websiteorders@chicagostaging.com';
                        }
                        else{
                            $toemail=$to;
                            $to=[];
                            $to[]=$toemail;
                            $to[]='websiteorders@chicagostaging.com';
                        }
                    }
                    if (array_key_exists('toabandonedcart', $this->adminParams)) {
                        if(is_array($to)){
                            $to[]='abandonedcart@chicagostaging.com';
                        }
                        else{
                            $toemail=$to;
                            $to=[];
                            $to[]=$toemail;
                            $to[]='abandonedcart@chicagostaging.com';
                        }
                    }
                    if (array_key_exists('toops', $this->adminParams)) {
                        if(is_array($to)){
                            $to[]='mailto:ops@chicagostaging.com';
                        }
                        else{
                            $toemail=$to;
                            $to=[];
                            $to[]=$toemail;
                        }
                    }
                    if (array_key_exists('tocs', $this->adminParams)) {
                        if(is_array($to)){
                            $to[]='cs@inhabitr.com';
                        }
                        else{
                            $toemail=$to;
                            $to=[];
                            $to[]=$toemail;
                            $to[]='cs@inhabitr.com';
                        }
                    }
                    if (array_key_exists('tovisitstudio', $this->adminParams)) {
                        if(is_array($to)){
                            $to[]='visitstudio@inhabitr.com';
                            //$to[]='stagingadmin@chicagostaging.com';
                        }
                        else{
                            $toemail=$to;
                            $to=[];
                            $to[]=$toemail;
                            $to[]='visitstudio@inhabitr.com';
                            //$to[]='stagingadmin@chicagostaging.com';
                        }
                    }
                    if (array_key_exists('tob2bsales', $this->adminParams)) {
                        if(is_array($to)){
                            $to[]='b2bsales@inhabitr.com';
                        }
                        else{
                            $toemail=$to;
                            $to=[];
                            $to[]=$toemail;
                            $to[]='b2bsales@inhabitr.com';
                        }
                    }
                    if (array_key_exists('tob2b', $this->adminParams)) {
                        if(is_array($to)){
                            $to[]='b2b@inhabitr.com';
                        }
                        else{
                            $toemail=$to;
                            $to=[];
                            $to[]=$toemail;
                            $to[]='b2b@inhabitr.com';
                        }
                    }
                }else{
                    if (array_key_exists('toweborder', $this->adminParams)) {
                        if(is_array($to)){
                            $to[]='websiteorders@chicagostaging.com';
                        }
                        else{
                            $toemail=$to;
                            $to=[];
                            $to[]=$toemail;
                            $to[]='websiteorders@chicagostaging.com';
                        }
                    }
                    if (array_key_exists('toabandonedcart', $this->adminParams)) {
                        if(is_array($to)){
                            $to[]='abandonedcart@chicagostaging.com';
                        }
                        else{
                            $toemail=$to;
                            $to=[];
                            $to[]=$toemail;
                            $to[]='abandonedcart@chicagostaging.com';
                        }
                    }
                }

                if (array_key_exists('webleads', $this->adminParams)) {
                    if(is_array($to)){
                        $to[]='webleads@chicagostaging.com';
                    }
                    else{
                        $toemail=$to;
                        $to=[];
                        $to[]=$toemail;
                        $to[]='webleads@chicagostaging.com';
                    }
                }

                if(is_array($to)){
                    $message->to($to)
                        ->from('staging@chicagostaging.com', $this->adminName)
                        ->subject($subject);
                }else{
                    $message->to($to, $toName)
                        ->from('staging@chicagostaging.com', $this->adminName)
                        ->subject($subject);
                }
                if (array_key_exists('attachments', $this->adminParams)) {
                    foreach ($this->adminParams['attachments'] as $attach){
                        $message->attach($attach);
                    }
                }
                if (array_key_exists('attachData', $this->adminParams)) {
                    foreach ($this->adminParams['attachData'] as $attach){
                        $message->attachData($attach['data'], $attach['name']);
                    }
                }
            });
        }
    }

    public function sendWebsiteDownEmail($email) {
        $customerData = new \stdClass();
        $customerData->to = $email;
        $customerData->toName = 'Inhabitr Admin';
        $customerData->layout = 'emails.websitedown';
        $customerData->subject = 'Inhabitr Website Down';
        $customerData->data=array();
        //$this->trigger($customerData);
        $this->adminLayout = 'emails.websitedown';
        $this->adminSubject = 'Inhabitr Website Down';
    }


    public function sendConfigurationChangeMail($config) {
        $this->data=['config'=>$config];
        $this->adminLayout = 'emails.configuration';
        $this->adminSubject = 'Dashboard configuration updated';
    }

    public function onProductCreate($name,$productid,$link,$livelink) {
        $this->data=['name'=>$name,'productid'=>$productid,'link'=>$link,'livelink'=>$livelink];
        $this->adminLayout = 'emails.productcreatemsg';
        $this->adminSubject = 'New product('.$name.') has been created';
    }

    public function sendAppUserNewPassword($name,$email,$password) {
        $customerData = new \stdClass();
        $customerData->to = $email;
        $customerData->toName = $name;
        $customerData->layout = 'emails.appusernewpassword';
        $customerData->subject = 'Inhabitr Invenotry App - New Password';
        $customerData->data=['email'=>$email,'name'=>$name,'password'=>$password];
        $this->trigger($customerData);
        $this->adminLayout = 'emails.appusernewpassword';
        $this->adminSubject = 'Inhabitr Invenotry App - New Password';
    }

    /**
     * Returns full name from user object
     * @param $userObject Object Specify object of SubletUser
     * @return string
     */
    protected function makeName($userObject) {
        return trim(implode(' ', array_filter([$userObject->first_name, $userObject->last_name])));
    }

    /**
     * Returns layout name with path to email directory
     * @param $layout
     * @return string
     */
    protected function apiLayout($layout) {
        return 'emails.api.' . $layout;
    }

    /**
     * Returns layout name with path to email directory
     * @param $layout
     * @return string
     */
    protected function emailLayout($layout) {
        return 'emails.admin.' . $layout;
    }

    public function sentProposal($user,$orderUser, $atttachment,$type='customer') {
        // email to lister
        $userData = new \stdClass();
        $userData->to = $user->email;
        $userData->toName = $this->makeName($user);
        if($type == 'customer'){
            $userData->layout = $this->apiLayout('proposal.onProposalUser');
        }else{
            $userData->layout = $this->apiLayout('proposal.onProposalInternal');
            $this->adminLayout = '';
            $this->adminParams['attachData'] = null;
        }
        $userData->data = $this->data;
        $userData->subject = 'Proposal Request';
        $userData->attachData = $atttachment;
        $this->trigger($userData);
        if($type  == 'customer'){
            $this->adminLayout = $this->apiLayout('proposal.onProposalAdmin');
            $this->adminParams['attachData'] = $atttachment;
            $this->adminParams['toops'] = true;
            $this->adminSubject = 'Proposal Request of '.$user->first_name.' '.$user->last_name.'.';
        }else{
            $this->adminParams['toops'] = false;
            $this->adminLayout = '';
            $this->adminParams['attachData'] = null;
        }
    }
}
