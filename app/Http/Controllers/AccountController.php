<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Http\Requests\AddCustomerAddressRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthAccountService;
use App\Services\CommonService;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    private $commonService;
    private $authAccountService;
    private $customerService;

    public function __construct()
    {
        $this->commonService = new CommonService();
        $this->authAccountService = new AuthAccountService();
        $this->customerService = new CustomerService();
    }

    public function login()
    {
        $data = [
            'pageTitle' => 'Login',
        ];
        return view('pages.account.login-page', ['data' => $data]);
    }

    public function loginHandler(LoginRequest $loginRequest)
    {
        $loginProperties = $loginRequest->validated();
        $isLoginSuccess = $this->authAccountService->login($loginProperties);

        if ($isLoginSuccess) {
            return redirect()->action([HomeController::class, 'index']);
        }

        Session::flash(Constants::ACTION_ERROR, Constants::LOGIN_DETAIL_INVALID);
        return redirect()->action([AccountController::class, 'login'])->withInput();
    }

    public function register()
    {
        $data = [
            'pageTitle' => 'Register account',
        ];
        return view('pages.account.register-page', ['data' => $data]);
    }

    public function registerHandler(RegisterRequest $registerRequest)
    {
        $registerProperties = $registerRequest->validated();
        $this->authAccountService->register($registerProperties);

        Session::flash(Constants::ACTION_SUCCESS, Constants::REGISTER_SUCCESS);
        return redirect()->action([AccountController::class, 'login']);
    }

    public function logout()
    {
        $this->authAccountService->logout();

        Session::flash(Constants::ACTION_SUCCESS, Constants::LOGOUT_SUCCESS);
        return redirect()->action([AccountController::class, 'login']);
    }

    public function showInfo()
    {
        $customer = Auth::guard('customer')->user();
        $data = [
            'pageTitle' => 'Customer Account Information',
            'categoryTrees' => $this->commonService->getCategoryTrees(),
            'customerAddresses' => $this->customerService->getCustomerAddresses($customer->id),
        ];
        return view('pages.account.account-info-page', ['data' => $data]);
    }

    public function addCustomerAddress(AddCustomerAddressRequest $addCustomerAddressRequest)
    {
        $customer = Auth::guard('customer')->user();
        $addCustomerAddressProperties = $addCustomerAddressRequest->validated();
        $this->customerService->addCustomerAddress($addCustomerAddressProperties, $customer->id);

        Session::flash(Constants::ACTION_SUCCESS, Constants::CREATE_SUCCESS);
        return redirect()->action([AccountController::class, 'showInfo']);
    }

    public function changeDefaultCustomerAddress($customerAddressId)
    {
        $customer = Auth::guard('customer')->user();
        $isSuccess = $this->customerService->changeDefaultCustomerAddress($customerAddressId, $customer->id);

        if ($isSuccess) {
            Session::flash(Constants::ACTION_SUCCESS, Constants::UPDATE_SUCCESS);
        } else {
            Session::flash(Constants::ACTION_ERROR, Constants::CHANGE_DEFAULT_ADDRESS_FAILURE);
        }
        return redirect()->action([AccountController::class, 'showInfo']);
    }

    public function deleteCustomerAddress($customerAddressId)
    {
        $customer = Auth::guard('customer')->user();
        $isSuccess = $this->customerService->deleteCustomerAddress($customerAddressId, $customer->id);

        if ($isSuccess) {
            Session::flash(Constants::ACTION_SUCCESS, Constants::DELETE_SUCCESS);
        } else {
            Session::flash(Constants::ACTION_ERROR, Constants::DELETE_CUSTOMER_ADDRESS_FAILURE);
        }
        return redirect()->action([AccountController::class, 'showInfo']);
    }
}
