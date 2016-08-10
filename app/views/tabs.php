<?php

$tabs = array(
    'browse'        => array(
        'name'          => 'Browse',
        'hide'          => ! Params::get('table'),
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
        'hide'          => ! Params::get('table'),
        'icon'          => 'search'
    ),
    'insert'        => array(
        'hide'          => ! Params::get('table'),
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
        'icon'          => 'trash',
        'attrs'         => array(
            'confirm'       => 'Are you sure you want to:\nTRUNCATE TABLE `'.Params::get('table').'` ?'
        )
    ),
    'drop'          => array(
        'class'         => 'danger',
        'icon'          => 'times',
        'attrs'         => array(
            'confirm'       => Params::get('table')
                ? 'Are you sure you want to:\nDROP TABLE `'.Params::get('table').'` ?'
                : 'You are about to DESTROY a complete database!\n\nAre you sure you want to:\nDROP DATABASE `'.Params::get('database').'` ?'
        )
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

    <?php

    $href = Params::with('route', $route)
                ->without('order', 'reverse', 'query')
                ->toString();

    $class = ! empty($options['class'])
        ? 'tab '.$options['class']
        : 'tab';

    $attrs = '';
    if(! empty($options['attrs'])){
        foreach($options['attrs'] as $attr => $value){
            $attrs .= ' '.$attr.'="'.$value.'"';
        }
    }
    ?>

    <li class='<?php echo $class; ?>'>
        <a href='<?php echo $href; ?>'<?php echo $attrs; ?>>
            <?php if(! empty($options['icon'])): ?>
            <i class='fa fa-<?php echo $options['icon']; ?> icon'></i>
            <?php endif; ?>
            <?php echo empty($options['name']) ? ucwords($route) : $options['name']; ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>
