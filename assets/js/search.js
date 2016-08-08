var query = {
        select: '*',
        from: $('[from]').attr('from'),
        where: []
};
var $query = $('#query');
var $selected = $('#selected-fields')
var $search = $('#search')
    .on('change', ':checkbox', function(){
        var select = [];
        var $checked = $search.find(':checkbox').filter(':checked');

        $checked
            .each(function(index){
                select.push('`' + $checked.eq(index).val() + '`');
            });

        select = select.length
            ? select.join(', ')
            : '*';

        query.select = select;
        $selected.text(select);
        $query.val(renderQuery());
    });

function renderQuery(){
    return [
        'SELECT ',
        query.select,
        ' FROM `',
        query.from,
        '` '
    ].join('');
}
