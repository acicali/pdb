<div id='login'>
    <h2 class='heading'>Welcome to pdb</h2>
<?php if(Driver::server_available(Configs::get('host'))): ?>
    <form action='/?route=login' method='post'>
        <fieldset>
            <legend><?php echo Driver::name(); ?> Log In</legend>
            <input type='text' name='user' autofocus/>
            <input type='password' name='pass'/>
            <input type='submit' name='credentials' value='Go'/>
        </fieldset>
    </form>
<?php else: ?>
    <fieldset>
        <div class='error'>No <?php echo Driver::name(); ?> server available</div>
    </fieldset>
<?php endif; ?>
</div>
