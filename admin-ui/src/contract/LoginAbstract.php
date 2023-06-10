<?php

namespace Tadm\ui\contract;

use Tadm\ui\component\Component;
use Tadm\ui\response\Message;
use Tadm\ui\response\Response;
use Tadm\ui\support\Container;


abstract class LoginAbstract
{
    /**
     * 登陆页
     * @return Component
     */
    abstract public function index(): Component;

    /**
     * 登录验证
     * @param array $data 提交数据
     * @return Message
     */
    abstract public function check(array $data): Message;

    /**
     * 退出登录
     * @return Message
     */
    abstract public function logout(): Message;

    /**
     * 获取验证码
     * @return Response
     */
    abstract public function captcha(): Response;
}
