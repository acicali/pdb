<div id='search'>
    <?php if(empty($database) OR empty($table)): ?>
    <div class='error'>No database and table selected</div>
    <?php else :?>
    <?php
        $action = Params
            ::only('database', 'table')
            ->with('route', 'query')
            ->toString();
    ?>
    <form action='<?php echo $action; ?>' method='post'>
        <fieldset>
            <legend>Run a query on server "<?php echo Configs::get('host'); ?>"</legend>
            <table class='striped'>
                <tr>
                    <th></th>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Operator</th>
                    <th>Value</th>
                    <th>JOIN</th>
                    <th>ON</th>
                </tr>
            <?php foreach($table->columns() as $column): ?>
                <tr class='selectable searchable-column'>
                    <td><input type='checkbox' name='select[]' value='<?php echo $column['field']; ?>'/></td>
                    <td class='bold'><?php echo $column['field']; ?></td>
                    <td><?php echo $column['type']; ?></td>
                    <td>
                        <select name='operator[]' role='operator' class='no-select'>
                            <option value='= "{{value}}"'>=</option>
                            <option value='> "{{value}}"'>&gt;</option>
                            <option value='>= "{{value}}"'>&gt;=</option>
                            <option value='< "{{value}}"'>&lt;</option>
                            <option value='<= "{{value}}"'>&lt;=</option>
                            <option value='!= "{{value}}"'>!=</option>
                            <option value='= ""'>= ''</option>
                            <option value='!= ""'>!= ''</option>
                            <option value='REGEXP "{{value}}"'>REGEXP</option>
                            <option value='NOT REGEXP "{{value}}"'>NOT REGEXP</option>
                            <option value='LIKE "{{value}}"'>LIKE</option>
                            <option value='LIKE "%{{value}}%"'>LIKE %...%</option>
                            <option value='NOT LIKE "{{value}}"'>NOT LIKE</option>
                            <option value='IS NULL'>IS NULL</option>
                            <option value='IS NOT NULL'>IS NOT NULL</option>
                        </select>
                    </td>
                    <td>
                        <input
                            name='<?php echo $column['field']; ?>'
                            role='value'
                            autocomplete='off'
                            class='no-select'/>
                    </td>
                    <td>
                        <select role='join-type' class='no-select'>
                            <option>LEFT</option>
                            <option>RIGHT</option>
                            <option>INNER</option>
                            <option>FULL OUTER</option>
                        </select>
                        <select role='join' class='no-select'>
                            <option></option>
                        <?php foreach($database->tables() as $joinable): ?>
                            <?php
                                if($joinable->name == $table->name){
                                    continue;
                                }
                                $joinable_columns = array();
                                foreach($joinable->columns() as $joinable_column){
                                    $joinable_columns[] = $joinable_column['field'];
                                }
                                $joinable_columns = implode(',', $joinable_columns);
                            ?>
                            <option
                                value='<?php echo $joinable->name; ?>'
                                columns='<?php echo $joinable_columns; ?>'>
                                <?php echo $joinable->name; ?>
                            </option>
                        <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <select role='join-on' class='no-select'></select>
                    </td>
                </tr>
            <?php endforeach; ?>
                <tr>
                    <td colspan='7'>
                        <textarea name='query' id='query' from='<?php echo Params::get('table'); ?>'></textarea>
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset class='footer'>
            <input type='submit' value='Go'/>
        </fieldset>
    </form>
    <?php endif; ?>
</div>
<!--
<div class='venn-diagram'>
    <div class='circle left-circle'></div>
    <div class='circle right-circle'>
        <div class='circle center-circle'></div>
    </div>
</div>
<style>
.venn-diagram {
    position: relative;
    float: left;
    width: 120px;
    height: 120px;
    margin: 5px 5px 0 0;
}

.circle {
    position: absolute;
    top: 0;
    left: 0;
    width: 75%;
    height: 75%;
    overflow: hidden;
    background: #FFF;
    border-radius: 500px;
    box-shadow: 0 0 0 1px #000;
}

.circle:hover {
    background: #000;
}

.right-circle {
    margin-left: 50%;
}

.center-circle {
    width: 100%;
    height: 100%;
    margin-left: -66.6666666%;
}
</style>
-->
