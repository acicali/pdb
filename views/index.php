<!doctype html>
<html>
<head>
    <title>pdb / <?php echo Configs::get('host'); ?><?php if(Params::get('database')): ?> / <?php echo Params::get('database'); ?><?php endif; ?></title>
    <link rel='stylesheet' type='text/css' href='/assets/css/styles.css'/>
    <link rel='stylesheet' type='text/css' href='/assets/css/themes/<?php echo Configs::get('theme') ? Configs::get('theme') : 'default' ?>.css'/>
    <link rel='stylesheet' type='text/css' href='/assets/css/font-awesome.min.css'/>
</head>
<body>
    <div id='left'>
        <a href='/' id='logo'>pdb</a>
        <?php View::position('left'); ?>
    </div>
    <div id='right'>
        <?php View::position('right'); ?>
    </div>
    <script src='/assets/js/jquery.min.js'></script>
    <script src='/assets/js/selectable.js'></script>
    <script src='/assets/js/search.js'></script>
    <script src='/assets/js/confirm.js'></script>
</body>
</html>
