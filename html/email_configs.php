<?php
return [
    [
        'name' => 'Gmail Default',
        'smtp_host' => 'smtp.gmail.com',
        'smtp_port' => '587',
        'smtp_username' => 'your_gmail@gmail.com',
        'smtp_password' => 'your_gmail_password',
        'from_email' => 'your_gmail@gmail.com',
        'to_email' => 'recipient@example.com'
    ],
    [
        'name' => 'AWS SES',
        'smtp_host' => 'email-smtp.us-east-1.amazonaws.com',
        'smtp_port' => '587',
        'smtp_username' => 'aws_smtp_user',
        'smtp_password' => 'aws_smtp_pass',
        'from_email' => 'no-reply@yourdomain.com',
        'to_email' => 'recipient@example.com'
    ],
    // ...add more configs as needed...
];
