$('body')
    .on('click', '[confirm]', function(e){
        var message = $(this).attr('confirm').replace(/\\n/g, "\n");
        if(! confirm(message)){
            e.preventDefault();
            return false;
        }
    });
