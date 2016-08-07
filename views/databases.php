<!-- List all databases -->
<?php if(empty($database)): ?>
<ul>
    <?php foreach($databases as $database): ?>
    <li class='database'>
        <a href='<?php echo Params::with('database', $database)->toString(); ?>'>
            <?php echo $database; ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>






<!-- Show selected database and its tables -->
<?php else: ?>
<div class='database selected'>
    <a href='<?php echo Params::with('database', $database)->without('table', 'order')->toString(); ?>'>
        <span class='name'><?php echo $database; ?></span>
        <?php if(! empty($tables)): ?>
        <span class='count'>(<?php echo count($tables); ?>)</span>
        <?php endif; ?>
    </a>
    <?php if(! empty($tables)): ?>
    <ul class='tables'>
        <?php foreach($tables as $table): ?>
        <li class='table'>
            <a href='<?php echo Params::with('table', $table['name'])->without('route', 'order')->toString(); ?>'>
                <?php echo $table['name']; ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<?php endif; ?>
