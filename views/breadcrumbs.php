<ul id='breadcrumbs'>


<!-- the server / host -->
<?php if(Configs::get('host')): ?>
    <li>
        <i class='fa fa-server icon-server'></i>
        <a href='<?php echo Params::without('database')->without('table')->toString(); ?>'>
            <?php echo Configs::get('host'); ?>
        </a>
    </li>
<?php endif; ?>



<!-- the selected database -->
<?php if(Params::get('database')): ?>
    <li>
        <i class='fa fa-chevron-right icon-breadcrumb-arrow'></i>
    </li>
    <li>
        <i class='fa fa-database icon-database'></i>
        <a href='<?php echo Params::without('table')->toString(); ?>'>
            <?php echo Params::get('database'); ?>
        </a>
    </li>
<?php endif; ?>



<!-- the selected table -->
<?php if(Params::get('table')): ?>
    <li>
        <i class='fa fa-chevron-right icon-breadcrumb-arrow'></i>
    </li>
    <li>
        <i class='fa fa-table icon-table'></i>
        <a href='<?php echo Params::without('route')->toString(); ?>'>
            <?php echo Params::get('table'); ?>
        </a>
    </li>
<?php endif; ?>


</ul>
