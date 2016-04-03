<?php

namespace BusinessLogic;

use Silex\Application;

class SendMailProcess
{
    /** @var string */
    private $subject;

    /** @var string[] */
    private $to;

    /** @var string */
    private $body;

    /** @var Application */
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function execute()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($this->subject)
            ->setFrom(array($this->app['config']['send_mail']['from']))
            ->setTo($this->to)
            ->setBody($this->body, 'text/html');
        $this->app['mailer']->send($message);
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @param string[] $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
}
