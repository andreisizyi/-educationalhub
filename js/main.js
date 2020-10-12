window.onload = function(){

	var inputLabel = document.querySelectorAll('.label-text .input-text');

	inputLabel.forEach((inputText) => {
		setActiveInput(inputText);
		inputText.onblur = function() {
			setActiveInput(this);
		}
	});
	/*
	* define whether input is empty or not
	* inputText example - document.querySelectorAll('.label-text .input-text')[0];
	*/
	function setActiveInput(inputText){
		if(inputText.value.length != 0){
			inputText.classList.add('active');
		} else {
			inputText.classList.remove('active');
		}
	}


	var inputTextarea = document.querySelectorAll('.label-text .input-textarea');

	inputTextarea.forEach((inputTextarea) => {
		var defaultHeight = inputTextarea.offsetHeight;
	    elasticElement(inputTextarea, defaultHeight);
	    inputTextarea.addEventListener("input", () => {
	        elasticElement(inputTextarea, defaultHeight);
	    }, false);
	});

	/*
	* add rows in textarea, when user adding text
	* inputTextarea example - document.querySelectorAll('.label-text .input-textarea')[0]
	* defaultHeight - float number in px 
	*/
	function elasticElement(inputTextarea, defaultHeight) {
		inputTextarea.style.height = defaultHeight + "px";
		inputTextarea.style.height = (inputTextarea.scrollHeight + 5) + "px";
	};


	if(!element){
		var element = document.querySelectorAll('select');
	}

	element.forEach((element, index) => {
		var numberOfOptions = element.querySelectorAll("option").length;
		var elementWrap = document.createElement('div');
		element.innerHTML = elementWrap;
	});


	/*
	* open menu
	*/
	var btnMenu = document.getElementById('btn-menu');
	var header = document.getElementById('header');
	var breadcrumbs = document.getElementById('breadcrumbs');
	if (btnMenu != null) {
		btnMenu.addEventListener('click', () => {
			header.classList.toggle('menu-open');
			if (breadcrumbs != null) {
				breadcrumbs.classList.toggle('hidden');
			}
		});
	};



	/*
	* draw line in persentage progress in course page
	*/

	var RADIUS = 54;
	var CIRCUMFERENCE = 2 * Math.PI * RADIUS;

	function progress(progressValue, value) {
		var progress = value / 100;
		var dashoffset = CIRCUMFERENCE * (1 - progress);
		
		progressValue.style.strokeDashoffset = dashoffset;

	}

	var progressBlock = document.querySelectorAll('.progress-icon');
	progressBlock.forEach((element) => {
		var progressValue = element.querySelectorAll('.progress-text');
		var progressStroke = element.querySelectorAll('.progress__value');
		var progressPercentage = progressValue[0].outerText.replace(/[^-0-9]/gim,'');

		progressStroke[0].style.strokeDasharray = CIRCUMFERENCE;

		progress(progressStroke[0], progressPercentage);
	});


	/*
	* expand button in module page, shows description in title block
	*/
	var expandButton = document.getElementsByClassName('btn-expand');
	var expandArea = document.querySelectorAll('.btn-expand + .expanded-desc');



	 Array.from(expandButton).forEach((item) => {
		item.addEventListener('click', function(){
			this.classList.toggle('active');
		});
	});	



	var player;
	player = new YT.Player('video', {
		events: {
			'onReady': onPlayerStateChange,
           	'onStateChange': onPlayerStateChange
       }
    });
    
    /*
    * yotube change state, when video was watched
    */
    function onPlayerStateChange(event) {
       if(event.data === 0 && '1'){
			closeVideoBlock(currentPlay);
			playBlock[0].classList.add('watched-video');
		}
	}
	

	/*
	* open full screen modal video
	*/
	var body = document.body || document.getElementsByTagName('body')[0];
	var playBlock = document.querySelectorAll('.open-video');
	var currentPlay;
	var videoModalItem;

	playBlock.forEach((playBlockItem) =>{

		videoModalItem = playBlockItem.getElementsByClassName('video-modal')[0];
		var videoRect = playBlockItem.getBoundingClientRect();
		var playWidth = playBlockItem.offsetWidth;
		var playHeight = playBlockItem.offsetHeight;
		videoModalItem.style.width = playWidth +'px';
		videoModalItem.style.height = playHeight+'px';

		var windowWidth = window.innerWidth;
		var windowHeight = window.innerHeight;


		playBlockItem.addEventListener('click', function(e){
			var target = e.target;
			currentPlay = this;
			var closeVideo = this.getElementsByClassName('btn-close')[0];
			var passTest = this.getElementsByClassName('pass-test')[0];
			var passTestTarget = target == passTest || passTest.contains(target);
			var closeBlock = target == closeVideo || closeVideo.contains(target);
			if(!closeBlock && !passTestTarget){
				body.classList.add('body-overflow');
				this.classList.add('before-show-video');
				setTimeout(() =>{
					this.classList.add('show-video');

					var videoWrap = document.getElementById('video-wrap');
					videoWrap.style.paddingTop = windowHeight/windowWidth*100+'%';

					player.playVideo();
				}, 1000);
			}

			closeVideo.addEventListener('click', function(){
				player.pauseVideo();
				closeVideoBlock(currentPlay);
			});
			
		});
	});

	/*
	* close video modal
	* currentPlay example -  playBlockItem.getElementsByClassName('video-modal')[0];
	*/
	function closeVideoBlock(currentPlay){
		body.classList.remove('body-overflow');
		currentPlay.classList.remove('before-show-video');
		currentPlay.classList.remove('show-video');
	}


	/*
	*sticky menu anchors
	*/
	var stickyMenuItem = document.querySelectorAll('.sticky-menu-list li');
	
	stickyMenuItem.forEach(function(item){
		item.addEventListener('click', function(){
			stickyMenuItem.forEach(function(item){
				item.classList.remove('active');
			});
			this.classList.add('active');

		});
	});



	/*
	*datepicker shows calendar
	*/
	var picker = Array();

	var datepicker = document.getElementsByClassName('datepicker');

	Array.from(datepicker).forEach(function(item, i){
		picker[i] = new Pikaday({
       		field: item,
       		format: 'DD.MM.YYYY',
			firstDay: 1,
			yearRange: [1900,2019],
       		i18n: {
				months        : ['Січень','Лютий','Березень','Квітень','Травень','Червень','Липень','Серпень','Вересень','Жовтень','Листопад','Грудень'],
				weekdays      : ['Неділя', 'Понеділок','Вівторок','Середа','Четвер',"П'ятниця",'Субота'],
				weekdaysShort : ['Нд','Пн','Вт','Ср','Чт','Пт','Сб']
			},
    	});
	});



	/*
	* open filters
	*/
	var btnFilter = document.getElementsByClassName('btn-filter');
	var filter = document.getElementById('filter');
	var btnFilterClose = document.getElementById('btn-filter-close');

	
	if(filter){
		Array.from(btnFilter).forEach(function(btnFilterItem){
			btnFilterItem.addEventListener('click', function(){
				filter.classList.add('filter-open');
				body.classList.add('body-overflow');
			});
		});


		btnFilterClose.addEventListener('click', function(){
			filter.classList.remove('filter-open');
			body.classList.remove('body-overflow');
		});

	}
	
	/*
	* tab in filters
	*/
	var tabButtons = document.querySelectorAll('.filter-types li a');
	var tabMatch = document.querySelectorAll('.filters-array');
	Array.from(tabButtons).forEach(function(tabButtonItem){
		tabButtonItem.addEventListener('click', function(e){
			e.preventDefault();
			Array.from(tabButtons).forEach(function(tabButtonItem){
				tabButtonItem.classList.remove('choosed-filter-tab');
			});
			this.classList.add('choosed-filter-tab');
		    var currentAttr = this.getAttribute('data-filter');
			Array.from(tabMatch).forEach(function(tabMatchItem){
				tabMatchItem.classList.remove('choosed-filter');
				var tabAttr = tabMatchItem.getAttribute('data-filter');
				console.log(tabMatchItem);
				if (currentAttr == tabAttr){
					tabMatchItem.classList.add('choosed-filter');
				}
			});
		});
	});


	/*
	* info click - open detail info clicking in info icon
	*/
	var infoLabel = document.getElementsByClassName('info-label');
	var infoHover = document.getElementsByClassName('info-hover');

	Array.from(infoLabel).forEach(function(infoLabelItem){
		infoLabelItem.addEventListener('click', function(){
			var dataInfo = infoLabelItem.getAttribute('data-info');
			Array.from(infoHover).forEach(function(infoHoverItem){
				var foundDataInfo = infoHoverItem.getAttribute('data-info');
				if(foundDataInfo == dataInfo){
					if(infoHoverItem.classList.contains('show-info-hover')){
						infoHoverItem.classList.remove('show-info-hover');
					} else {
						infoHoverItem.classList.add('show-info-hover');
					}
				}
			});
		});
	});


	



	/*
	* anchor menu smooth scroll
	*/
	var anchorlinks = document.querySelectorAll('a[href^="#"]');

	var anchorLength = anchorlinks.length;

	for(var i = 0; i < anchorLength; i++){
		anchorlinks[i].addEventListener('click', function(e) {
		    var hashval =  this.getAttribute('href');
		    var target = document.querySelector(hashval);
		    
		    target.scrollIntoView({ behavior: 'smooth' });

		    e.preventDefault();
		});
	}


	anchorDetect();

	window.addEventListener('scroll', function(){

		anchorDetect();

	});

	/*
	* in cv page shows in what anchor user located
	*/
	function anchorDetect(){  

		var scrollTop = window.pageYOffset;
		var links = document.querySelectorAll('.sticky-menu-list a');
		for(var i = 0; i < links.length; i++){
			var currentLink = links[i];
			var refEl = currentLink.getAttribute('href');
			var idEl = document.getElementById(refEl.slice(1));

			var idElTop = idEl.offsetTop;
			var idElHeight = idEl.offsetHeight;
			if(idElTop - idElHeight / 2 <= scrollTop && idElTop + idElHeight > scrollTop){
				for(var j = 0; j < links.length; j++){
					links[j].parentNode.classList.remove('active');
				}
				currentLink.parentNode.classList.add('active');
			}
		}
	}

}
