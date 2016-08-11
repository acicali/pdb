<div id='login'>
    <i class='fa fa-5x fa-coffee logo'></i>
    <h2 class='heading'>Welcome to pdb</h2>
<?php if(Driver::server_available(Configs::get('host'))): ?>
    <form action='/?route=login' method='post'>
        <fieldset>
            <legend><?php echo Driver::name(); ?> Log In</legend>
            <table>
                <tr>
                    <td class='bold'>Username:</td>
                    <td><input type='text' name='user' autofocus autocomplete='off'/></td>
                </tr>
                <tr>
                    <td class='bold'>Password:</td>
                    <td><input type='password' name='pass'/></td>
                </tr>
            </table>
            <input type='submit' name='credentials' value='Go'/>
        </fieldset>
    </form>
<?php else: ?>
    <fieldset>
        <div class='error'>No <?php echo Driver::name(); ?> server available</div>
    </fieldset>
<?php endif; ?>
</div>
