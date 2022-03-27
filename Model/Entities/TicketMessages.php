<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/16/2021
 * Time: 1:08 PM
 */

class TicketMessages
{
    private $messageId;
    private $stdId;
    private $coworkerId;
    private $messageSendType;
    private $messageText;
    private $messageSendDate;
    private $isMessageAFile;
    private $ticketId;

    /**
     * @return mixed
     */
    public function getTicketId()
    {
        return $this->ticketId;
    }

    /**
     * @param mixed $ticketId
     */
    public function setTicketId($ticketId): void
    {
        $this->ticketId = $ticketId;
    }

    /**
     * TicketMessages constructor.
     * @param $messageId
     * @param $stdMessageTicketId
     * @param $coworkerId
     * @param $messageSendType
     * @param $messageText
     * @param $messageSendDate
     * @param $isMessageAFile
     */
    public function __construct($messageId, $stdId, $coworkerId, $messageSendType, $messageText, $messageSendDate, $isMessageAFile)
    {
        $this->messageId = $messageId;
        $this->stdId = $stdId;
        $this->coworkerId = $coworkerId;
        $this->messageSendType = $messageSendType;
        $this->messageText = $messageText;
        $this->messageSendDate = $messageSendDate;
        $this->isMessageAFile = $isMessageAFile;
    }


    /**
     * @return mixed
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param mixed $messageId
     */
    public function setMessageId($messageId): void
    {
        $this->messageId = $messageId;
    }

    /**
     * @return mixed
     */
    public function getStdId()
    {
        return $this->stdId;
    }

    /**
     * @param mixed $stdMessageTicketId
     */
    public function setStdId($stdId): void
    {
        $this->stdId = $stdId;
    }

    /**
     * @return mixed
     */
    public function getCoworkerId()
    {
        return $this->coworkerId;
    }

    /**
     * @param mixed $coworkerId
     */
    public function setCoworkerId($coworkerId): void
    {
        $this->coworkerId = $coworkerId;
    }

    /**
     * @return mixed
     */
    public function getMessageSendType()
    {
        return $this->messageSendType;
    }

    /**
     * @param mixed $messageSendType
     */
    public function setMessageSendType($messageSendType): void
    {
        $this->messageSendType = $messageSendType;
    }

    /**
     * @return mixed
     */
    public function getMessageText()
    {
        return $this->messageText;
    }

    /**
     * @param mixed $messageText
     */
    public function setMessageText($messageText): void
    {
        $this->messageText = $messageText;
    }

    /**
     * @return mixed
     */
    public function getMessageSendDate()
    {
        return $this->messageSendDate;
    }

    /**
     * @param mixed $messageSendDate
     */
    public function setMessageSendDate($messageSendDate): void
    {
        $this->messageSendDate = $messageSendDate;
    }

    /**
     * @return mixed
     */
    public function getisMessageAFile()
    {
        return $this->isMessageAFile;
    }

    /**
     * @param mixed $isMessageAFile
     */
    public function setIsMessageAFile($isMessageAFile): void
    {
        $this->isMessageAFile = $isMessageAFile;
    }




}