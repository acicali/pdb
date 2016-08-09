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
    <?php
        $href = Params
            ::only('database')
            ->with('database', $database->name)
            ->toString();
    ?>
    <a href='<?php echo $href; ?>'>
        <span class='name'><?php echo $database->name; ?></span>
        <span class='count'>(<?php echo count($database->tables()); ?>)</span>
    </a>
    <?php if(count($database->tables())): ?>
    <ul class='tables'>
        <?php foreach($database->tables() as $table): ?>
        <?php
            $href = Params
                ::only('database')
                ->with('table', $table->name)
                ->with('route', 'results')
                ->toString();
        ?>
        <li class='table'>
            <a href='<?php echo $href; ?>'>
                <?php echo $table->name; ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<?php endif; ?>
