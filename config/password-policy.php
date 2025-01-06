<?php
return [
    'max_expire_days' => env('USER_ACCESS_PASSWORD_EXPIRY_PERIOD', 30),
    'expire_alert_days' => env('USER_ACCESS_PASSWORD_EXPIRY_ALERT_PERIOD', 25),
];
