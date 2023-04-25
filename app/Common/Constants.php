<?php

namespace App\Common;

use Illuminate\Support\Facades\Log;

class Constants
{
    const TOP_BRAND_COUNT = 5;
    const TOP_CATEGORY_COUNT = 3;
    const TOP_PRODUCT_COUNT = 8;

    const ACTION_SUCCESS = 'success_message';
    const ACTION_ERROR = 'error_message';

    const CREATE_SUCCESS = 'Create successfully.';
    const UPDATE_SUCCESS = 'Update successfully.';
    const DELETE_SUCCESS = 'Delete successfully.';

    const LOGOUT_SUCCESS = 'Logout successfully.';
    const REGISTER_SUCCESS = 'Register successfully.';
    const LOGIN_DETAIL_INVALID = 'Please enter valid login details.';
    const PLACE_ORDER_FAILED = 'Order failed. Because the quantity of some items is not enough.';
    const ADD_TO_CART_SUCCESS = 'Add to cart successfully';
    const ORDER_CANCEL_SUCCESS = 'Order canceled successfully';
    const ORDER_CANCEL_FAILURE = 'Order canceled failed';
    const CHANGE_DEFAULT_ADDRESS_FAILURE = 'Change default address failed';
    const DELETE_CUSTOMER_ADDRESS_FAILURE = 'Delete customer address failed';

    const ITEMS_PER_PRODUCTS_PAGE = 6;

    const BEST_SELLER_PRODUCTS_SIDEBAR_COUNT = 3;
    const RELATED_PRODUCTS_COUNT = 8;

    const FIREBASE_STORAGE_IMAGES_PATH = 'project_images/';

    private function __construct()
    {
    }
}
