<?php
namespace App\Services;

use App\Models\User;
use App\Models\Auction;
use App\Models\ContantUs;
use App\Models\Insurance;
use App\Events\AuctionEvent;
use Illuminate\Http\Request;
use App\Models\CommitAuction;
use App\Models\BalanceInsurance;
use App\Helpers\SendNotificationHelper;
use App\Notifications\DashboardNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DBFireBaseNotification;
use App\Exceptions\InsuranceNotFoundException;

class ContactUsService
{
    public function __construct(public ContantUs $contantUs){}

    public function store($data)
    {
        $data['user_id'] = auth()->user()->id;
        return $this->contantUs->create($data);
    }

}
