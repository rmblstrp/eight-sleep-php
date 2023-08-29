<?php

namespace App\EightSleep;

use EightSleep\App\User\Objects\LinkedUserAccountsInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class LinkedUserAccounts extends Model implements LinkedUserAccountsInterface
{
    protected $table = 'linked_user_accounts';

    function getOriginatingUserId(): int
    {
        return $this->getAttributeValue('originating_user_id');
    }

    function setOriginatingUserId(int $originatingUserId): LinkedUserAccountsInterface
    {
        $this->setAttribute('originating_user_id', $originatingUserId);
        return $this;
    }

    function getLinkedUserId(): int
    {
        return $this->getAttributeValue('linked_user_id');
    }

    function setLinkedUserId(int $linkedUserId): LinkedUserAccountsInterface
    {
        $this->setAttribute('linked_user_id', $linkedUserId);
        return $this;
    }

    function persist(): void
    {
        $this->save();
    }

    function delete(): void
    {
        Log::debug('LinkedUserAccounts::delete()');
        parent::delete();
    }
}
