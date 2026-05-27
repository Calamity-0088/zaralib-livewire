<?php
return [
    'title'       => 'Ajustes',
    'description' => 'Gestiona tu perfil y la configuración de tu cuenta',

    'tabs' => [
        'profile'    => 'Perfil',
        'security'   => 'Seguridad',
        'appearance' => 'Apariencia',
    ],

    'profile' => [
        'description' => 'Actualiza tu nombre y tu dirección de correo electrónico',
    ],

    'security' => [
        'description'    => 'Asegúrate de que tu cuenta utilice una contraseña larga y aleatoria para mantenerte seguro.',
        'update_password' => 'Actualizar contraseña',
    ],

    'appearance' => [
        'description' => 'Actualiza la configuración de apariencia de tu cuenta',
        'light'       => 'Claro',
        'dark'        => 'Oscuro',
        'system'      => 'Sistema',
    ],

    '2fa' => [
        'title'                => 'Autenticación de doble factor',
        'subtitle'             => 'Gestiona tu configuración de autenticación de doble factor',
        'description'          => 'Cuando actives la autenticación de doble factor, se te pedirá un PIN seguro al iniciar sesión.',
        'enable'               => 'Activar 2FA',
        'enabled_title'        => 'Autenticación de doble factor activada',
        'enabled_description'  => 'La autenticación de doble factor ya está activada. Escanea el código QR o introduce la clave de configuración.',
        'verify_title'         => 'Verifica el código de autenticación',
        'verify_description'   => 'Introduce el código de 6 dígitos de tu aplicación de autenticación.',
        'enable_title'         => 'Activar autenticación de doble factor',
        'enable_description'   => 'Para completar la activación, escanea el código QR o introduce la clave de configuración.',
        'manual_code'          => 'o bien, introduce el código manualmente',
    ],

    'delete' => [
        'label'      => 'Eliminar cuenta',
        'description' => 'Elimina tu cuenta y todos sus recursos',
        'alert_title' => '¿Estás seguro de que quieres eliminar tu cuenta?',
        'alert_description' => 'Una vez eliminada tu cuenta, todos sus recursos y datos se borrarán de forma definitiva. Introduce tu contraseña para confirmar.',
    ],
];
