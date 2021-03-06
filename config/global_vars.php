<?php

return [
    'PAGINATION_LIMIT' => 20,
    'STATUS_ARR' => ['A'=>'Active','I'=>'Inactive'],
    'PRIORITY_ARR' => ['P'=>'Primary','S'=>'Secondary'],
    'IMAGE_PATH' => base_path()."/public/data",
    'IMAGE_MIME'=>array('jpg', 'jpeg', 'JPG','png','PNG'),

    'PRODUCT_TYPE' => [
        'DRAWING_PRODUCT_TYPE' => 'drawingFiles',
        'MACHINE_MOLD_PRODUCT_TYPE' => 'machineModel',
        'MACHINE_MOLD_ATTACHMENT_PRODUCT_TYPE' => 'machineMoldAttachments',
        'DRAWING_ATTACHMENT_PRODUCT_TYPE' => 'drawingAttachments',
    ],
    
    'ALLOW_LOGIN' => [
        'Y' =>'Yes',
        'N' => 'No',
    ],
    
    'HARD_CODED_ID' => [
        'managerId' => 1,
        'teamLead' => 2,
        'agent' => 3,
        'qualityAuditor' => 4,
        'employeeCategory' => 1,
        'callDuration' => 2,
        'fatalReason' => 3,
    ],

    'ADHERENCE' => [
        'Yes' => 'Yes',
        'No' => 'No',
        'NA' => 'NA',
    ],

    'OTHER_QUALITY' => [
        'Yes' => 'Yes',
        'No' => 'No',
        'NA' => 'NA',  
    ],
    'OSAT' => [
        'Smiley' => 'Smiley',
        'Neutral' => 'Neutral',
        'Frowny' => 'Frowny',
    ],
    'FORM_ID' => [
        'VOICE' => 1,
    ],

    'ADMIN_ROLE_ID' => 1,

    'DEFAULT_PERMISSIONS' => [
        'authentication.login' => true,
        'authentication.update_profile' => true,
        'authentication.change_password' => true,
        'code_value.add' => true,
        'code_value.edit' => true,
        'code_value.view' => true,
        'user.add' => true,
        'user.edit' => true,
        'user.view' => true,
        'user.reset_password' => true,
        'call_type.add' => true,
        'call_type.edit' => true,
        'call_type.view' => true,

    ],
   
    'username_min_length' => 5,
    'password_min_length' => 6,
    'available_hrs_downtime_reasons' => [3,4],
    'mold_change_over_id' => 4, 
    'preventive_maintenance_id' => 3,   

    'quality' => [
        'tm' => 'Tone Manner',
        'communication' => 'Communication',
        'chp' => 'Correct Hold Procedure',
        'pao' => 'Personal Accountability and Ownership',
        'delighter' => 'Delighters used on the call',
        'su' => 'System Usage',
        'sct' => 'Correct CT and SCT',
        'ocr' => 'OCR',
    ],

    'DATEPICKER_MONTH_SPAN' => 31 , // its in days


];
