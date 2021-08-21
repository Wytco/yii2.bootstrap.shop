<?php

return [
    require_once(__DIR__ . '/../../common/config/functions.php'),
    require_once(__DIR__ . '/../../common/config/languages.php'),
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'languages' => get_languages(),
];

