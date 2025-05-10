<?php

namespace App\Services;

use App\Models\PrivacyPolicy;
use App\Models\ReturnPolicye;
use App\Models\TermsAndCondition;

class PrivacyPolicyService
{
    public function getPrivacyPolicy()
    {
        return PrivacyPolicy::all();
    }
    public function getTermAndCondition()
    {
        return TermsAndCondition::all();
    }

    public function getReturnPrivacy()
    {
        return ReturnPolicye::all();
    }

}
