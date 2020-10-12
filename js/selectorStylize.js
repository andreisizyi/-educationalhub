$(document).ready(function(){
	selectStylize('select');
});

function selectStylize(element) {
	if(!element){
		element = 'select';
	}
	$(element).each(function() {
		var $this = $(this),
			numberOfOptions = $(this).children('option').length;
		$this.addClass('select-hidden');
		$this.wrap('<div class="select"></div>');
		$this.after('<div class="select-inner"></div>');
		var $styledSelect = $this.next('div.select-inner');
		if($this.find('option:eq(0)').val() != $this.val()){
			$styledSelect.text($this.find('option:selected').text());
		} else{
			$styledSelect.text($this.children('option').eq(0).text());
			$this.find('option:eq(0)').attr('selected', true);
		}
		var $list = $('<ul />', {
			'class': 'select-list'
		}).insertAfter($styledSelect);
		for (var i = 0; i < numberOfOptions; i++) {
			if (!$(this).children('option').eq(i).attr('hidden')) {
				$('<li />', {
					text: $this.children('option').eq(i).text(),
					rel: $this.children('option').eq(i).val()
				}).appendTo($list);
			}
		}
		$list.addClass('hidden-list');
		var $listItems = $list.children('li');
		$styledSelect.click(function(e) {
			e.stopPropagation();
			$('div.select-inner.active').not(this).each(function() {
				$(this).removeClass('active').next('ul.select-list').addClass('hidden-list');
			});
			$(this).toggleClass('active').next('ul.select-list').toggleClass('hidden-list');
		});
		$listItems.click(function(e) {
			e.stopPropagation();
			$styledSelect.text($(this).text()).removeClass('active');
			$value = $(this).attr("rel");
			$this.val($value).change();
			$list.addClass('hidden-list');
		});
		$(document).click(function() {
			$styledSelect.removeClass('active');
			$list.addClass('hidden-list');
		});
	});
}

	