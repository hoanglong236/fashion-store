<?php

namespace App\Services;

use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Log;

class CustomerService
{
    public function getCustomerAddresses($customerId)
    {
        return CustomerAddress::where(['customer_id' => $customerId])->get();
    }

    public function addCustomerAddress($customerAddressProperties, $customerId)
    {
        if ($customerAddressProperties['defaultFlag']) {
            $this->setAllCustomerAddressesNotDefault($customerId);
        }

        CustomerAddress::create([
            'customer_id' => $customerId,
            'city' => $customerAddressProperties['city'],
            'district' => $customerAddressProperties['district'],
            'ward' => $customerAddressProperties['ward'],
            'specific_address' => $customerAddressProperties['specificAddress'],
            'address_type' => $customerAddressProperties['addressType'],
            'default_flag' => $customerAddressProperties['defaultFlag'],
        ]);
    }

    public function setAllCustomerAddressesNotDefault($customerId)
    {
        CustomerAddress::where('customer_id', $customerId)
            ->update(['default_flag' => false]);
    }

    public function changeDefaultCustomerAddress($customerAddressId, $customerId)
    {
        $customerAddress = CustomerAddress::where([
            'id' => $customerAddressId,
            'customer_id' => $customerId,
        ])->first();

        if (is_null($customerAddress)) {
            return false;
        }

        $this->setAllCustomerAddressesNotDefault($customerId);
        CustomerAddress::where([
            'id' => $customerAddressId,
            'customer_id' => $customerId,
        ])->update(['default_flag' => true]);

        return true;
    }

    public function deleteCustomerAddress($customerAddressId, $customerId)
    {
        $customerAddress = CustomerAddress::where([
            'id' => $customerAddressId,
            'customer_id' => $customerId,
        ])->first();

        if (is_null($customerAddress)) {
            return false;
        }

        if ($customerAddress->default_flag) {
            CustomerAddress::where('customer_id', $customerId)
                ->where('id', '!=',  $customerAddressId)
                ->limit(1)->update(['default_flag' => true]);
        }

        $customerAddress->delete();
        return true;
    }
}
