<?php

namespace BusinessLogic;

use Silex\Application;
use Swift_Image;
use Swift_Message;

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

    /** @var Swift_Message */
    private $message;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->message = Swift_Message::newInstance();
    }



    public function execute()
    {
        $this->message
            ->setSubject($this->subject)
            ->setFrom(array($this->app['config']['send_mail']['from']))
            ->setTo($this->to)
            ->setBody($this->body, 'text/html');

        $this->app['mailer']->send($this->message);
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


    /**
     * @param string $path
     * @return string
     */
    public function getImagePath($path)
    {
        return $this->message->embed(Swift_Image::fromPath($path));
    }
}
