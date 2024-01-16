<!doctype html>
<html lang="en-GB">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(setting('title')); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="icon shortcut" href="<?php echo e(asset('favicon.png')); ?>">
    <script>
        window.routes = <?php echo getRoutes(); ?>;
        window.settings = <?php echo getSettings(); ?>;
        window.user = <?php echo $user; ?>;
        window.currentUser = <?php echo $user; ?>;
        window.bad_words = <?php echo json_encode(explode(',', setting('banned_words'))); ?>

        window.free_release_limit = <?php echo config('app.free_release_limit'); ?>

        window.variables = {
            colors: {
                colorBlue: '#3300ff',
                colorBlue2: '#366efc',
                color2: '#9eefe1',
            },
            stripe_public: '<?php echo e(env('STRIPE_KEY')); ?>',
            music_keys: <?php echo json_encode(App\Phase\MusicKey::all()); ?>,
            release_classes: <?php echo json_encode(App\Phase\ReleaseClass::all()); ?>,
        };
    </script>
    <style>
        @font-face {
            font-family: "aquawax";
            src: url("font/Aquawax-Light.woff") format('woff');
        }
    </style>
</head>

<body>
    <div id="vue">
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ['Comfortaa:400,700', 'Montserrat:400,600']
            }
        });
    </script>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/app.js"></script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\phase\resources\views/vue.blade.php ENDPATH**/ ?>