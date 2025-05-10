<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\TermsAndCondition;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Services\PrivacyPolicyService;

class PrivacyPolicyController extends Controller
{
  public function __construct(public PrivacyPolicyService $privacyPolicyService) {}

  public function show(Request $request)
  {
    $privacyPolicies = $this->privacyPolicyService->getPrivacyPolicy();

    return view('web.pages.privacy_policy', compact('privacyPolicies'));
  }

  public function showTerms(Request $request)
  {
    $terms_conditions = $this->privacyPolicyService->getTermAndCondition();

    return view('web.pages.terms_condition', compact('terms_conditions'));
  }

  public function show_return_policy(Request $request)
  {
    $return_policies = $this->privacyPolicyService->getReturnPrivacy();


    return view('web.pages.return_policy', compact('return_policies'));
  }
}
