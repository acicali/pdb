<div id='search'>
    <?php if(empty($database) OR empty($columns)): ?>
    <div class='error'>No database and table selected</div>
    <?php else :?>
        <fieldset>
            <legend>Do a "query by example" (wildcard: "%")</legend>
            <table class='striped'>
                <tr>
                    <th colspan='6' style='text-align: left;'>SELECT <span id='selected-fields'>*</span></th>
                </tr>
                <tr>
                    <th></th>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Collation</th>
                    <th>Operator</th>
                    <th>Value</th>
                </tr>
            <?php foreach($columns as $column): ?>
                <tr class='selectable'>
                    <td><input type='checkbox' name='select[]' value='<?php echo $column['field']; ?>'/></td>
                    <td class='bold'><?php echo $column['field']; ?></td>
                    <td><?php echo $column['type']; ?></td>
                    <td><?php echo $column['collation']; ?></td>
                    <td>
                        <select name='func[]' class='no-select'>
                            <option value='='>=</option>
                            <option value='>'>&gt;</option>
                            <option value='>='>&gt;=</option>
                            <option value='<'>&lt;</option>
                            <option value='<='>&lt;=</option>
                            <option value='!='>!=</option>
                            <option value='LIKE'>LIKE</option>
                            <option value='NOT LIKE'>NOT LIKE</option>
                            <option value='IS NULL'>IS NULL</option>
                            <option value='IS NOT NULL'>IS NOT NULL</option>
                        </select>
                    </td>
                    <td>
                        <input
                            name='<?php echo $column['field']; ?>'
                            autocomplete='off'
                            class='no-select'/>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
        </fieldset>
        <?php
        $action =
            Params::only('database', 'table')
                ->with('route', 'query')
                ->toString();
        ?>
        <form action='<?php echo $action; ?>' method='post'>
            <input type='hidden' name='query' id='query' from='<?php echo Params::get('table'); ?>'/>
            <input type='submit' value='Go'/>
        </form>
    <?php endif; ?>
</div>

<h1>Clauses not yet implemented</h1>
