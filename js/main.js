(function($) {
	"use strict";
	$(document).ready(function() {
		/*  [ Menu Moblie ]
        - - - - - - - - - - - - - - - - - - - - */
		var toggles = document.querySelectorAll(".c-hamburger");
		  	for (var i = toggles.length - 1; i >= 0; i--) {
		    	var toggle = toggles[i];
		    toggleHandler(toggle);
		  	};
		function toggleHandler(toggle) {
		    toggle.addEventListener( "click", function(e) {
		    	e.preventDefault();
		    	(this.classList.contains("is-active") === true) ? this.classList.remove("is-active") : this.classList.add("is-active");
		    });
		}

		/*  [ Back Top ]
        - - - - - - - - - - - - - - - - - - - - */
		$('.back-top').on('click', function (e) {
	        e.preventDefault();
	        $('html,body').animate({
	            scrollTop: 0
	        }, 700);
	    });

	    /*  [ Staff Picks Slider ]
        - - - - - - - - - - - - - - - - - - - - */
	    $('.staff-picks-slider').owlCarousel({
			loop:true,
			autoplay:true,
			autoplayTimeout:3000,
   			autoplayHoverPause:true,
   			items: 1,
   			dots: false,
   			nav: true,
   			navText: ['<span class="ion-ios-arrow-back"></span>', '<span class="ion-ios-arrow-forward"></span>'],
		});

	    /*  [ Partners ]
        - - - - - - - - - - - - - - - - - - - - */
	    $('.partners-slider').owlCarousel({
			loop:true,
			autoplay:true,
			autoplayTimeout:3000,
   			autoplayHoverPause:true,
   			items: 6,
   			dots: false,
   			nav: false,
   			responsive:{
		        0:{
		            items:1,
		        },
		        360:{
		            items:2,
		        },
		        576:{
		            items:3,
		        },
		        992:{
		            items:6,
		        }
		    }
		});

	    /*  [ Story Slider ]
        - - - - - - - - - - - - - - - - - - - - */
        $('.story-slider').owlCarousel({
			loop:true,
			autoplay:true,
			autoplayTimeout:3000,
   			autoplayHoverPause:true,
   			items: 3,
   			margin: 30,
   			responsive:{
		        0:{
		            items:1,
		        },
		        450:{
		            items:2,
		        },
		        576:{
		            items:3,
		        }
		    }
		});

        /*  [ Featured Places Slider ]
        - - - - - - - - - - - - - - - - - - - - */
        $('.featured-places-slider').owlCarousel({
			loop:true,
			autoplay:true,
			autoplayTimeout:3000,
   			autoplayHoverPause:true,
   			margin: 30,
   			nav: true,
   			navText: ['<span class="ion-ios-arrow-back"></span>', '<span class="ion-ios-arrow-forward"></span>'],
   			responsive:{
		        0:{
		            items:1,
		        },
		        360:{
		            items:3,
		        },
		        576:{
		            items:4,
		        },
		        992:{
		            items:5,
		        },
		        1200:{
		            items:6,
		        }
		    }
		});

		/*  [ Owl Campaign ]
        - - - - - - - - - - - - - - - - - - - - */
		$("#owl-campaign").owlCarousel({
	        navigation: true,
	        navigationText: ['<span class="ion-ios-arrow-back"></span>', '<span class="ion-ios-arrow-forward"></span>'],
	        loop:true,
			autoplay:true,
			autoplayTimeout:3000,
   			autoplayHoverPause:true,
	        singleItem: true,
	        afterInit: makePages,
	        afterUpdate: makePages
	    });
	    function makePages() {
	        $.each(this.owl.userItems, function(i) {
	            $('.owl-controls .owl-page').eq(i)
	                .css({
	                    'background': 'url(' + $(this).find('img').attr('src') + ')',
	                    'background-size': 'cover',
	                })
	        });
	    };	

	    /*  [ Owl Shop ]
        - - - - - - - - - - - - - - - - - - - - */
		$("#owl-shop").owlCarousel({
	        navigation: true,
	        navigationText: ['<span class="ion-ios-arrow-back"></span>', '<span class="ion-ios-arrow-forward"></span>'],
	        loop:true,
			autoplay:true,
			autoplayTimeout:3000,
   			autoplayHoverPause:true,
	        singleItem: true,
	        afterInit: makePages,
	        afterUpdate: makePages
	    });
	    function makePages1() {
	        $.each(this.owl.userItems, function(i) {
	            $('.owl-controls .owl-page').eq(i)
	                .css({
	                    'background': 'url(' + $(this).find('img').attr('src') + ')',
	                    'background-size': 'cover',
	                })
	        });
	    };	

	    /*  [ Tab Controls ]
        - - - - - - - - - - - - - - - - - - - - */
	    $('.tabs-controls li').on('click', function (e){
	    	e.preventDefault();
			var tab_id = $(this).attr('data-tab');
			$('.tabs-controls li').removeClass('active');
			$('.campaign-content .tabs').removeClass('active');
			$(this).addClass('active');
			$("#"+tab_id).addClass('active');
		});

		/*  [ Menu Category ]
        - - - - - - - - - - - - - - - - - - - - */
		$('.menu-category li').on('click', function (){
			var tab_id = $(this).attr('data-hash');
			$('.menu-category li').removeClass('active');
			$(this).addClass('active');
		});

		/*  [ Project Love Slider ]
        - - - - - - - - - - - - - - - - - - - - */
	 	$('.project-love-slider').bxSlider({
		  	pagerCustom: '#bx-pager',
		  	mode: 'vertical',
		  	controls: false,
		});
	    /*  [ Search Form ]
        - - - - - - - - - - - - - - - - - - - - */
	    $('.search-icon a').on('click', function (e){
	    	e.preventDefault();
			$( this ).parent().find('.form-search').fadeToggle();
			$( this ).parent().find('#searchForm').fadeToggle();
		});

		$('.form-search').on('click', function (e){
	    	e.preventDefault();
			$( this ).fadeToggle();
			$( this ).parent().find('#searchForm').fadeToggle();
		});

		$(".raised > span").each(function() {
			$(this)
				.data("origWidth", $(this).width())
				.width(0)
				.animate({
					width: $(this).data("origWidth")
				}, 1200);
		});

		/*  [ Main Menu ]
        - - - - - - - - - - - - - - - - - - - - */
		$( '.c-hamburger' ).on( 'click', function() {
            $( this ).parents( '.main-menu' ).toggleClass('open');
            $( 'body' ).toggleClass( 'menu-open' );
        });
        $( 'html' ).on( 'click', function(e) {
            if( $( e.target ).closest( '.main-menu.open' ).length == 0 ) {
                $( '.main-menu' ).removeClass( 'open' );
                $( 'body' ).removeClass( 'menu-open' );
                $( '.c-hamburger' ).removeClass('is-active');
            }
        });

        /*  [ Popup ]
        - - - - - - - - - - - - - - - - - - - - */
		$( '.button-popup' ).on( 'click', function(e) {
			e.preventDefault();
            $( '.popup' ).addClass('open');
        });
        $( '.close' ).on( 'click', function() {
            $( '.popup' ).removeClass('open');
        });

        /*  [ Header Fixed ]
        - - - - - - - - - - - - - - - - - - - - */
        if ($(window).width()<992) {
	        $(window).scroll(function(){
	        	if($(this).scrollTop()>0){
					$('#header').addClass('fixed');
			    }else{
					$('#header').removeClass('fixed');
			    }
	        });

	        /*  [ Sub Menu ]
        	- - - - - - - - - - - - - - - - - - - - */
	        $( '.main-menu ul > li' ).on('click', function () {
				$( this ).find('.sub-menu').slideToggle();
			});
        }

	    /*  [ Faq ]
        - - - - - - - - - - - - - - - - - - - - */
        $('.faq-desc').hide();
        $('.list-faq li a').on('click', function(e){
        	e.preventDefault();
            $('.list-faq li a').not(this).next().slideUp().parent().removeClass('open');
            $(this).next().slideToggle().parent().addClass('open');
        });

		/*  [ jQuery Countdown ]
        - - - - - - - - - - - - - - - - - - - - */
        var endDate = 'November 15, 2018';
        $( '.time ul' ).countdown({
            date: endDate,
            render: function(data) {
                $(this.el).html(
                    '<li><div class="time-item"><p>' + this.leadingZeros(data.days, 2) + '</p><span>Days</span></div></li>'
                    + '<li><div class="time-item"><p>' + this.leadingZeros(data.hours, 2) + '</p><span>Hours</span></div></li>'
                    + '<li><div class="time-item"><p>' + this.leadingZeros(data.min, 2) + '</p><span>Mins</span></div></li>'
                    + '<li><div class="time-item"><p>' + this.leadingZeros(data.sec, 2) + '</p><span>Seconds</span></div></li>'
                );
            }
        });
	});
	$(window).on('load', function() {
		$( '.grid' ).each( function() {
	    	var $grid = $('.grid').isotope({
			  itemSelector: '.filterinteresting',
			  layoutMode: 'fitRows',
			  getSortData: {
			    name: '.name',
			    symbol: '.symbol',
			    number: '.number parseInt',
			    category: '[data-category]',
			    weight: function( itemElem ) {
			      var weight = $( itemElem ).find('.weight').text();
			      return parseFloat( weight.replace( /[\(\)]/g, '') );
			    }
			  }
			});

			// filter functions
			var filterFns = {
			  // show if number is greater than 50
			  numberGreaterThan50: function() {
			    var number = $(this).find('.number').text();
			    return parseInt( number, 10 ) > 50;
			  },
			  // show if name ends with -ium
			  ium: function() {
			    var name = $(this).find('.name').text();
			    return name.match( /ium$/ );
			  }
			};

			// bind filter button click
			$('.filter-theme').on( 'click', 'button', function() {
			  var filterValue = $( this ).attr('data-filter');
			  // use filterFn if matches value
			  filterValue = filterFns[ filterValue ] || filterValue;
			  $grid.isotope({ filter: filterValue });
			});



			// change is-checked class on buttons
			$('.campaign-tabs').each( function( i, buttonGroup ) {
			  var $buttonGroup = $( buttonGroup );
			  $buttonGroup.on( 'click', 'button', function() {
			    $buttonGroup.find('.is-checked').removeClass('is-checked');
			    $( this ).addClass('is-checked');
			  });
			});
	    });
	});
})(jQuery);
wow = new WOW(
  {
    animateClass: 'animated',
    offset:       100,
    callback:     function(box) {
      console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
    }
  }
);
wow.init();

/*  [ jQuery Upload File ]
        - - - - - - - - - - - - - - - - - - - - */
function  readURL(input,thumbimage) {
   	if  (input.files && input.files[0]) { 
   	var  reader = new FileReader();
    reader.onload = function (e) {
    $("#thumbimage").attr('src', e.target.result);
     	}
     	reader.readAsDataURL(input.files[0]);
    }
    else  { // Sử dụng cho IE
      	$("#thumbimage").attr('src', input.value);
    }
    $("#thumbimage").show();
    $('.filename').text($("#uploadfile").val());
    $('.choicefile').css('background', '#C4C4C4');
    $('.choicefile').css('cursor', 'default');
    $(".removeimg").show();
    $(".choicefile").hide();       
}
$(document).ready(function () {
   	$(".choicefile").bind('click', function  () { 
    	$("#uploadfile").click();
    });
   	$(".removeimg").click(function () {
     	$("#thumbimage").attr('src', '').hide();
      	$("#myfileupload").html('<input type="file" id="uploadfile"  onchange="readURL(this);" />');
      	$(".removeimg").hide();
      	$(".choicefile").show();
      	$(".choicefile").bind('click', function  () {
       		$("#uploadfile").click();
      	});
      	$('.choicefile').css('background','#C4C4C4');
      	$('.choicefile').css('cursor', 'pointer');
      	$(".filename").text("");
    });
})

function  readURL1(input,thumbimage) {
   	if  (input.files && input.files[0]) { 
   	var  reader = new FileReader();
    reader.onload = function (e) {
    $("#thumbimage1").attr('src', e.target.result);
     	}
     	reader.readAsDataURL(input.files[0]);
    }
    else  { // Sử dụng cho IE
      	$("#thumbimage1").attr('src', input.value);
    }
    $("#thumbimage1").show();
    $('.filename1').text($("#uploadfile").val());
    $('.choicefile1').css('background', '#C4C4C4');
    $('.choicefile1').css('cursor', 'default');
    $(".removeimg1").show();
    $(".choicefile1").hide();       
}
$(document).ready(function () {
   	$(".choicefile1").bind('click', function  () { 
    	$("#uploadfile1").click();
    });
   	$(".removeimg1").click(function () {
     	$("#thumbimage1").attr('src', '').hide();
      	$("#myfileupload1").html('<input type="file" id="uploadfile1"  onchange="readURL1(this);" />');
      	$(".removeimg1").hide();
      	$(".choicefile1").show();
      	$(".choicefile1").bind('click', function  () {
       		$("#uploadfile1").click();
      	});
      	$('.choicefile1').css('background','#C4C4C4');
      	$('.choicefile1').css('cursor', 'pointer');
      	$(".filename1").text("");
    });
})

function  readURL2(input,thumbimage) {
   	if  (input.files && input.files[0]) { 
   	var  reader = new FileReader();
    reader.onload = function (e) {
    $("#thumbimage2").attr('src', e.target.result);
     	}
     	reader.readAsDataURL(input.files[0]);
    }
    else  { // Sử dụng cho IE
      	$("#thumbimage2").attr('src', input.value);
    }
    $("#thumbimage2").show();
    $('.filename2').text($("#uploadfile").val());
    $('.choicefile2').css('background', '#C4C4C4');
    $('.choicefile2').css('cursor', 'default');
    $(".removeimg2").show();
    $(".choicefile2").hide();       
}
$(document).ready(function () {
   	$(".choicefile2").bind('click', function  () { 
    	$("#uploadfile2").click();
    });
   	$(".removeimg2").click(function () {
     	$("#thumbimage2").attr('src', '').hide();
      	$("#myfileupload2").html('<input type="file" id="uploadfile2"  onchange="readURL2(this);" />');
      	$(".removeimg2").hide();
      	$(".choicefile2").show();
      	$(".choicefile2").bind('click', function  () {
       		$("#uploadfile2").click();
      	});
      	$('.choicefile2').css('background','#C4C4C4');
      	$('.choicefile2').css('cursor', 'pointer');
      	$(".filename2").text("");
    });
})