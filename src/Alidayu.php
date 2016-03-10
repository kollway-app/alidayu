<?php
/**
 * Created by PhpStorm.
 * User: Tim
 * Date: 2016/3/10
 * Time: 14:59
 */

namespace Kollway\Alidayu;

include "TopSdk.php";
date_default_timezone_set('Asia/Shanghai');

class Alidayu {

    private $topclient;

    public function __construct() {
        $this->topclient = new \TopClient(env('ALIDAYU_APP_KEY'), env('ALIDAYU_SECRETKEY'));
    }

    public function sendSms($phone, $template_code, Array $msg_param=null) {
        $req = new \AlibabaAliqinFcSmsNumSendRequest();
        $req->setSmsType('normal');
        $req->setSmsFreeSignName(env('ALIDAYU_SIGN'));

        if($msg_param) {
            $msg_param_json = json_encode($msg_param);
            $req->setSmsParam($msg_param_json);
        }
        $req->setRecNum($phone);
        $req->setSmsTemplateCode($template_code);
        return $this->topclient->execute($req);
    }

}