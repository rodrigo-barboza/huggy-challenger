<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Bem vindo {{ config('app.name') }}</title>
        <style type="text/css">
            body {
                font-family: Arial, sans-serif;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <p>Olá, {{ $contact?->name ?? 'Fulano' }},</p>
        <p>Obrigado por se registrar no {{ config('app.name') }}.</p>
        <p>Atenciosamente,</p>
        <p>{{ config('app.name') }}</p>
    </body>
</html>
