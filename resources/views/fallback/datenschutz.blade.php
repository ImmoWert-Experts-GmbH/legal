{{-- Notansicht ohne Portal-Layout. Wird nur benutzt, solange
     resources/views/legal/datenschutz.blade.php im Portal fehlt.
     Publizieren mit: php artisan vendor:publish --tag=immowert-legal-views --}}
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,follow">
    <title>Datenschutzerklärung</title>
    <style>
        body { font: 16px/1.6 system-ui, sans-serif; max-width: 46rem; margin: 0 auto; padding: 2rem 1rem; }
        h1 { font-size: 1.8rem; } h2 { font-size: 1.25rem; margin-top: 2rem; } h3 { font-size: 1rem; }
    </style>
</head>
<body>
    <h1>Datenschutzerklärung</h1>
    <x-legal::datenschutz />
</body>
</html>
