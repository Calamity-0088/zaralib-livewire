<?php
return [
    'title'       => 'Settings',
    'description' => 'Manage your profile and account settings',

    'tabs' => [
        'profile'    => 'Profile',
        'security'   => 'Security',
        'appearance' => 'Appearance',
    ],

    'profile' => [
        'description' => 'Update your name and email address',
    ],

    'security' => [
        'description'     => 'Ensure your account is using a long, random password to stay secure.',
        'update_password' => 'Update password',
    ],

    'appearance' => [
        'description' => 'Update your account appearance settings',
        'light'       => 'Light',
        'dark'        => 'Dark',
        'system'      => 'System',
    ],

    '2fa' => [
        'title'               => 'Two factor authentication',
        'subtitle'            => 'Manage your two factor authentication settings',
        'description'         => 'When two factor authentication is enabled, you will be prompted for a secure PIN during login.',
        'enable'              => 'Enable 2FA',
        'enabled_title'       => 'Two factor authentication enabled',
        'enabled_description' => 'Two factor authentication is now enabled. Scan the QR code or enter the setup key into your authenticator app.',
        'verify_title'        => 'Verify authentication code',
        'verify_description'  => 'Enter the 6-digit code from your authenticator app.',
        'enable_title'        => 'Enable two factor authentication',
        'enable_description'  => 'To finish enabling two factor authentication, scan the QR code or enter the setup key into your authenticator app.',
        'manual_code'         => 'or enter the setup key manually',
    ],

    'delete' => [
        'label'             => 'Delete account',
        'description'       => 'Delete your account and all of its resources',
        'alert_title'       => 'Are you sure you want to delete your account?',
        'alert_description' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.',
    ],
];
