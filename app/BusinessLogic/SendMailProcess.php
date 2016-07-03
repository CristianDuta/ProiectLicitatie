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

    public function __construct(Application $app, Swift_Message $message)
    {
        $this->app = $app;
        $this->message = $message;
    }


    public function execute()
    {
        $this->message
            ->setSubject($this->subject)
            ->setFrom(array($this->app['config']['send_mail']['from'])) //todo
            ->setTo($this->to)
            ->setBody($this->body, 'text/html');

        /** @var \Swift_Mailer $mailer */
        $mailer = $this->app['mailer'];
        $mailer->send($this->message);
        $this->flushMessageSpool();
    }


    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }


    /**
     * @param string $to
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


    /**
     * By default, the Swiftmailer provider sends the emails using the KernelEvents::TERMINATE event,
     * which is fired after the response has been sent. However, as this event isn't fired for console commands,
     * your emails won't be sent. To fix this we need to flush the message spool by hand
     */
    private function flushMessageSpool()
    {
        $this->app['swiftmailer.spooltransport']
            ->getSpool()
            ->flushQueue($this->app['swiftmailer.transport']);
    }
}
