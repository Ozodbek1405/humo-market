<?php
return [
    'id'         => 'ID',
    'reward'     => 'Reward',
    'type'       => 'Type',
    'code'       => 'Code',
    'data'       => 'Description',
    'limit'      => 'Limit',
    'used'       => 'Used',
    'status'     => 'Status',
    'title'      => 'Coupon/Discount',
    'login'      => 'Login require',
    'expires_at' => 'Expires',
    'discount_unique' => 'Code already exists',
    'admin'      => [
        'title'          => 'Discount',
        'create_success' => 'Create new item success!',
        'edit_success'   => 'Edit item success!',
        'list'           => 'Discount list',
        'id'             => 'ID',
        'status'         => 'Status',
        'action'         => 'Action',
        'edit'           => 'Edit',
        'export'         => 'Export',
        'delete'         => 'Delete',
        'refresh'        => 'Refresh',
        'result_item'    => 'Showing <b>:item_from</b> to <b>:item_to</b> of <b>:total</b> items</b>',
        'sort'           => 'Sort',
        'search'         => 'Search',
        'add_new'        => 'Add new',
        'add_new_title'  => 'Add discount',
        'add_new_des'    => 'Create a new discount',
        'choose_icon'    => 'Choose icon',
        'code_helper'    => 'Only characters in the group: "A-Z", "a-z", "0-9" and ".-_"',
        'code_validate'  => 'Only characters in the group: "A-Z", "a-z", "0-9" and ".-_"',

        'search_place'   => 'Search code',
        'sort_order'     => [
            'id_asc'    => 'ID asc',
            'id_desc'   => 'ID desc',
            'code_asc'  => 'Code asc',
            'code_desc' => 'Code desc',
        ],
    ],
    'process'     => [
        'invalid'         => 'This code invalid!',
        'over'            => 'This code exceeds the number of times it is used!',
        'used'            => 'You already used this code!',
        'undefined'       => 'Error undefined!',
        'not_allow'       => 'You can not use Point in here!',
        'value'           => 'This coupon have value :value for this order!',
        'expire'          => 'Code expires!',
        'completed'       => 'Use coupon success!',
        'must_login'      => 'You must login to use this coupon!',
        'user_id_invalid' => 'User ID invalid!',
    ],
    'plugin_action' => [
        'plugin_discount_pro_exist' => 'Remove plugin DiscountPro before install this plugin'
    ],
];
