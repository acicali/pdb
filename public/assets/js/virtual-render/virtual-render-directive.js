angular
.module('VirtualRender')
.directive('virtualRender',
function(){

    function toFixedWidth(applyMargin){
        var $this = $(this);
        $this.css('width', $this.outerWidth());

        if(applyMargin){
            var border = parseInt($this.css('border-spacing'));
            $this
                .css({
                    marginTop: border * -1,
                    marginLeft: border * -1
                });
        }
    }

    return {
        link: function($scope, element, attrs){
            var $head = element.find('thead');
            var $headings = $head.find('th');
            var $body = element.find('tbody');
            var $columns = $body.find('tr').eq(0).find('td');

            toFixedWidth.call($head, true);
            toFixedWidth.call($body, true);

            $headings.each(toFixedWidth);
            $columns.each(toFixedWidth);

            element.addClass('fixed')
        }
    }
});
