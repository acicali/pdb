$('body')
    .on('click', '.selectable', function(e){
        var $selectable = $(this);
        var $checkbox = $selectable.find('input').filter(':checkbox');
        var $clicked = $(e.target);

        if(! ($clicked.is($checkbox) || $clicked.is('.no-select'))){
            $checkbox.trigger('click');
        }

        $selectable.toggleClass('selected', $checkbox.is(':checked'));
    })
    .on('click', '[select-rows]', function(){
        var $clicked = $(this);
        var $selectable = $clicked.closest('table').find('.selectable');
        var $checkboxes = $selectable.find('input').filter(':checkbox');
        var checked = $clicked.attr('select-rows').toLowerCase() === 'true';

        $selectable.toggleClass('selected', checked);
        $checkboxes.prop('checked', checked);
    });
