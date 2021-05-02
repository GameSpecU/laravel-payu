<?php

return [
    'env'    => env('PAYU_ENV', 'sandbox'),
    'pos_id' => env('PAYU_POS_ID'),
    'secondary_key' => env('PAYU_KEY_MD5'),
    'oauth_id' => env('PAYU_OAUTH_ID'),
    'oauth_secret' => env('PAYU_OAUTH_SECRET'),

];
