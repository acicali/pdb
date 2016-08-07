<!doctype html>
<html>
<head>
    <title>pdb / <?php echo $host; ?><?php if(! empty($schema['database'])): ?> / <?php echo $schema['database']; ?><?php endif; ?></title>
    <link rel='stylesheet' type='text/css' href='/assets/css/styles.css'/>
    <?php if(! empty($theme)): ?><link rel='stylesheet' type='text/css' href='/assets/css/themes/<?php echo $theme; ?>.css'/><?php endif; ?>
    <link rel='stylesheet' type='text/css' href='/assets/css/font-awesome.min.css'/>
</head>
<body>
    <div id='left'>
        <a href='/' id='logo'>pdb</a>
        <?php View::show('left', $schema); ?>
    </div>
    <div id='right'>
        <?php View::show('breadcrumbs'); ?>
        <?php View::show('tabs'); ?>
        <?php View::show(Route::get(), array('schema' => $schema)); ?>
    </div>
    <script src='/assets/js/jquery.min.js'></script>
    <script src='/assets/js/selectable.js'></script>
</body>
</html>
