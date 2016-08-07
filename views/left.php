<!-- Show selected database and its tables -->
<?php if(! empty($database)): ?>
    <div class='database selected'>
        <a href='<?php echo Params::with('database', $database)->without('table')->toString(); ?>'>
            <span class='name'><?php echo $database; ?></span>
            <?php if(! empty($tables)): ?>
            <span class='count'>(<?php echo count($tables); ?>)</span>
            <?php endif; ?>
        </a>
    </div>
    <?php if(! empty($tables)): ?>
    <ul class='tables'>
        <?php foreach($tables as $table): ?>
        <li class='table'>
            <a href='<?php echo Params::with('table', $table['name'])->toString(); ?>'>
                <?php echo $table['name']; ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
<?php endif; ?>



<!-- List all databases -->
<?php if(! empty($databases)): ?>
<ul>
    <?php foreach($databases as $database): ?>
    <li class='database'>
        <a href='<?php echo Params::with('database', $database)->toString(); ?>'>
            <?php echo $database; ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
