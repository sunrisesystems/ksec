<?php

return [
    'no_record' => 'Record does not exists.', 
    'CONFIRM_DELETE' => 'Are you sure you want to delete',
    'UPDATE_SUCC' => 'Record updated successfully.',
    'ADDED_SUCC' => 'Record added successfully.',
    'DELETE_SUCC' => 'Record deleted successfully.',
    'search_req' => 'Please fill atleast one parameter to search.',
    'search_keyword_req' => 'Enter keyword to search.',
    'empty_callType' => 'Call type field is required.',
    'empty_status' => 'The status field is required.',
    'empty_desc' => 'Description field is required.',
    'PROCESS_FAIL' => 'There is some error while processing your request. Please try after some time.',
    'ERROR' => 'There is some error while processing your request. Please try after some time.',
    'LOGOUT'       => 'You have successfully logged out.',
    'adherence_comment' => "Comment is complusary for 'No' adherence",


    // old messages
    'empty_shape' => 'The shape name field is required.',
    'empty_shape_code' => 'The shape code field is required.',
    'empty_store' => 'The store name field is required.',
    'empty_group' => 'The group name field is required.',
    'empty_type' => 'The type name field is required.',
    'empty_neck_size' => 'The neck size field is required.',
    'empty_account' => 'Account name is required.',
    'empty_account_type' => 'Account type is required.',
    'empty_email' => 'The email field is required.',
    'invalid_email' => 'Email format is invalid.',
    'select_group' => 'Please select group',
    'empty_password' => 'The password field is required.',
    'empty_mold_name' => 'The mold name field is required.',
    'empty_color' => 'Color name field is required.',
    'LOGIN_FAILED' => 'Invalid credentials.',
    'empty_username' => 'Username field is required.',
    'empty_unit' => 'Unit field is required.',
    'delete_error' => 'There is dependancy. Delete is not allowed.',
    'SHAPE_DEPENDANCY' => 'Could not delete. Because this shape is used in drawing.',
    'MACHINE_MODEL_STORE_DEPENDANCY' => 'Could not delete. Because this store is used in machine model.',
    'MOLD_STORE_DEPENDANCY' => 'Could not delete. Because this store is used in mold.',
    'PRODUCT_STORE_DEPENDANCY' => 'Could not delete. Because this store is used in product.',
    'item_store_dependancy' => 'Could not delete. Because this store is used in item master.',
    'item_type_dependancy' => 'Could not delete. Because this type is used in item master.',
    'MACHINE_MODEL_ACCOUNT_DEPENDANCY' => 'Could not delete. Because this manufacturer is used in machine model.',
    'DRAWING_ACCOUNT_DEPENDANCY' => 'Could not delete. Because this manufacturer is used in drawing.',
    'DRAWING_ACCOUNT_DEPENDANCY' => 'Could not delete. Because this manufacturer is used in mold.',
    'MACHINE_MODEL_TYPE_DEPENDANCY' => 'Could not delete. Because this type is used in machine mold.',
    'DRAWING_TYPE_DEPENDANCY' => 'Could not delete. Because this type is used in drawing.',
    'MOLD_TYPE_DEPENDANCY' => 'Could not delete. Because this type is used in mold.',
    'DRAWING_NECKSIZE_DEPENDANCY' => 'Could not delete. Because this type is used in drawing.',
    'empty_code' => 'Code field is required',
    'empty_codeValue' => 'Code Value field is required',
    'PRODUCT_COLOR_DEPENDANCY' => 'Could not delete. Because this color is used in product.',
    'combination_already_exists' => 'Selected combination of mother mold,blow mold, injection is already exists.',
    'invalid_product' => 'Invalid product selection',
    'invalid_mold' => 'Invalid mold selection',
    'invalid_start_date' => 'Invalid start date and time',
    'plan_date_not_avaiable' => 'Plan already exists for selected date time.',
    'empty_machine' => 'Please select machine.',
    'empty_mold' => 'Please select mold.',
    'empty_product' => 'Please select product.',
    'empty_start_date_time' => 'Please select start date time.',
    'empty_end_date_time' => 'End date time required.',
    'empty_pending_quantity' => 'Pending quantity required.',
    'empty_planning_quantity' => 'Planning quantity required.',
    'empty_cycle_time' => 'Change Cycle time value required.',
    'empty_cycle_time_reason' => 'Change Cycle time reason required.',
    'empty_cavity_block_reason' => 'Change cavity block reason required.',
    'empty_not_available_time_reason' => 'Not available change reason required.',
    'empty_change_over_time_reason' => 'Change over time reason required.',
    'empty_time_required' => 'Time required field is required.',
    'empty_time_required_days' => 'Days field required.',
    'empty_time_required_hrs' => 'Hours field required.',
    'empty_time_required_mins' => 'Minute field required.',
    'not_allow_to_edit_plan' => 'Not allow to edit plan because its not active plan.',
    'no_active_plans_available' => 'No active plans are available for selected date and shift.',
    'start_date_error' => 'Start date must be less than end date.',
    'close_date_time' => 'Please select closed date time.',
    'running_plan_already_exists' => 'There is already one running plan for selected machine.',
    'select_type' => 'Please select type.',
    'select_store' => 'Please select class/store.',
    'empty_item_name' => 'Please enter item name.',
    'empty_item_short_desc' => 'Please enter short description.',
    'select_box_type' => 'Please select box type.',
    'select_type_of_packing' => 'Please select type of packing.',
    'empty_qty_per_box' => 'Please enter quantity per box.',
    'qty_per_box_packing_unique' => 'Quantity per box already exists for selected product, box type and type of packing.',
    'daily_entry_not_done' => 'Daily entry is not yet done for selected date and shift.',
    'daily_entry_not_done_completed' => 'Daily entry is incompleted for selected date and shift. Please inform production team.',
    'not_allowed_to_edit' => 'Not allow to edit Administrator role.',
    'already_entry_done' => 'Entry for selected shift, date and time is already exists.',
    'edit_not_allowed' => 'Edit is not allowed for this entry',
    'rejection_mismatch' => 'Total rejection mismatch. Please verify.',
    'empty_firstname' => 'First name field is required.',
    'empty_lastname' => 'Last name field is required.',
    'invalid_firstname' => 'Invalid first name.',
    'invalid_lastname' => 'Invalid last name.',
    'invalid_email' => 'Invalid Email.',
    'empty_username' => 'Username field is required.',
    'invalid_username' => 'Username field must be alpha numeric.',
    'empty_password' => 'Password field is required.',
    'empty_role' => 'Role field is required.',
    'username_length' => 'Username minimum length must be '.Config::get("global_vars.username_min_length"),
    'password_length' => 'Password minimum length must be '.Config::get("global_vars.password_min_length"),
    'empty_confirm_password' => 'Confirm password field required.',
    'password_equal' => 'New password and confirm password must be same.',
    'pwd_reset_succ' => 'Password reset successfully.',
    'empty_old_password' => 'Old password field is required.',
    'empty_new_password' => 'New password fields is required.',
    'password_not_equal' => 'Old password and new password should not be same.',
    'pwd_change_succ' => 'Password changed successfully. Please login with new password.',
    'old_pwd_mismatch' => 'Old password does not match.',
    'update_profile_succ' => 'Profile updated successfully.',
]

?>