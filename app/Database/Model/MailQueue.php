<?php

namespace Database\Model;

use Database\Model\Base\MailQueue as BaseMailQueue;

/**
 * Skeleton subclass for representing a row from the 'mail_queue' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class MailQueue extends BaseMailQueue
{
    const MAIL_STATUS_SENT     = 1;
    const MAIL_STATUS_NOT_SENT = 0;

}
