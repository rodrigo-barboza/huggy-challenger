@php
header("Content-Type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp

<Response>
    <Say voice="alice" language="pt-BR">
        Olá, {{ $contact->name }} tudo bem? Você está participando do desafio de Rodrigo Leandro para se tornar um HuggyMate!
    </Say>
</Response>
