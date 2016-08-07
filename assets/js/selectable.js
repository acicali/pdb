$('body')
    .on('click', '.selectable', function(e){
        var $selectable = $(this);
        var $checkbox = $selectable.find('input').filter(':checkbox');

        if(! $checkbox.is(e.target)){
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
