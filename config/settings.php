<?php

return [
    'pagination' => [
        'per_page' => 20,
        'order_by' => 'desc',
    ],

    'message' => [
        'saved' => 'Successfully Saved',
        'updated' => 'Successfully Updated',
        'published' => 'Successfully Published',
        'deleted' => 'Successfully Deleted',
        'status_changed' => 'Status Changed Successfully',
        'not_found' => 'Record Not Found',
        'url_not_found' => 'URL Not Found',
        'bad_request' => 'Bad Request',
        'user_registered' => 'User successfully Registered',
        'validation_fail' => 'The given data was invalid.',
        'verified_email' => 'Your mail has been successfully verified',
        'wrong_token' => 'Your mail could not be verified. Please try again.',
        'already_verified' => 'Your mail has already been verified',
        'fetched' => 'Successfully Fetched',
        'cancel_order' => 'Order canceled Successfully',
        'cancel_order_unsuccess' => 'Order cancel unsuccessful',
        'refund_order' => 'Order refunded Successfully',
        'refund_order_unsuccess' => 'Order refund unsuccessful',
        'quantity_exceeded' => 'Maximum quantity exceeded!',
        'fatal_error' => 'Fatal Error Occurred.',
        's3_error' => 'Could not be deleted from server.',
        's3_media_not_found' => 'Media couldnt be found in the server.',
        'one_default_message' => 'Only one variant can be default.',
        'restriction_of_package_deletion' => 'Cannot delete a default package.',
        'invalid_media_file' => 'Please upload a valid Media file',
        'check_inventory' => 'Insufficient Product in the inventory',
        'exchange_order' => 'Order exchanged successfully',
        'order_source_manual_order' => 'MANUAL ORDER',
        'order_detail_cant_be_deleted' => 'Order detail cant be deleted as it is partially or fully delivered',
        'larger_return_item_number' => 'Return items cannot be larger than delivered items',
        'delivery_marker' => '-D'
    ]
];
