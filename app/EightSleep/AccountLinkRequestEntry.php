<?php

namespace App\EightSleep;

use EightSleep\App\User\Objects\AccountLinkRequestEntryInterface;
use Illuminate\Database\Eloquent\Model;

class AccountLinkRequestEntry extends Model implements AccountLinkRequestEntryInterface
{
    protected $table = 'account_link_request_entry';

    function getId(): int
    {
        return $this->getAttributeValue('id');
    }

    function getOriginatingUserId(): int
    {
        return $this->getAttributeValue('originating_user_id');
    }

    function setOriginatingUserId(int $requestingUserId): AccountLinkRequestEntryInterface
    {
        $this->setAttribute('originating_user_id', $requestingUserId);
        return $this;
    }

    function getInvitedUserId(): int
    {
        return $this->getAttributeValue('invited_user_id');
    }

    function setInvitedUserId(int $invitedUserId): AccountLinkRequestEntryInterface
    {
        $this->setAttribute('invited_user_id', $invitedUserId);
        return $this;
    }

    function persist(): void
    {
        $this->save();
    }

    function delete(): void
    {
        parent::delete();
    }
}
