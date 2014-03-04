/**
 * main.js v1.0
 * Syrena admin template
 *
 * License:
 * For License Information check out - https://wrapbootstrap.com
 * 
 * Copyright 2013, Stilearning
 * http://stilearning.com
 */

$(function(){

	'use strict';
	$.extend(verge); // enxtend verge (viewport reader, docs: https://github.com/ryanve/verge) to jquery


	// Progress autoatically with pace
	window.paceOptions = {
	  // Disable the 'elements' source
	  elements: false,

	  // Only show the progress on regular and ajax-y page navigation,
	  // not every request
	  restartOnRequestAfter: false
	}
	window.Pace.start();
	



	/**
	 * Theme switcher
	 */
	/*
	var theme_tags = '<div class="theme-switcher">'
        +'<ul class="list-unstyled">'
        +'    <li><a id="theme-switcher" href="#"><i class="icon ion-contrast"></i></a></li>'
        +'    <li><a data-theme="default" class="theme bg-peterriver"></a></li>'
        +'    <li><a data-theme="midnight" class="theme bg-midnightblue"></a></li>'
        +'    <li><a data-theme="light" class="theme bg-cloud"></a></li>'
        +'</ul>'
    	+'</div>';
	//$('body').append(theme_tags);
	
	$('#theme-switcher').on('click', function(e){
		e.preventDefault();

		$('.theme-switcher').toggleClass('open');
	});
	$('.theme-switcher .theme').on('click', function(e){
		e.preventDefault();

		var $this = $(this),
			theme = $this.attr('data-theme');

		if (theme == 'default') {
			$('#theme-css').attr('href', 'assets/app/css/syrena-admin-theme-default.css');
		}
		else if(theme == 'midnight'){
			$('#theme-css').attr('href', 'assets/app/css/syrena-admin-theme-midnight.css');
		}
		else if(theme == 'light'){
			$('#theme-css').attr('href', 'assets/app/css/syrena-admin-theme-light.css');
		}
	})
	*/

	/**
	 * Bootstrap manual 
	 */
	$('[data-toggle="tooltip"]').tooltip();		// tooltips
	$('[data-toggle="popover"]').popover();		// popovers




	/**
	 * Search UI theme on side left rule
	 * @type {[type]}
	 */
	$('#smart-search > .form-control').on('focus', function(e){
		var $this = $(this),
			target = $this.attr('data-target');

		$(target).addClass('open').fadeIn();
	})
	.on('focusout', function(e){
		var $this = $(this),
			target = $this.attr('data-target');

		$(target).removeClass('open active').fadeOut();
		$this.val('');

		$('.side-wrapper-status').fadeIn(300);
		$('.side-wrapper-result').hide();
	})
	.on('keyup', function(e){
		var $this = $(this),
			target = $this.attr('data-target');

		if ($this.val() == '') {
			$(target).removeClass('active');

			$('.side-wrapper-status').fadeIn(300);
			$('.side-wrapper-result').hide();
		}
		else{
			$(target).addClass('active');

			$('.side-wrapper-status').hide();
			$('.side-wrapper-result').fadeIn(300);

			// call ajax search below here and place result in side-wrapper-result
		}
	});
	$('#smart-search').on('submit', function(e){
		e.preventDefault();
	});



	/**
	 * Side left Menu rule
	 */
	$('.side-nav-child').prev().on('click', function(e){
		e.preventDefault();

		var $this = $(this),
			target = $this.attr('href');

		$(target).addClass('open');
	})
	$('.side-nav-back').on('click', function(e){
		e.preventDefault();
		var $this = $(this),
			target = $this.parent().parent();

		$(target).removeClass('open');
	})


	
	// visibility elements on different viewports
	var initVisibilityElms = function(){
		var viewport = $.viewportW();	// detect viewport with verge

		// large desktop
		if( viewport >= 1680 ){
			// action on large desktop
			if ($('.content-aside').length > 0) {
				$('.content-main').addClass('content-main-md');
			}
			$('.content-aside').addClass('open');
		}
		else{
			// callback
			$('.content-main').removeClass('content-main-md');
			$('.content-aside').removeClass('open');
		}

		// tablet viewport and less
		if( viewport <= 768){
			$('.content').addClass('content-lg');	// toggle content mode

			$('#toggle-search').addClass('hide');
			// place your elements with hide on tablet and small screen above
			// $(elements).toggleClass('hide');
		}
	}
	initVisibilityElms();		// init visibility elements on load
	// handle visibility elements on window resize
	$(window).on('resize', function() {
		// fixed mode type on tablet and phone
		var on_type = $('#smart-search').find('input').is(':focus');

		if (!on_type) {
			initVisibilityElms();	// handle visibility elements on window resize
		}
	});



	// toggle search
	$('#toggle-search').on('click', function(e){
		e.preventDefault();

		var brand = $('#brand'),
			form_search = $('#smart-search');

		brand.toggleClass('hide');
		form_search.toggleClass('hide').find('input').focus().val('');
		$(this).toggleClass('active');
	})
	// toggle content
	$('#toggle-content').on('click', function(e){
		e.preventDefault();
		
		var content = $('#content');

		// $(this).toggleClass('active');

		content.toggleClass('content-lg');

		// kiye kerjake!
		$('#toggle-search').toggleClass('hide'); // handle visibility search button 
	});



	
	// gesture event on #content for toggle content
	// if your device doesn't support touch event you can manually add data-swipe="true" on #content
	// var is_touch_device = 'ontouchstart' in document.documentElement,
	//	touch_content_selector = (is_touch_device) ? $('#content')  : $('#content[data-swipe="true"]') ;
	/*
	$('#content[data-swipe="true"]').swipe({
	  	swipeStatus:function(event, phase, direction, distance, duration, fingers){

	  		// default padding left
	  		var pl = 300;
	  		if(direction == 'right'){
	  			pl = distance;
	  		}
	  		else if(direction == 'left'){
	  			pl = pl - distance;
	  		}

	  		// handle padding left max/min value
	  		if(pl >= 300) 
	  			pl = 300;
  			else if(pl <= 0) 
  				pl = 0;


	  		if (phase == 'move') {
	  			// side left is close
		  		if( $(this).hasClass('content-lg') ){
			  		if(direction == 'right'){
			  			// going to open side left
				  		$(this).css({
			  				'left': pl +'px',
			  				'z-index': 3
			  			});
			  		}
		  		}
		  		// side left is open
		  		else{
		  			if(direction == 'left'){
		  				// going to close side left
				  		$(this).css({
			  				'left': pl +'px',
			  				'padding-left': 0,
			  				'z-index': 3
			  			});
			  		}
		  		}
	  		}
	  		else if (phase == 'end') {
  				$(this).css({
	  				'left': '0'	// setting pos left by default
	  			});

  				if(direction == 'right'){
  					if (pl < 200) {
  						// close side left
	  					$(this).addClass('content-lg').css({
	  						'padding-left': 0,
	  						'z-index': 3
	  					})
	  				}
	  				else{
	  					// open side left
	  					$(this).removeClass('content-lg').css({
	  						'padding-left': '300px',
	  						'z-index': 1
	  					})
	  				}
  				}
  				else if(direction == 'left'){
  					if (pl < 100) {
  						// close side left
	  					$(this).addClass('content-lg').css({
	  						'padding-left': 0,
	  						'z-index': 3
	  					})
	  				}
	  				else{
	  					// open side left
	  					$(this).removeClass('content-lg').css({
	  						'padding-left': '300px',
	  						'z-index': 1
	  					})
	  				}
  				}
  			};
	  	}
	});
	*/


	// toggle aside
	$('#toggle-aside').on('click', function(e){
		e.preventDefault();

		var $this = $(this),
			content_main = $('#content-main'),
			content_aside = $('#content-aside');

		$this.toggleClass('active');
		content_main.toggleClass('content-main-md');
		content_aside.toggleClass('open');
	})




	/*
	 *  Chats module demo
	 */
 	// toggle contact-chat
    $('.cm-contact-item').on('click', function(e){
        e.preventDefault();

        $('.cm-content').addClass('open');
        $('.cm-contact').addClass('fixed');
    })
    $('.cm-content-heading').on('click', function(e){
        e.preventDefault();

        $('.cm-contact').removeClass('fixed');
        $('.cm-content').removeClass('open');
    })


    // demo chat
    $('.cm-content-chats').animate({ scrollTop: $(this).scrollTop() + $(this).height() }, 300);
    // manually adding height of chat-in/out buble
    $('.chat-in, .chat-out').each(function(){
        var $this = $(this),
            msg_box_height = $this.find('.chat-msg').innerHeight();

        if (msg_box_height > 40) {  // couse min-height is 40px
            $this.css({
                'height' : msg_box_height + 'px'
            })
        };
    })

    // demo sending chat
    $('#frm-send-chat').on('submit', function(e){
        e.preventDefault();

        var $this = $(this),
            content_chats = $('.cm-content-chats'),
            msg = $('[name="chat-msg"]').val(),
            new_chat = '<div class="chat-out">'
                    +    '<div class="chat-avatar">'
                    +        '<img src="assets/app/img/avatar4.png" title="" />'
                    +    '</div>'
                    +    '<div class="chat-msg">'
                    +        '<p>'+ msg +'</p>'
                    +        '<time datetime="2013-12-13T20:00">Now</time>'
                    +    '</div>'
                    +'</div>';

        if ($.trim(msg) != '') {

            content_chats.append(new_chat);

            // set height for new_chat
            var new_chat_out = $('.cm-content-chats > div[class*="chat-"]').last(),
                new_chat_height = new_chat_out.find('.chat-msg').innerHeight();

            new_chat_out.css({
                'height': new_chat_height + 'px'
            });

            var scrollBottom = content_chats.scrollTop() + content_chats.height();
            content_chats.animate({ scrollTop: scrollBottom }, 300);

            // back to first rule
            $('[name="chat-msg"]').val('');
        }
        else{
        	// back to first rule
            $('[name="chat-msg"]').val('');
        }
    })
	



	/**
	 * Smooth Scrolling
	 */
	$('.scroll-smooth:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

			if (target.length) {
				$('.app-body').animate({
				  	scrollTop: target.offset().top
				}, 1000);
				return false;
			}
		}
	});




	/**
	 * Transition Layout - generate layout like a pagination with transition
	 */
	$(function(){
		var active_layout = $('.transition-layout.active').length;
		if (active_layout === 0) {
			$('.transition-layout').first().addClass('active');
		}
	});
	$('[data-toggle="transition-layout"]').on('click', function(e){
		e.preventDefault();

		var $this = $(this),
			parents = $('[data-toggle="transition-layout"]'),
			layouts = $('.transition-layout'),
			active_layout = $('.transition-layout.active'),
			target = $this.attr('href'),
			current = $(target).hasClass('active'),
			anim = $this.attr('data-anim'),
			In = 'scaleIn',
			Out = 'scaleOut';

			/** remove this command if you use slide effect for transition layout
			if (anim == 'slide') {
				In = 'scaleIn';
				Out = 'scaleOut';
			};
			*/

		if (parents.hasClass('btn')) {
			parents.removeClass('active');
			$(this).addClass('active');
		}
		else{
			parents.parent().removeClass('active');
			$(this).parent().addClass('active');
		}
		

		if (target.length !== 0) {
			if (!current) {
				// layouts.unbind();

				layouts.removeClass('active scaleIn scaleOut slideIn slideOut');

				active_layout.addClass(Out);

				$(target).addClass('active '+In);
					/*.on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(){
						$(target).addClass('active')
					});*/
			};
		};
	})



	/**
	 * Magic Layout - generate with isotope 
	 * it's a awesome responsive layout for your awesome projects
	 * bootstrap is available grid layout, but static
	 * magic layout give you dynamically responsive layout for differents viewport
	 */
	// init magic layout with isotope
	$('.magic-layout').each(function(){
		var $container = $(this),
			parent = $container.parent(),
			data_col = $container.attr('data-cols'),
			viewport = $.viewportW(),
			cols, masonry;

		if(typeof data_col === undefined || data_col == '' ){
			data_col = 2;
		}

		if(data_col == '3'){
			cols = 'ml-col-3';
		}
		else if(data_col == '4'){
			cols = 'ml-col-4';
		}
		else{
			data_col = 2;
		}

		if (viewport <= 1280) {
			if (data_col > 2) {
				cols = '';
				data_col = 2;
			}
		}

		// add class for layout col
		$container.addClass(cols);

		// initialize masonry width
		masonry = $container.width() / data_col;

		$container.isotope({
		  itemSelector : '.magic-element',
		  // disable normal resizing
		  resizable: false, 
		  // set columnWidth to a percentage of container width
		  masonry: { columnWidth: masonry }
		});

		// update fixed with transition layout
		setTimeout(function(){
			masonry = $container.width() / data_col;
			// initialize Isotope
			$container.isotope({
			  // set columnWidth to a percentage of container width
			  masonry: { columnWidth: masonry }
			});
		}, 500);
		
		// update fixed with transition layout
		$('.transition-layout').bind("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(){
			masonry = $container.width() / data_col;
			// initialize Isotope
			$container.isotope({
			  // set columnWidth to a percentage of container width
			  masonry: { columnWidth: masonry }
			});
		})

		// update initialize if transition is running
		$("#content-aside").bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
			var masonry = $container.width() / data_col;
			// initialize Isotope
			$container.isotope({
			  // set columnWidth to a percentage of container width
			  masonry: { columnWidth: masonry }
			});
		})

		// update columnWidth on window resize
		$(window).on('resize', function(){
			var viewport = $.viewportW();	// detect viewport with verge
			
			// if toggle aside in mode medium to small viewport
			if (viewport <= 1280) {
				if (data_col > 2) {
					cols = '';
					data_col = 2;
				}
			}
			else{
				// set to original data
				data_col = $container.attr('data-cols');
				if(typeof data_col === undefined || data_col == '' ){
					data_col = 2;
				}

				if(data_col == '3'){
					cols = 'ml-col-3';
				}
				else if(data_col == '4'){
					cols = 'ml-col-4';
				}
				else{
					data_col = 2;
				}
			}

			// update class
			$container.removeClass('ml-col-3 ml-col-4');
			$container.addClass(cols);

			// update masonry
			masonry = $container.width() / data_col;

			// update on resize
		  	$container.isotope({
			    // update columnWidth to a percentage of container width
			    masonry: { columnWidth: masonry }
		  	});

		  	// update columnWith after transition finished
			$("#content").bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
				masonry = $container.width() / data_col;
				$container.isotope({
				    // update columnWidth to a percentage of container width
				    masonry: { columnWidth: masonry }
			  	});
			})
		}); // end window resize

		// update columnWidth on toggle aside
		$('#toggle-aside').on('click', function(e){
			$container.isotope('reLayout');
			
		}) // end toggle aside

		// update columnWidth on toggle aside
		$('#toggle-content').on('click', function(e){
			masonry = $container.width() / data_col;
			$container.isotope({
			    // update columnWidth to a percentage of container width
			    masonry: { columnWidth: masonry }
		  	});
		}) // end toggle content

		// update columnWidth on avtive content swipe
		$('#content[data-swipe="true"]').on('swipe', function(){
			masonry = $container.width() / data_col;
			$container.isotope({
			    // update columnWidth to a percentage of container width
			    masonry: { columnWidth: masonry }
		  	});
		})
	}) // end each magic-layout
	

	
	// panel controls
	// callback panel on finish actions
	var callback_panel = function(){
		$('.magic-layout').isotope('reLayout');
	};
	$('[data-toggle="tab"], [data-toggle="collapse"]').on('click', function(){
		var $this = $(this),
			target = $this.attr('href');

		$(target).bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
			callback_panel();
		});
	})
	// close a panel
	$('.panel [data-close]').on('click', function(e){
		e.preventDefault();
		var $this = $(this),
			panel = $this.attr('data-close');

		$(panel).hide(300, function(){
			$('.magic-layout').isotope('remove', $(this));
		});
	});
	// collapse a panel
	$('.panel-collapsed .panel-body').hide(100, callback_panel);
	$('.panel-collapsed .table').hide(100, callback_panel);
	$('.panel-collapsed .list-group').hide(100, callback_panel);
	$('.panel [data-collapse]').on('click', function(e){
		e.preventDefault();
		var $this = $(this),
			panel = $this.attr('data-collapse'),
			panel_body = $(panel).children('.panel-body'),
			table = $(panel).children('.table'),
			list_group = $(panel).children('.list-group');

		$(panel).toggleClass('panel-collapsed');
		$(panel_body).slideToggle(200, callback_panel);
		$(table).slideToggle(200, callback_panel);
		$(list_group).slideToggle(200, callback_panel);
	});
	$('[data-toggle="panel-collapse"]').on('dblclick', function(e){
		e.preventDefault();
		var $this = $(this),
			panel = $this.attr('data-panel'),
			panel_body = $(panel).children('.panel-body'),
			table = $(panel).children('.table'),
			list_group = $(panel).children('.list-group');

		$(panel).toggleClass('panel-collapsed');
		$(panel_body).slideToggle(200, callback_panel);
		$(table).slideToggle(200, callback_panel);
		$(list_group).slideToggle(200, callback_panel);
	});
	$('.panel > .panel-heading > .panel-icon').on('dblclick', function(e){
		e.preventDefault();
		var $this = $(this),
			panel = $this.parent().parent(),
			panel_body = panel.children('.panel-body'),
			table = panel.children('.table'),
			list_group = panel.children('.list-group');

		panel.toggleClass('panel-collapsed');
		panel_body.slideToggle(200, callback_panel);
		table.slideToggle(200, callback_panel);
		list_group.slideToggle(200, callback_panel);
	});
	// expand panel
	$('.panel [data-expand]').on('click', function(e){
		e.preventDefault();
		var $this = $(this),
			panel = $this.attr('data-expand');

		$(panel).toggleClass('expand');
		callback_panel();
	});
	// refresh panel
	$('.panel [data-refresh]').on('click', function(e){
		e.preventDefault();
		var $this = $(this),
			panel = $this.attr('data-refresh');

		$(panel).append('<div class="panel-progress"><div class="panel-spinner"></div></div>');


		// Your ajax place here to remove panel-progress, we just use setTimeout to simple demo
	})
	$('.close').on('click', function(){
		callback_panel();
	});
    // end tags input

});

	
	/*! Loader automatically plugin
	 *  http://github.hubspot.com/pace/ */
	/*! pace 0.4.16 */
	(function(){var a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q=[].slice,R={}.hasOwnProperty,S=function(a,b){function c(){this.constructor=a}for(var d in b)R.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a},T=[].indexOf||function(a){for(var b=0,c=this.length;c>b;b++)if(b in this&&this[b]===a)return b;return-1};s={catchupTime:500,initialRate:.03,minTime:500,ghostTime:500,maxProgressPerFrame:10,easeFactor:1.25,startOnPageLoad:!0,restartOnPushState:!0,restartOnRequestAfter:500,target:"body",elements:{checkInterval:100,selectors:["body"]},eventLag:{minSamples:10,sampleCount:3,lagThreshold:3},ajax:{trackMethods:["GET"],trackWebSockets:!1}},A=function(){var a;return null!=(a="undefined"!=typeof performance&&null!==performance?"function"==typeof performance.now?performance.now():void 0:void 0)?a:+new Date},C=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||window.msRequestAnimationFrame,r=window.cancelAnimationFrame||window.mozCancelAnimationFrame,null==C&&(C=function(a){return setTimeout(a,50)},r=function(a){return clearTimeout(a)}),E=function(a){var b,c;return b=A(),c=function(){var d;return d=A()-b,d>=33?(b=A(),a(d,function(){return C(c)})):setTimeout(c,33-d)},c()},D=function(){var a,b,c;return c=arguments[0],b=arguments[1],a=3<=arguments.length?Q.call(arguments,2):[],"function"==typeof c[b]?c[b].apply(c,a):c[b]},t=function(){var a,b,c,d,e,f,g;for(b=arguments[0],d=2<=arguments.length?Q.call(arguments,1):[],f=0,g=d.length;g>f;f++)if(c=d[f])for(a in c)R.call(c,a)&&(e=c[a],null!=b[a]&&"object"==typeof b[a]&&null!=e&&"object"==typeof e?t(b[a],e):b[a]=e);return b},o=function(a){var b,c,d,e,f;for(c=b=0,e=0,f=a.length;f>e;e++)d=a[e],c+=Math.abs(d),b++;return c/b},v=function(a,b){var c,d,e;if(null==a&&(a="options"),null==b&&(b=!0),e=document.querySelector("[data-pace-"+a+"]")){if(c=e.getAttribute("data-pace-"+a),!b)return c;try{return JSON.parse(c)}catch(f){return d=f,"undefined"!=typeof console&&null!==console?console.error("Error parsing inline pace options",d):void 0}}},null==window.Pace&&(window.Pace={}),B=Pace.options=t(s,window.paceOptions,v()),h=function(a){function b(){return O=b.__super__.constructor.apply(this,arguments)}return S(b,a),b}(Error),b=function(){function a(){this.progress=0}return a.prototype.getElement=function(){var a;if(null==this.el){if(a=document.querySelector(B.target),!a)throw new h;this.el=document.createElement("div"),this.el.className="pace pace-active",document.body.className=document.body.className.replace("pace-done",""),document.body.className+=" pace-running",this.el.innerHTML='<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>',null!=a.firstChild?a.insertBefore(this.el,a.firstChild):a.appendChild(this.el)}return this.el},a.prototype.finish=function(){var a;return a=this.getElement(),a.className=a.className.replace("pace-active",""),a.className+=" pace-inactive",document.body.className=document.body.className.replace("pace-running",""),document.body.className+=" pace-done"},a.prototype.update=function(a){return this.progress=a,this.render()},a.prototype.destroy=function(){try{this.getElement().parentNode.removeChild(this.getElement())}catch(a){h=a}return this.el=void 0},a.prototype.render=function(){var a,b;return null==document.querySelector(B.target)?!1:(a=this.getElement(),a.children[0].style.width=""+this.progress+"%",(!this.lastRenderedProgress||0|(this.lastRenderedProgress|0!==this.progress))&&(a.children[0].setAttribute("data-progress-text",""+(0|this.progress)+"%"),this.progress>=100?b="99":(b=this.progress<10?"0":"",b+=0|this.progress),a.children[0].setAttribute("data-progress",""+b)),this.lastRenderedProgress=this.progress)},a.prototype.done=function(){return this.progress>=100},a}(),g=function(){function a(){this.bindings={}}return a.prototype.trigger=function(a,b){var c,d,e,f,g;if(null!=this.bindings[a]){for(f=this.bindings[a],g=[],d=0,e=f.length;e>d;d++)c=f[d],g.push(c.call(this,b));return g}},a.prototype.on=function(a,b){var c;return null==(c=this.bindings)[a]&&(c[a]=[]),this.bindings[a].push(b)},a}(),L=window.XMLHttpRequest,K=window.XDomainRequest,J=window.WebSocket,u=function(a,b){var c,d,e,f;f=[];for(d in b.prototype)try{e=b.prototype[d],null==a[d]&&"function"!=typeof e?f.push(a[d]=e):f.push(void 0)}catch(g){c=g}return f},y=[],Pace.ignore=function(){var a,b,c;return b=arguments[0],a=2<=arguments.length?Q.call(arguments,1):[],y.unshift("ignore"),c=b.apply(null,a),y.shift(),c},Pace.track=function(){var a,b,c;return b=arguments[0],a=2<=arguments.length?Q.call(arguments,1):[],y.unshift("track"),c=b.apply(null,a),y.shift(),c},G=function(a){var b;if(null==a&&(a="GET"),"track"===y[0])return"force";if(!y.length&&B.ajax){if("socket"===a&&B.ajax.trackWebSockets)return!0;if(b=a.toUpperCase(),T.call(B.ajax.trackMethods,b)>=0)return!0}return!1},i=function(a){function b(){var a,c=this;b.__super__.constructor.apply(this,arguments),a=function(a){var b;return b=a.open,a.open=function(d,e){return G(d)&&c.trigger("request",{type:d,url:e,request:a}),b.apply(a,arguments)}},window.XMLHttpRequest=function(b){var c;return c=new L(b),a(c),c},u(window.XMLHttpRequest,L),null!=K&&(window.XDomainRequest=function(){var b;return b=new K,a(b),b},u(window.XDomainRequest,K)),null!=J&&B.ajax.trackWebSockets&&(window.WebSocket=function(a,b){var d;return d=new J(a,b),G("socket")&&c.trigger("request",{type:"socket",url:a,protocols:b,request:d}),d},u(window.WebSocket,J))}return S(b,a),b}(g),M=null,w=function(){return null==M&&(M=new i),M},w().on("request",function(b){var c,d,e,f;return f=b.type,e=b.request,Pace.running||B.restartOnRequestAfter===!1&&"force"!==G(f)?void 0:(d=arguments,c=B.restartOnRequestAfter||0,"boolean"==typeof c&&(c=0),setTimeout(function(){var b,c,g,h,i,j,k;if(c="socket"===f?e.readyState<2:0<(i=e.readyState)&&4>i){for(Pace.restart(),j=Pace.sources,k=[],g=0,h=j.length;h>g;g++){if(b=j[g],b instanceof a){b.watch.apply(b,d);break}k.push(void 0)}return k}},c))}),a=function(){function a(){var a=this;this.elements=[],w().on("request",function(){return a.watch.apply(a,arguments)})}return a.prototype.watch=function(a){var b,c,d;return d=a.type,b=a.request,c="socket"===d?new l(b):new m(b),this.elements.push(c)},a}(),m=function(){function a(a){var b,c,d,e,f,g,h=this;if(this.progress=0,null!=window.ProgressEvent)for(c=null,a.addEventListener("progress",function(a){return h.progress=a.lengthComputable?100*a.loaded/a.total:h.progress+(100-h.progress)/2}),g=["load","abort","timeout","error"],d=0,e=g.length;e>d;d++)b=g[d],a.addEventListener(b,function(){return h.progress=100});else f=a.onreadystatechange,a.onreadystatechange=function(){var b;return 0===(b=a.readyState)||4===b?h.progress=100:3===a.readyState&&(h.progress=50),"function"==typeof f?f.apply(null,arguments):void 0}}return a}(),l=function(){function a(a){var b,c,d,e,f=this;for(this.progress=0,e=["error","open"],c=0,d=e.length;d>c;c++)b=e[c],a.addEventListener(b,function(){return f.progress=100})}return a}(),d=function(){function a(a){var b,c,d,f;for(null==a&&(a={}),this.elements=[],null==a.selectors&&(a.selectors=[]),f=a.selectors,c=0,d=f.length;d>c;c++)b=f[c],this.elements.push(new e(b))}return a}(),e=function(){function a(a){this.selector=a,this.progress=0,this.check()}return a.prototype.check=function(){var a=this;return document.querySelector(this.selector)?this.done():setTimeout(function(){return a.check()},B.elements.checkInterval)},a.prototype.done=function(){return this.progress=100},a}(),c=function(){function a(){var a,b,c=this;this.progress=null!=(b=this.states[document.readyState])?b:100,a=document.onreadystatechange,document.onreadystatechange=function(){return null!=c.states[document.readyState]&&(c.progress=c.states[document.readyState]),"function"==typeof a?a.apply(null,arguments):void 0}}return a.prototype.states={loading:0,interactive:50,complete:100},a}(),f=function(){function a(){var a,b,c,d,e,f=this;this.progress=0,a=0,e=[],d=0,c=A(),b=setInterval(function(){var g;return g=A()-c-50,c=A(),e.push(g),e.length>B.eventLag.sampleCount&&e.shift(),a=o(e),++d>=B.eventLag.minSamples&&a<B.eventLag.lagThreshold?(f.progress=100,clearInterval(b)):f.progress=100*(3/(a+3))},50)}return a}(),k=function(){function a(a){this.source=a,this.last=this.sinceLastUpdate=0,this.rate=B.initialRate,this.catchup=0,this.progress=this.lastProgress=0,null!=this.source&&(this.progress=D(this.source,"progress"))}return a.prototype.tick=function(a,b){var c;return null==b&&(b=D(this.source,"progress")),b>=100&&(this.done=!0),b===this.last?this.sinceLastUpdate+=a:(this.sinceLastUpdate&&(this.rate=(b-this.last)/this.sinceLastUpdate),this.catchup=(b-this.progress)/B.catchupTime,this.sinceLastUpdate=0,this.last=b),b>this.progress&&(this.progress+=this.catchup*a),c=1-Math.pow(this.progress/100,B.easeFactor),this.progress+=c*this.rate*a,this.progress=Math.min(this.lastProgress+B.maxProgressPerFrame,this.progress),this.progress=Math.max(0,this.progress),this.progress=Math.min(100,this.progress),this.lastProgress=this.progress,this.progress},a}(),H=null,F=null,p=null,I=null,n=null,q=null,Pace.running=!1,x=function(){return B.restartOnPushState?Pace.restart():void 0},null!=window.history.pushState&&(N=window.history.pushState,window.history.pushState=function(){return x(),N.apply(window.history,arguments)}),null!=window.history.replaceState&&(P=window.history.replaceState,window.history.replaceState=function(){return x(),P.apply(window.history,arguments)}),j={ajax:a,elements:d,document:c,eventLag:f},(z=function(){var a,c,d,e,f,g,h,i,l;for(Pace.sources=H=[],h=["ajax","elements","document","eventLag"],d=0,f=h.length;f>d;d++)c=h[d],B[c]!==!1&&H.push(new j[c](B[c]));for(l=null!=(i=B.extraSources)?i:[],e=0,g=l.length;g>e;e++)a=l[e],H.push(new a(B));return Pace.bar=p=new b,F=[],I=new k})(),Pace.stop=function(){return Pace.running=!1,p.destroy(),q=!0,null!=n&&("function"==typeof r&&r(n),n=null),z()},Pace.restart=function(){return Pace.stop(),Pace.start()},Pace.go=function(){return Pace.running=!0,p.render(),q=!1,n=E(function(a,b){var c,d,e,f,g,h,i,j,l,m,n,o,r,s,t,u,v,w;for(j=100-p.progress,d=r=0,e=!0,h=s=0,u=H.length;u>s;h=++s)for(n=H[h],m=null!=F[h]?F[h]:F[h]=[],g=null!=(w=n.elements)?w:[n],i=t=0,v=g.length;v>t;i=++t)f=g[i],l=null!=m[i]?m[i]:m[i]=new k(f),e&=l.done,l.done||(d++,r+=l.tick(a));return c=r/d,p.update(I.tick(a,c)),o=A(),p.done()||e||q?(p.update(100),setTimeout(function(){return p.finish(),Pace.running=!1},Math.max(B.ghostTime,Math.min(B.minTime,A()-o)))):b()})},Pace.start=function(a){t(B,a),Pace.running=!0;try{p.render()}catch(b){h=b}return document.querySelector(".pace")?Pace.go():setTimeout(Pace.start,50)},"function"==typeof define&&define.amd?define(function(){return Pace}):"object"==typeof exports?module.exports=Pace:B.startOnPageLoad&&Pace.start()}).call(this);


	/**
	 * author Christopher Blum
	 *    - based on the idea of Remy Sharp, http://remysharp.com/2009/01/26/element-in-view-event-plugin/
	 *    - forked from http://github.com/zuk/jquery.inview/
	 */
	(function ($) {
	  var inviewObjects = {}, viewportSize, viewportOffset,
	      d = document, w = window, documentElement = d.documentElement, expando = $.expando;
	
	  $.event.special.inview = {
	    add: function(data) {
	      inviewObjects[data.guid + "-" + this[expando]] = { data: data, $element: $(this) };
	    },
	
	    remove: function(data) {
	      try { delete inviewObjects[data.guid + "-" + this[expando]]; } catch(e) {}
	    }
	  };
	
	  function getViewportSize() {
	    var mode, domObject, size = { height: w.innerHeight, width: w.innerWidth };
	
	    // if this is correct then return it. iPad has compat Mode, so will
	    // go into check clientHeight/clientWidth (which has the wrong value).
	    if (!size.height) {
	      mode = d.compatMode;
	      if (mode || !$.support.boxModel) { // IE, Gecko
	        domObject = mode === 'CSS1Compat' ?
	          documentElement : // Standards
	          d.body; // Quirks
	        size = {
	          height: domObject.clientHeight,
	          width:  domObject.clientWidth
	        };
	      }
	    }
	
	    return size;
	  }
	
	  function getViewportOffset() {
	    return {
	      top:  w.pageYOffset || documentElement.scrollTop   || d.body.scrollTop,
	      left: w.pageXOffset || documentElement.scrollLeft  || d.body.scrollLeft
	    };
	  }
	
	  function checkInView() {
	    var $elements = $(), elementsLength, i = 0;
	
	    $.each(inviewObjects, function(i, inviewObject) {
	      var selector  = inviewObject.data.selector,
	          $element  = inviewObject.$element;
	      $elements = $elements.add(selector ? $element.find(selector) : $element);
	    });
	
	    elementsLength = $elements.length;
	    if (elementsLength) {
	      viewportSize   = viewportSize   || getViewportSize();
	      viewportOffset = viewportOffset || getViewportOffset();
	
	      for (; i<elementsLength; i++) {
	        // Ignore elements that are not in the DOM tree
	        if (!$.contains(documentElement, $elements[i])) {
	          continue;
	        }
	
	        var $element      = $($elements[i]),
	            elementSize   = { height: $element.height(), width: $element.width() },
	            elementOffset = $element.offset(),
	            inView        = $element.data('inview'),
	            visiblePartX,
	            visiblePartY,
	            visiblePartsMerged;
	        
	        // Don't ask me why because I haven't figured out yet:
	        // viewportOffset and viewportSize are sometimes suddenly null in Firefox 5.
	        // Even though it sounds weird:
	        // It seems that the execution of this function is interferred by the onresize/onscroll event
	        // where viewportOffset and viewportSize are unset
	        if (!viewportOffset || !viewportSize) {
	          return;
	        }
	        
	        if (elementOffset.top + elementSize.height > viewportOffset.top &&
	            elementOffset.top < viewportOffset.top + viewportSize.height &&
	            elementOffset.left + elementSize.width > viewportOffset.left &&
	            elementOffset.left < viewportOffset.left + viewportSize.width) {
	          visiblePartX = (viewportOffset.left > elementOffset.left ?
	            'right' : (viewportOffset.left + viewportSize.width) < (elementOffset.left + elementSize.width) ?
	            'left' : 'both');
	          visiblePartY = (viewportOffset.top > elementOffset.top ?
	            'bottom' : (viewportOffset.top + viewportSize.height) < (elementOffset.top + elementSize.height) ?
	            'top' : 'both');
	          visiblePartsMerged = visiblePartX + "-" + visiblePartY;
	          if (!inView || inView !== visiblePartsMerged) {
	            $element.data('inview', visiblePartsMerged).trigger('inview', [true, visiblePartX, visiblePartY]);
	          }
	        } else if (inView) {
	          $element.data('inview', false).trigger('inview', [false]);
	        }
	      }
	    }
	  }
	
	  $(w).bind("scroll resize", function() {
	    viewportSize = viewportOffset = null;
	  });
	  
	  // IE < 9 scrolls to focused elements without firing the "scroll" event
	  if (!documentElement.addEventListener && documentElement.attachEvent) {
	    documentElement.attachEvent("onfocusin", function() {
	      viewportOffset = null;
	    });
	  }
	
	  // Use setInterval in order to also make sure this captures elements within
	  // "overflow:scroll" elements or elements that appeared in the dom tree due to
	  // dom manipulation and reflow
	  // old: $(window).scroll(checkInView);
	  //
	  // By the way, iOS (iPad, iPhone, ...) seems to not execute, or at least delays
	  // intervals while the user scrolls. Therefore the inview event might fire a bit late there
	  setInterval(checkInView, 250);
	})(jQuery);	