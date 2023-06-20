<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="manifest" href="/build/manifest.webmanifest">
    <script src="/build/registerSW.js"></script>

    @routes
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @inertiaHead
</head>
<body>
@inertia

<div id="preloader-custom">
    <div class="spinner-custom"></div>
</div>
</body>
</html>
