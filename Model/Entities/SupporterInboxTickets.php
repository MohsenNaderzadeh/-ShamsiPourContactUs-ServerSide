<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 6/30/2021
 * Time: 7:18 AM
 */

class SupporterInboxTickets
{

    private $ticketId;
    private $ticketTitle;
    private $ticketRelatedAdministrativeDepartemantId;
    private $ticketOwnerId;
    private $ticketSubmitDate;
    private $ticketStatus;
    private $ticketInboxId;
    private $supporterOwnerTicketId;
    private $ticketAddedDateToSupporterInbox;




    public function __construct($ticketId, $ticketTitle, $ticketRelatedAdministrativeDepartemantId, $ticketOwnerId, $ticketSubmitDate, $ticketStatus,$ticketInboxId,$supporterOwnerTicketId,$ticketAddedDateToSupporterInbox)
    {
        $this->ticketId=$ticketId;
        $this->ticketTitle=$ticketTitle;
        $this->ticketRelatedAdministrativeDepartemantId=$ticketRelatedAdministrativeDepartemantId;
        $this->ticketOwnerId=$ticketOwnerId;
        $this->ticketSubmitDate=$ticketSubmitDate;
        $this->ticketStatus=$ticketStatus;
        $this->ticketInboxId=$ticketInboxId;
        $this->supporterOwnerTicketId=$supporterOwnerTicketId;
        $this->ticketAddedDateToSupporterInbox=$ticketAddedDateToSupporterInbox;
    }


    /**
     * @return mixed
     */
    public function getTicketId()
    {
        return $this->ticketId;
    }

    /**
     * @return mixed
     */
    public function getTicketInboxId()
    {
        return $this->ticketInboxId;
    }

    /**
     * @param mixed $ticketInboxId
     */
    public function setTicketInboxId($ticketInboxId): void
    {
        $this->ticketInboxId = $ticketInboxId;
    }

    /**
     * @return mixed
     */
    public function getSupporterOwnerTicketId()
    {
        return $this->supporterOwnerTicketId;
    }

    /**
     * @param mixed $supporterOwnerTicketId
     */
    public function setSupporterOwnerTicketId($supporterOwnerTicketId): void
    {
        $this->supporterOwnerTicketId = $supporterOwnerTicketId;
    }

    /**
     * @return mixed
     */
    public function getTicketAddedDateToSupporterInbox()
    {
        return $this->ticketAddedDateToSupporterInbox;
    }

    /**
     * @param mixed $ticketAddedDateToSupporterInbox
     */
    public function setTicketAddedDateToSupporterInbox($ticketAddedDateToSupporterInbox): void
    {
        $this->ticketAddedDateToSupporterInbox = $ticketAddedDateToSupporterInbox;
    }

    /**
     * @param mixed $ticketId
     */
    public function setTicketId($ticketId): void
    {
        $this->ticketId = $ticketId;
    }

    /**
     * @return mixed
     */
    public function getTicketTitle()
    {
        return $this->ticketTitle;
    }

    /**
     * @param mixed $ticketTitle
     */
    public function setTicketTitle($ticketTitle): void
    {
        $this->ticketTitle = $ticketTitle;
    }

    /**
     * @return mixed
     */
    public function getTicketRelatedAdministrativeDepartemantId()
    {
        return $this->ticketRelatedAdministrativeDepartemantId;
    }

    /**
     * @param mixed $ticketRelatedAdministrativeDepartemantId
     */
    public function setTicketRelatedAdministrativeDepartemantId($ticketRelatedAdministrativeDepartemantId): void
    {
        $this->ticketRelatedAdministrativeDepartemantId = $ticketRelatedAdministrativeDepartemantId;
    }

    /**
     * @return mixed
     */
    public function getTicketOwnerId()
    {
        return $this->ticketOwnerId;
    }

    /**
     * @param mixed $TicketOwnerId
     */
    public function setTicketOwnerId($ticketOwnerId): void
    {
        $this->ticketOwnerId = $ticketOwnerId;
    }

    /**
     * @return mixed
     */
    public function getTicketSubmitDate()
    {
        return $this->ticketSubmitDate;
    }

    /**
     * @param mixed $TicketSubmitDate
     */
    public function setTicketSubmitDate($ticketSubmitDate): void
    {
        $this->ticketSubmitDate = $ticketSubmitDate;
    }

    /**
     * @return mixed
     */
    public function getTicketStatus()
    {
        return $this->ticketStatus;
    }

    /**
     * @param mixed $TicketisOpen
     */
    public function setTicketStatus($ticketStatus): void
    {
        $this->ticketStatus = $ticketStatus;
    }


}