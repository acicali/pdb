var $search = $('#search');
var $columns = $search.find('.searchable-column');
var $query = $('#query').val(renderQuery());

$search
    .on('change keyup', 'input, select', function(){
        populateOnClauses();
        $query.val(renderQuery());
    });

function renderSelect(){
    var table = getTableName();
    var select = [];
    var $checked = $search.find(':checkbox').filter(':checked');
    $checked
        .each(function(index){
            select.push('\n`' + table + '`.`' + $checked.eq(index).val() + '`');
        });
    return select.length
        ? select.join(',')
        : ' *';
}

function getTableName(){
    return $('[from]').attr('from');
}

function renderJoins(){
    var joins = [];
    var table = getTableName();
    $columns.each(function(index){
        var $column = $columns.eq(index);
        var type = $column.find('[role=join-type]').val();
        var join = $column.find('[role=join]').val()
        var on = $column.find('[role=join-on]').val();
        if(join.length && on){
            var column = $column.find('[role=value]').attr('name');
            joins.push(
                '\n' + type + ' JOIN `' +
                join +
                '`\n\tON `' + join + '`.`' + on +
                '` = `' + table + '`.`' + column + '`'
            );
        }
    });
    return joins;
}

function renderWhere(){
    var where = [];
    $columns.each(function(index){
        var $column = $columns.eq(index);
        var $value = $column.find('[role=value]');
        var operator = $column.find('[role=operator]').val();
        var field = '`' + $value.attr('name') + '` ';
        var value = $value.val();
        if(operator.indexOf('{{value}}') === false){
            where.push(field + operator);
        }
        else if(value.length){
            where.push(field + operator.replace('{{value}}', value));
        }
    });
    return where.length
        ? where.join(' AND ')
        : 1;
}

function renderQuery(){
    populateOnClauses();
    var table = getTableName();
    return [
        'SELECT', renderSelect(),
        '\nFROM `', table, '`',
        renderJoins(),
        '\nWHERE ', renderWhere()
    ].join('');
}

function populateOnClauses(){
    $columns.each(function(index){
        var $column = $columns.eq(index);
        var columns = $column
                .find('[role=join]')
                .find('option:selected')
                .attr('columns') || '';
        $column
            .find('[role=join-on]')
            .html(
                '<option>' +
                columns
                    .split(',')
                    .join('</option><option>') +
                '</option>'
            );

    });
}
