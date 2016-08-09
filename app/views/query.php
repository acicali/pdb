<form action='<?php echo Params::toString(); ?>' method='post'>
    <fieldset>
        <?php if(empty($schema['database'])): ?>
        <legend>Run a query on server "<?php echo Configs::get('host'); ?>":</legend>
        <?php else :?>
        <legend>Run a query on database <a href='/?database=<?php echo $schema['database']; ?>'><?php echo $schema['database']; ?></a>:</legend>
        <?php endif; ?>
        <textarea id='query-textarea' name='query'></textarea>
    </fieldset>
    <fieldset class='footer'>
        <input type='submit' value='Go'/>
    </fieldset>
</form>
