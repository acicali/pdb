<!doctype html>
<html>
<head>
    <title>pdb / <?php echo Configs::get('host'); ?><?php if(Params::get('database')): ?> / <?php echo Params::get('database'); ?><?php endif; ?></title>
    <link rel='stylesheet' type='text/css' href='/assets/css/styles.css'/>
    <link rel='stylesheet' type='text/css' href='/assets/js/grid/grid.css'/>
    <link rel='stylesheet' type='text/css' href='/assets/css/themes/<?php echo Configs::get('theme') ? Configs::get('theme') : 'default' ?>.css'/>
    <link rel='stylesheet' type='text/css' href='/assets/css/font-awesome.min.css'/>
</head>
<body ng-app='pdb'>
    <?php if(! View::positionEmpty('left')): ?>
    <div id='left'>
        <a href='/' id='logo'>pdb</a>
        <?php View::position('left'); ?>
    </div>
    <?php endif; ?>
    <div id='main'>
        <?php View::position('main'); ?>
    </div>
    <script src='/assets/js/lodash.min.js'></script>
    <script src='/assets/js/jquery.min.js'></script>
    <script src='/assets/js/angular.min.js'></script>
    <script src='/assets/js/grid/grid.js'></script>
    <script src='/assets/js/grid/grid-directive.js'></script>
    <script src='/assets/js/grid/grid-service.js'></script>
    <script src='/assets/js/virtual-render/virtual-render.js'></script>
    <script src='/assets/js/virtual-render/virtual-render-directive.js'></script>
    <script src='/assets/js/results/results.js'></script>
    <script src='/assets/js/results/results-controller.js'></script>
    <script src='/assets/js/app.js'></script>
    <script src='/assets/js/selectable.js'></script>
    <script src='/assets/js/search.js'></script>
    <script src='/assets/js/confirm.js'></script>
    <script type='text/ng-template' id='grid.html'>
        <div class='grid'>
        	<div class='grid-headings'></div>
        	<div class='scroll-height'>
        		<div class='scrollable'></div>
        		<div class='grid-table' style='margin-top: {{offset}}px' ng-transclude></div>
        	</div>
        </div>
    </script>
</body>
</html>
