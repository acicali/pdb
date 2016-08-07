<?php if(! empty($schema['columns'])): ?>
<table>
    <tr>
        <th></th>
        <th>Field</th>
        <th>Type</th>
        <th>Collation</th>
        <th>Attributes</th>
        <th>Null</th>
        <th>Default</th>
        <th>Extra</th>
        <th colspan='7'>Actions</th>
    </tr>
    <?php foreach($schema['columns'] as $column): ?>
    <tr class='column selectable'>
        <td><input type='checkbox'/></td>
        <td class='bold'><?php echo $column['field']; ?></td>
        <td><?php echo $column['type']; ?></td>
        <td><?php echo $column['collation']; ?></td>
        <td><small><?php echo $column['attributes']; ?></small></td>
        <td><?php echo $column['null'] ? 'Yes' : 'No'; ?></td>
        <?php if(is_null($column['default'])): ?>
        <td><em><?php echo $column['null'] ? 'NULL' : 'None'; ?></em></td>
        <?php else: ?>
        <td><?php echo $column['default']; ?></td>
        <?php endif; ?>
        <td><?php echo $column['extra']; ?></td>
        <td><a href='#' title='Browse distinct values'><i class='fa fa-list icon-browse'></i></a></td>
        <td><a href='#' title='Change'><i class='fa fa-pencil icon-edit'></i></a></td>
        <td><a href='#' title='Drop'><i class='fa fa-times icon-delete'></i></a></td>
        <td><a href='#' title='Primary'><i class='fa fa-key icon-primary'></i></a></td>
        <td><a href='#' title='Unique'><i class='fa fa-magnet icon-unique'></i></a></td>
        <td><a href='#' title='Index'><i class='fa fa-bolt icon-index'></i></a></td>
        <td><a href='#' title='Fulltext'><i class='fa fa-file-text icon-fulltext'></i></a></td>
    </tr>
    <?php endforeach; ?>
    <tr class='transparent'>
        <td style='text-align: center;'><i class='fa fa-level-up fa-flip-horizontal'></i></td>
        <td colspan='10000000'>
            <span class='link' select-rows='true'>Check All</span> /
            <span class='link' select-rows='false'>Uncheck All</span>
            <em>With selected:</em>
            <a href='#' title='Browse'><i class='fa fa-list icon-browse'></i></a>
            <a href='#' title='Change'><i class='fa fa-pencil icon-edit'></i></a>
            <a href='#' title='Drop'><i class='fa fa-times icon-delete'></i></a>
            <a href='#' title='Primary'><i class='fa fa-key icon-primary'></i></a>
            <a href='#' title='Unique'><i class='fa fa-magnet icon-unique'></i></a>
            <a href='#' title='Index'><i class='fa fa-bolt icon-index'></i></a>
            <a href='#' title='Fulltext'><i class='fa fa-file-text icon-fulltext'></i></a>
        </td>
    </tr>
</table>
<?php endif; ?>
