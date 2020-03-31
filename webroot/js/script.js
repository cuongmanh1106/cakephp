var Book =  {
	exp: 'hello',

	init: function() {
		var self = this;
		self.searchBook();
	},

	searchBook: function() {
		$('#search-button').on('click',function(){
			var search = $('#search').val();
			$.ajax({
				type:'POST',
				data: {'search':search},
				url: $('#search_url').val(),
				success:function(data,status) {
					if(data.result.success) {
						
					}
				}
			})
		})
	}


}

$(document).ready(function() {
	Book.init();
})