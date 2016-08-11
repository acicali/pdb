angular
.module('Grid')
.directive('grid', [
	'$window',
	'$timeout',
	'$compile',
	'lodash',
	'Grid',
function(
	$window,
	$timeout,
	$compile,
	lodash,
	Grid
){
	return {
		replace: true,
		transclude: true,
		templateUrl: 'grid.html',
		link: function(scope, element, attrs){

			var grid = Grid.get(attrs.from);

			if(! grid){
				throw new Error('No grid instance found for "' + attrs.from + '"');
			}

			(function init(){
				createHeadings();

				grid.dom.$table = element.find('.grid-table').removeAttr('ng-transclude');
				grid.dom.$scrollHeight = element.find('.scroll-height');
				grid.dom.$scrollable = element.find('.scrollable');
				grid.dom.$row = grid.dom.$table.find('row');

				grid.dom.$bufferTop = grid.dom.$row.clone().prependTo(grid.dom.$table).wrap('<div class="grid-buffer"></div>');
				grid.dom.$bufferBottom = grid.dom.$row.clone().appendTo(grid.dom.$table).wrap('<div class="grid-buffer"></div>');

				grid.dom.$row.attr('ng-repeat', 'row in rows track by $index');
				grid.dom.$bufferTop.attr('ng-repeat', 'row in bufferTop track by $index')
				grid.dom.$bufferBottom.attr('ng-repeat', 'row in bufferBottom track by $index')

				$compile(element)(scope);
				scope.offset = 0;
			})();

			function toFixedDimensions(){
				grid.limit = 30;
				grid.buffer = 0;
				grid.gridHeight = element.height();
				scope.rows = grid.rows.slice(grid.start, grid.start + grid.limit);
				$timeout(function(){
					setGridHeight();
					render();
					$timeout(function(){
						setColumnAndHeadingWidths();
					});
				});
			}

			function setGridHeight(){
				grid.rowHeight = grid.dom.$table.find('row').eq(0).height();
				grid.tableHeight = (grid.rowHeight || 0) * grid.rows.length;
				if(grid.rowHeight){
					grid.limit = Math.floor(grid.gridHeight / grid.rowHeight) + 2;
				}
				grid.dom.$scrollable.height(grid.tableHeight);
			}

			function setColumnAndHeadingWidths(){
				var $columns = element.find('row').eq(0).find('column').css('width', 'auto');
				var $headings = element.find('.grid-heading');
				var $buffers = [
					grid.dom.$bufferTop.eq(0).find('column').css('width', 'auto'),
					grid.dom.$bufferBottom.eq(0).find('column').css('width', 'auto')
				];

				$timeout(function(){
					$columns.each(function(index){
						var $column = $columns.eq(index);
						var width = $column.outerWidth();

						$column.css('width', width);
						$headings.eq(index).css('width', width);
						$buffers.forEach(function($bufferColumns){
							$bufferColumns.eq(index).css('width', width);
						});
					});
				});
			}

			function createHeadings(){
				var $columns = element.find('[heading]');
				var $headings = [];

				$columns
					.each(function(index){
						var $column = $columns.eq(index);
						var $heading = angular.element(
							'<div class="grid-heading">' +
								'<span class="label">' + $column.attr('heading') + '</span>' +
								'<i class="fa fa-caret-up icon sort-asc"></i>' +
								'<i class="fa fa-caret-down icon sort-desc"></i>' +
							'</div>'
						)
						.attr('sort', $column.attr('sort'))
						.addClass($column.attr('class'))

						if(grid.sortedBy == $column.attr('sort')){
							grid.sortReverse
								? $heading.addClass('reverse-sorted')
								: $heading.addClass('sorted');
						}

						$headings.push($heading);
						$column.removeAttr('heading sort');
					});

				grid.dom.$headings = element.find('.grid-headings').append($headings);

			}

			function render(){
				$timeout(function(){
					scope.rows = grid.rows.slice(grid.start, grid.start + grid.limit);
					var bufferTopStart = grid.start - grid.limit;
					if(bufferTopStart < 0){
						bufferTopStart = 0;
					}
					scope.bufferTop = grid.rows.slice(bufferTopStart, grid.start);
					scope.bufferBottom = grid.rows.slice(grid.start + grid.limit, grid.start + grid.limit + grid.limit);
				});
			}

			function setDimensionsAndStatus(){
				toFixedDimensions();
			}

			grid.dom.$scrollHeight
				.on('scroll', lodash.throttle(function(){
					var scrollTop = grid.dom.$scrollHeight.scrollTop();
					if(grid.rowHeight){
						grid.start = Math.floor(scrollTop / grid.rowHeight);
					}
					scope.offset = scrollTop - (scrollTop % grid.rowHeight);
					render();
				}, 10));

			angular
				.element($window)
				.on('resize', function(){
					setDimensionsAndStatus();
				});

			grid.dom.$headings
				.on('click', '[sort]', function(){
					var $clicked = angular.element(this);
					if(grid.sortedBy == $clicked.attr('sort')){
						grid.allRows.reverse();
						grid.sortReverse = ! grid.sortReverse;
					}
					else {
						grid.allRows.sort(function(a, b){
							if(a[$clicked.attr('sort')] == b[$clicked.attr('sort')]){
								return 0;
							}

							return a[$clicked.attr('sort')] > b[$clicked.attr('sort')]
								? -1
								: 1;
						});
					}
					grid.sortedBy = $clicked.attr('sort');
					grid.rows = grid.allRows;
					render();
				});

			grid
				.on('filter', function(filteredRows){
					grid.rows = filteredRows;
					setDimensionsAndStatus();
				})
				.on('unfilter', function(){
					grid.rows = grid.allRows.slice();
					setDimensionsAndStatus();
				})
				.collection
				.then(function(entities){
					grid.rows = entities;
					grid.allRows = entities.slice();
					setDimensionsAndStatus();
				});
		}
	};
}]);
