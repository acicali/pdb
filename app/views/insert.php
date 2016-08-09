<div id='insert'>
    <?php if(empty($database) OR empty($table)): ?>
    <div class='error'>No database and table selected</div>
    <?php else :?>
    <?php
        $action = Params
            ::only('database', 'table')
            ->with('route', 'insert')
            ->toString();
    ?>
    <form action='<?php echo $action; ?>' method='post'>
        <fieldset>
            <table class='striped'>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Function</th>
                    <th>Null</th>
                    <th>Value</th>
                </tr>
            <?php foreach($table->columns() as $column): ?>
                <tr class='selectable'>
                    <td class='bold'><?php echo $column['field']; ?></td>
                    <td><?php echo $column['type']; ?></td>
                    <td>
                        <select name='function[]'>
                            <option></option>
                            <optgroup label='Date / Time Functions'>
                                <option>CURDATE</option>
                                <option>CURTIME</option>
                                <option>DATE</option>
                                <option>FROM_DAYS</option>
                                <option>FROM_UNIXTIME</option>
                                <option>NOW</option>
                                <option>SEC_TO_TIME</option>
                                <option>TIMESTAMP</option>
                                <option>UTC_DATE</option>
                                <option>UTC_TIME</option>
                                <option>UTC_TIMESTAMP</option>
                                <option>YEAR</option>
                            </optgroup>
                            <option>ABS</option>
                            <option>ACOS</option>
                            <option>ASCII</option>
                            <option>ASIN</option>
                            <option>ATAN</option>
                            <option>BIN</option>
                            <option>BIT_COUNT</option>
                            <option>BIT_LENGTH</option>
                            <option>CEILING</option>
                            <option>CHAR</option>
                            <option>CHAR_LENGTH</option>
                            <option>COMPRESS</option>
                            <option>COS</option>
                            <option>COT</option>
                            <option>CRC32</option>
                            <option>CURRENT_USER</option>
                            <option>DAYNAME</option>
                            <option>DEGREES</option>
                            <option>DES_DECRYPT</option>
                            <option>DES_ENCRYPT</option>
                            <option>ENCRYPT</option>
                            <option>EXP</option>
                            <option>FLOOR</option>
                            <option>HEX</option>
                            <option>INET_ATON</option>
                            <option>INET_NTOA</option>
                            <option>LENGTH</option>
                            <option>LN</option>
                            <option>LOG</option>
                            <option>LOG10</option>
                            <option>LOG2</option>
                            <option>LOWER</option>
                            <option>MD5</option>
                            <option>OCT</option>
                            <option>OLD_PASSWORD</option>
                            <option>ORD</option>
                            <option>PASSWORD</option>
                            <option>RADIANS</option>
                            <option>RAND</option>
                            <option>REVERSE</option>
                            <option>ROUND</option>
                            <option>SHA1</option>
                            <option>SOUNDEX</option>
                            <option>SPACE</option>
                            <option>SQRT</option>
                            <option>STDDEV_POP</option>
                            <option>STDDEV_SAMP</option>
                            <option>TAN</option>
                            <option>TIME_TO_SEC</option>
                            <option>UNCOMPRESS</option>
                            <option>UNHEX</option>
                            <option>UNIX_TIMESTAMP</option>
                            <option>UPPER</option>
                            <option>USER</option>
                            <option>UUID</option>
                            <option>VAR_POP</option>
                            <option>VAR_SAMP</option>
                        </select>
                    </td>
                    <td>
                        <?php if($column['null']): ?>
                        <input type='checkbox' name='null[]'/>
                        <?php endif; ?>
                    </td>
                    <td>
                        <input
                            name='fields[<?php echo $column['field']; ?>]'
                            autocomplete='off'/>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
        </fieldset>
        <fieldset class='footer'>
            <input type='submit' value='Go'/>
        </fieldset>
    </form>
    <?php endif; ?>
</div>

<h1><?php echo ucwords(Route::get()); ?> not yet implemented</h1>
