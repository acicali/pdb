<?php if(! empty($table)): ?>
<table class='striped'>
    <?php foreach($table->columns() as $index => $column): ?>
    <?php if(! $index): ?>
        <tr>
            <th></th>
            <?php foreach(array_keys($column) as $key): ?>
            <th><?php echo ucwords($key); ?></th>
            <?php endforeach; ?>
            <th colspan='7'>Actions</th>
        </tr>
    <?php endif; ?>
    <tr class='column selectable'>
        <td><input type='checkbox'/></td>
        <?php foreach(array_values($column) as $index => $value): ?>
        <td<?php if(! $index): ?> class='bold'<?php endif; ?>><?php echo $value; ?></td>
        <?php endforeach; ?>
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
