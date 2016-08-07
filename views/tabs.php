<?php

$tabs = array(
    'results'        => array(
        'hide'          => ! Params::get('table'),
        'name'          => 'Browse',
        'icon'          => 'list'
    ),
    'structure'     => array(
        'icon'          => 'database'
    ),
    'query'         => array(
        'name'          => 'SQL',
        'icon'          => 'pencil-square-o'
    ),
    'search'        => array(
        'icon'          => 'search'
    ),
    'insert'        => array(
        'icon'          => 'terminal'
    ),
    'export'        => array(
        'icon'          => 'download'
    ),
    'import'        => array(
        'icon'          => 'upload'
    ),
    'operations'    => array(
        'icon'          => 'wrench'
    ),
    'privileges'    => array(
        'icon'          => 'user'
    ),
    'empty'         => array(
        'hide'          => ! Params::get('table'),
        'class'         => 'danger',
        'icon'          => 'trash'
    ),
    'drop'          => array(
        'class'         => 'danger',
        'icon'          => 'times'
    )
);





// remove hidden tabs
$tabs = array_filter($tabs, function($tab){
    return empty($tab['hide']);
});





// add the active class to current route
$route = Route::get();
if(isset($tabs[$route])){
    $tabs[$route]['class'] = ! empty($tabs[$route]['class'])
        ? 'active '.$tabs[$route]['class']
        : 'active';
}





// iterate and display ?>
<ul id='tabs'>
<!--
    <li class='tab home'>
        <a href='/'><i class='fa fa-2x fa-home icon'></i></a>
    </li>
-->
    <?php foreach($tabs as $route => $options): ?>
    <li class='tab<?php if(! empty($options['class'])): ?> <?php echo $options['class']; ?><?php endif; ?>'>
        <a href='<?php echo Params::with('route', $route)->toString(); ?>'>
            <?php if(! empty($options['icon'])): ?>
            <i class='fa fa-<?php echo $options['icon']; ?> icon'></i>
            <?php endif; ?>
            <?php echo empty($options['name']) ? ucwords($route) : $options['name']; ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
