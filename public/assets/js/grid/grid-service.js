angular
.module('Grid')
.service('Grid',
function($q){

	var instances = {};

	function Grid(collection, name){

		var self = this;

		self.name = name;
		self.collection = collection;
		self.tableHeight = 0;
		self.gridHeight = 0;
		self.rowHeight = 0;
		self.headings = [];
		self.buffer = 0;
		self.limit = 30;
		self.start = 0;
		self.allRows = [];
		self.rows = [];
		self.dom = {};

		self.callbacks = {
			onfilter: [],
			onunfilter: []
		};

		self.on = function(event, callback){
			event = 'on' + event.toLowerCase();
			if(self.callbacks[event] && typeof callback === 'function'){
				self.callbacks[event].push(callback);
			}

			return self;
		};

		self.trigger = function(event){
			var args = Array.prototype.slice.call(arguments, 1);
			event = 'on' + event.toLowerCase();
			if(self.callbacks[event]){
				self.callbacks[event].forEach(function(callback){
					callback.apply(null, args);
				});
			}
		};

		self.filter = function(closure){
			var results = self.allRows.filter(closure);
			self.trigger('filter', results);
		};

		self.unfilter = function(){
			self.trigger('unfilter');
		};

	};

	function from(collection, name){
		return instances[name] = new Grid(collection, name);
	}

	function get(name){
		return instances[name];
	}

	return {
		from: from,
		get: get
	};
});
