<?php if(! empty($results)): ?>
<table>
    <?php if(! empty($columns)): ?>
    <tr class='columns'>
        <th colspan='3'></th>
        <?php foreach($columns as $column): ?>
        <th>
            <a href='<?php echo Params::with('order', $column['field'])->toString(); ?>'><?php echo $column['field']; ?></a>
        </th>
        <?php endforeach; ?>
    </tr>
<?php endif; ?>
    <?php foreach($results as $row): ?>
    <tr class='selectable'>
        <td><input type='checkbox'/></td>
        <td><i class='fa fa-pencil icon-edit'></i></td>
        <td><i class='fa fa-times icon-delete'></i></td>
        <?php foreach($row as $value): ?>
        <td><?php echo $value; ?></td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
    <tr class='transparent'>
        <td style='text-align: center;'><i class='fa fa-level-up fa-flip-horizontal'></i></td>
        <td colspan='10000000'>
            <span class='link' select-rows='true'>Check All</span> /
            <span class='link' select-rows='false'>Uncheck All</span>
            <em>With selected:</em>
            <a href='#' title='Change'><i class='fa fa-pencil icon-edit'></i></a>
            <a href='#' title='Delete'><i class='fa fa-times icon-delete'></i></a>
            <a href='#' title='Export'><i class='fa fa-download icon-export'></i></a>
        </td>
    </tr>
</table>
<?php endif; ?>
