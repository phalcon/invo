<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    {{ title('') }}

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="INVO - online invoicing">
    <meta name="author" content="Phalcon Team">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Spectral:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/invo.css') }}">
</head>
<body>
{{ content() }}

{{ tag.script('').add(url('js/utils.js'), ['type':null]) }}
</body>
</html>
