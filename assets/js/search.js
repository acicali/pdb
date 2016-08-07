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

        $selected.text(select);
    });
