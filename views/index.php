<!doctype html>
<html>
<head>
    <title>pdb / <?php echo Configs::get('host'); ?><?php if(! empty($schema['database'])): ?> / <?php echo $schema['database']; ?><?php endif; ?></title>
    <link rel='stylesheet' type='text/css' href='/assets/css/styles.css'/>
    <link rel='stylesheet' type='text/css' href='/assets/css/themes/<?php echo Configs::get('theme') ? Configs::get('theme') : 'default' ?>.css'/>
    <link rel='stylesheet' type='text/css' href='/assets/css/font-awesome.min.css'/>
</head>
<body>
    <div id='left'>
        <a href='/' id='logo'>pdb</a>
        <?php View::render('left', $schema); ?>
    </div>
    <div id='right'>
        <?php View::render('breadcrumbs'); ?>
        <?php View::render('tabs'); ?>
        <?php View::render(Route::get(), array('schema' => $schema)); ?>
    </div>
    <script src='/assets/js/jquery.min.js'></script>
    <script src='/assets/js/selectable.js'></script>
    <script src='/assets/js/confirm.js'></script>
</body>
</html>
