(function ($) {

    'use strict';

	$('a[href=\\#]').on('click', function (e) {
		e.preventDefault();
	})

    var Fasheno = {

        _init: function () {

            var offCanvas = {
                menuBar: $('.trigger-off-canvas'),
                drawer: $('.fasheno-offcanvas-drawer'),
                drawerClass: '.fasheno-offcanvas-drawer',
                menuDropdown: $('.dropdown-menu.depth_0'),
            };

            Fasheno.menuDrawerOpen(offCanvas);
            Fasheno.offcanvasMenuToggle(offCanvas);
            Fasheno.headerSearchOpen();
            Fasheno.headerTopbar();
            Fasheno.rtCategorySearchDropdown();
            Fasheno.backToTop();
            Fasheno.pricingTab();
            Fasheno.preLoader();
            Fasheno.menuOffset();
            Fasheno.AjaxSearch();
            Fasheno.headRoom();
            Fasheno.wow();
            Fasheno.rtElementorParallax();
            Fasheno.rtAnimatedHeadline();
            Fasheno.rtCountDown();
            Fasheno.magnificPopup();
            Fasheno.imageFunction();
            Fasheno.hasAnimation();
            Fasheno.rtMasonary();
            Fasheno.rtIsotope();
			Fasheno.rtOpenTabs();
			Fasheno.heroSlider();
			Fasheno.swiperSlider($);
			Fasheno.horizontalSwiperSlider();
        },

		rtElementorParallax: function () {
			if ($(".rt-parallax-bg-yes").length) {
				$(".rt-parallax-bg-yes").each(function () {
					var speed = $(this).data('speed');
					$(this).parallaxie({
						speed: speed ? speed : 0.5,
						offset: 0,
					});
				})
			}
		},

		rtAnimatedHeadline: function () {
			if ($(".rt-animated-headline").length) {
				$('.rt-animated-headline').animatedHeadline({
					animationType: 'clip'
				});
			}
			$(window).on('load', function (){
				$('.ah-words-wrapper p:first-child').addClass('is-visible');
			});
		},

		rtCountDown: function () {
			$('.countdown').each(function () {
				var date = $(this).data('date');
				$(this).countdown(date, function (event) {
					var $this = $(this).html(event.strftime("<div class='countdown-section'><div class='countdown-number'>%D</div> <div class='countdown-unit'>" + fashenoObj.day + "%!D</div> </div><div class='countdown-section'><div class='countdown-number'>%H</div> <div class='countdown-unit'>" + fashenoObj.hour + "%!H</div> </div><div class='countdown-section'><div class='countdown-number'>%M</div> <div class='countdown-unit'>" + fashenoObj.minute + "%!M</div> </div><div class='countdown-section'><div class='countdown-number'>%S</div> <div class='countdown-unit'>" + fashenoObj.second + "%!S</div> </div>"));
				});
			});
		},

		rtCategorySearchDropdown: function () {
			$('.category-search-dropdown-js .dropdown-menu li').on('click', function (e) {
				var root_parent = $(this).parents('.product-search');
				var $parent = $(this).closest('.category-search-dropdown-js'),
					slug = $(this).data('slug'),
					name = $(this).text();
				$parent.find('.cat-toggle .cat-label').text($.trim(name));
				$parent.find('input[name="product_cat"]').val(slug);
				root_parent.find('.product-autocomplete-js').data('tax', slug);
				root_parent.find('.product-autocomplete-js').trigger('keyup');
			});

			$(document).on('keyup', '.product-autocomplete-js', function () {

				var root_parent = $(this).parents('.product-search');
				var keyword = root_parent.find('.product-autocomplete-js').val();
				var taxonomy = root_parent.find('.product-autocomplete-js').data('tax');

				if ( keyword.length > 1 ) {
					$.ajax({
						url: fashenoObj.ajaxURL,
						type: 'POST',
						data: {
							'action': 'fasheno_product_search_autocomplete',
							'category_val': taxonomy,
							'keyword': keyword,
						},
						beforeSend: function () {
							root_parent.find('.product-autoaomplete-spinner').css('opacity', '1');
						},
						success: function (data) {
							root_parent.find('.result').html(data);
						},
						complete: function () {
							root_parent.find('.product-autoaomplete-spinner').css('opacity', '0');
						}
					});
				} else {
					root_parent.find('.result').empty();
				}
			});

			$(document).on('click', function (e) {
				var t = e.srcElement || e.target;
				if ($(t).attr('class')) {
					$('.result-wrap').remove();
				} else {

				}
			});

		},

        magnificPopup: function (){
            var yPopup = $(".popup-youtube");
            if (yPopup.length) {
                yPopup.magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false
                });
            }
        },

		imageFunction: function () {
			$("[data-bg-image]").each(function () {
				let img = $(this).data("bg-image");
				$(this).css({
					backgroundImage: "url(" + img + ")",
				});
			});
		},

		// headRoom js
		headRoom: function () {
			if ($('body').hasClass('has-sticky-header')) {
				var myElement = document.querySelector(".headroom");
				var headroom = new Headroom(myElement);
				headroom.init();

				$(window).on('scroll', function () {
					var height = $(window).scrollTop();
					if (height < 86) {
						$('.site-header').removeClass('scrolling');
					} else {
						$('.site-header').addClass('scrolling');
					}
				});

				var intHeight = $('.headroom')[0].getBoundingClientRect().height;
				$('.fixed-header-space').height(intHeight);
			}
		},

		wow: function () {
			var wow = new WOW({
				boxClass: 'wow',
				animateClass: 'animated',
				offset: 0,
				mobile: false,
				live: true,
				scrollContainer: null,
			});
			wow.init();
		},

		// Ajax search 1
        AjaxSearch: function () {
			if ($(".rt-hero-section-search").length) {
				$(".rt-hero-section-search").focusin(function () {
					$('body').addClass('rt-search-active');
					$(this).css('z-index', '100')
				});
				$(".rt-hero-section-search").focusout(function () {
					$('body').removeClass('rt-search-active');
					$(this).attr('style', '')
				});
			}
			//nice-select
			if ($(".rt-search-box-form").length) {
				$('select').niceSelect();
			}
			// Search ajax
			if ($("#rt_datafetch").length) {
				$('#searchInput').on('keyup', function () {
					fetchResults();
				});
				$(document).on('fasheno_search_input_change', function () {
					fetchResults();
					$('#searchInput').focus();
				});
				function fetchResults() {
					var keyword = $('#searchInput').val();
					var meta = $('#categories').val();
					var searchkey = $('.rt-addon-search .keyword a').val();
					var searchTerm = $('#searchInput').val();
					$('#cleanText').on('click', function () {
						$('#searchInput').val('');
						$('.rt-search-box-container').removeClass('rt-search-container');
					});
					if (searchTerm.length > 0) {
						$('.rt-search-box-container').addClass('rt-search-container');

					} else {
						$('.rt-search-box-container').removeClass('rt-search-container');
					}

					if (keyword.length < 3) {
						$('#rt_datafetch').html("<span class='letters'>Minimum 3 Latters</span>");
						return;
					}
					$.ajax({
						url: fashenoObj.ajaxURL,
						type: 'post',
						data: {
							action: 'rt_data_fetch',
							security: fashenoObj.fashenoNonce,
							keyword: keyword,
							meta: meta,
							searchkey: searchkey,
						},
						success: function (data) {
							$('#rt_datafetch').html(data);
						}
					});
				}
				//Search Keyword
				$(".rt-addon-search .keyword").on("click", function () {
					var keyword = $(this).text();
					$('.rt-input-wrap #searchInput').val(keyword);
					$(document).trigger('fasheno_search_input_change');
				});

			}

			$('form.rt-search-box-form').on('submit', function (e){
				e.preventDefault();
				var $form = $(this);
				var catLink = $form.find('select[name=categories]').val();
				var searchValue = $form.find('input.search-box-input').val();
				if(catLink) {
					var newUrl = new URL(catLink);
					if(searchValue){
						newUrl.searchParams.set('s', searchValue);
					}
					window.location = newUrl.toString();
				}else{
					if(searchValue){
						$form[0].submit();
					}
				}
			})
        },

		menuOffset: function () {
            $(".dropdown-menu > li").each(function () {
                var $this = $(this),
                    $win = $(window);

                if ($this.offset().left + ($this.width() + 30) > $win.width() + $win.scrollLeft() - $this.width()) {
                    $this.addClass("dropdown-inverse");
                } else if ($this.offset().left < ($this.width() + 30)) {
                    $this.addClass("dropdown-inverse-left");
                } else {
                    $this.removeClass("dropdown-inverse");
                }
            });
        },

		/* Masonary */
		rtMasonary: function () {
			var gridIsoContainer = $(".rt-masonry-grid");
			if (gridIsoContainer.length) {
				var imageGallerIso = gridIsoContainer.imagesLoaded(function () {
					imageGallerIso.isotope({
						itemSelector: ".rt-grid-item",
						percentPosition: true,
						isAnimated: true,
						masonry: {
							columnWidth: ".rt-grid-item",
							horizontalOrder: true
						},
						animationOptions: {
							duration: 700,
							easing: 'linear',
							queue: false
						}
					});
				});
			}
		},

		/* Isotope */
		rtIsotope: function () {
			if (typeof $.fn.isotope == 'function') {
				var $parent = $('.rt-isotope-wrapper'),
					$isotope;
				var blogGallerIso = $(".rt-isotope-content", $parent).imagesLoaded(function () {
					$isotope = $(".rt-isotope-content", $parent).isotope({
						filter: "*",
						transitionDuration: "1s",
						hiddenStyle: {
							opacity: 0,
							transform: "scale(0.001)"
						},
						visibleStyle: {
							transform: "scale(1)",
							opacity: 1
						}
					});
					$('.rt-isotope-tab a').on('click', function () {
						var $parent = $(this).closest('.rt-isotope-wrapper'),
							selector = $(this).attr('data-filter');
						$parent.find('.rt-isotope-tab .current').removeClass('current');
						$(this).addClass('current');
						$isotope.isotope({
							filter: selector
						});

						return false;
					});

					$(".hide-all .rt-isotope-tab a").first().trigger('click');
				});
			}
		},

        menuDrawerOpen: function (offCanvas) {
            offCanvas.menuBar.on('click', e => {
                e.preventDefault();
                offCanvas.menuBar.toggleClass('is-open')
                offCanvas.drawer.toggleClass('is-open');
                e.stopPropagation()
            });

            $(document).on('click', e => {
                if (!$(e.target).closest(offCanvas.drawerClass).length) {
                    offCanvas.drawer.removeClass('is-open');
                    offCanvas.menuBar.removeClass('is-open')
                }
            });
        },

        offcanvasMenuToggle: function (offCanvas) {
            offCanvas.drawer.each(function () {
                const caret = $(this).find('.caret');
                caret.on('click', function (e) {
                    e.preventDefault();
                    $(this).closest('li').toggleClass('is-open');
                    $(this).parent().next().slideToggle(300);
                })
            })
        },

        headerSearchOpen: function () {
			$('a[href="#header-search"]').on("click", function (event) {
				event.preventDefault();
				$("#header-search").addClass("open");
				$('#header-search > form > input[type="search"]').focus();
			});

			$("#header-search, #header-search button.close").on("click keyup", function (event) {
				if (
					event.target === this ||
					event.target.className === "close" ||
					event.keyCode === 27
				) {
					$(this).removeClass("open");
				}
			});
        },

		headerTopbar: function () {
			$(".fasheno-top-bar .close").on("click", function (event) {
				event.preventDefault();
				$(".fasheno-top-bar").addClass("close").slideUp(500);
			});
		},

        backToTop: function () {
            /* Scroll to top */
            $('.scrollToTop').on('click', function () {
                $('html, body').animate({scrollTop: 0}, 800);
                return false;
            });
        },

		/* windrow back to top scroll */
        backTopTopScroll: function () {
            if ($(window).scrollTop() > 100) {
                $('.scrollToTop').addClass('show');
            } else {
                $('.scrollToTop').removeClass('show');
            }
        },

  		/* Pricing Switch */
		pricingTab: function () {
			$(".pricing-switch-container").on("click", function () {
				let $this = $(this);
				let $wrapper = $this.closest('.rt-pricing-tab');
				$wrapper.find(".pricing-switch")
					.parents(".price-switch-box")
					.toggleClass("price-switch-box--active");
				$wrapper.find(".pricing-switch").toggleClass("pricing-switch-active");
				$wrapper.find(".price-box").toggleClass("price-box-show price-box-hide");
			});
		},

		/* preloader */
		preLoader: function () {
			$('#preloader').fadeOut('slow', function () {
				$(this).remove();
			});
		},

		/* Tab action */
		rtOpenTabs: function () {
			var TabBlock = {
				s: {
					animLen: 500
				},

				init: function() {
					TabBlock.bindUIActions();
					TabBlock.hideInactive();
				},

				bindUIActions: function() {
					$('.tab-block-tabs').on('click', '.tab-block-tab', function(){
						TabBlock.switchTab($(this));
					});
				},

				hideInactive: function() {
					var $tabBlocks = $('.tab-block');
					$tabBlocks.each(function(i) {
					var
						$tabBlock = $($tabBlocks[i]),
						$panes = $tabBlock.find('.tab-block-pane'),
						$activeTab = $tabBlock.find('.tab-block-tab.is-active');
						$panes.hide();
						$($panes[$activeTab.index()]).show();
					});
				},

				switchTab: function($tab) {
					var $context = $tab.closest('.tab-block');
					if (!$tab.hasClass('is-active')) {
						$tab.siblings().removeClass('is-active');
						$tab.addClass('is-active');
						TabBlock.showPane($tab.index(), $context);
					}
				},

				showPane: function(i, $context) {
					var $panes = $context.find('.tab-block-pane');
					$panes.slideUp(TabBlock.s.animLen);
					$($panes[i]).slideDown(TabBlock.s.animLen);
				}
			};

			$(function() {
				TabBlock.init();
			});
		},

		/* windrow scroll animation */
		hasAnimation: function () {
			if (!!window.IntersectionObserver) {
				let observer = new IntersectionObserver((entries, observer) => {
					entries.forEach(entry => {
						if (entry.isIntersecting) {
							entry.target.classList.add("active-animation");
							observer.unobserve(entry.target);
						}
					});
				}, {
					rootMargin: "0px 0px -100px 0px"
				});
				document.querySelectorAll('.has-animation').forEach(block => {
					observer.observe(block)
				});
			} else {
				document.querySelectorAll('.has-animation').forEach(block => {
					block.classList.remove('has-animation')
				});
			}
		},

		/* Swiper slider */
		swiperSlider: function () {
			$('.rt-swiper-slider').each(function () {
				var $this = $(this);
				var settings = $this.data('xld');
				var autoplayconditon = settings['auto'];
				var $pagination = $this.find('.swiper-pagination')[0];
				var $next = $this.find('.swiper-button-next')[0];
				var $prev = $this.find('.swiper-button-prev')[0];
				var swiper = new Swiper(this, {
					autoplay: autoplayconditon ? { delay:settings['autoplay']['delay'] } : false,
					speed: settings['speed'],
					loop: settings['loop'],
					pauseOnMouseEnter: true,
					effect: typeof settings['effect'] == "undefined" ? 'slide' : settings['effect'],
					slidesPerView: settings['slidesPerView'],
					spaceBetween: settings['spaceBetween'],
					centeredSlides: settings['centeredSlides'],
					slidesPerGroup: settings['slidesPerGroup'],
					pagination: {
						el: $pagination,
						clickable: true,
						type: 'bullets',
					},
					navigation: {
						nextEl: $next,
						prevEl: $prev,
					},
					scrollbar: {
						el: '.swiper-scrollbar',
						draggable: true,
					},
					breakpoints: {
						0: {
							slidesPerView: settings['breakpoints']['0']['slidesPerView'],
						},
						425: {
							slidesPerView: settings['breakpoints']['425']['slidesPerView'],
						},
						576: {
							slidesPerView: settings['breakpoints']['576']['slidesPerView'],
						},
						768: {
							slidesPerView: settings['breakpoints']['768']['slidesPerView'],
						},
						992: {
							slidesPerView: settings['breakpoints']['992']['slidesPerView'],
						},
						1200: {
							slidesPerView: settings['breakpoints']['1200']['slidesPerView'],
						},
						1600: {
							slidesPerView: settings['breakpoints']['1600']['slidesPerView'],
						},
					},
				});
				swiper.init();
			});
		},

		/* Horizontal Thumbnail slider */
		horizontalSwiperSlider: function () {
			$('.rt-horizontal-slider').each(function () {
				var slider_wrap = $(this);
				var $pagination = slider_wrap.find('.swiper-pagination')[0];
				var $next = slider_wrap.find('.swiper-button-next')[0];
				var $prev = slider_wrap.find('.swiper-button-prev')[0];
				var target_thumb_slider = slider_wrap.find('.horizontal-thumb-slider');
				var thumb_slider = null;
				if (target_thumb_slider.length) {
					var settings = target_thumb_slider.data('xld');
					var autoplayconditon = settings['auto'];
					thumb_slider = new Swiper(target_thumb_slider[0],
						{
							autoplay: autoplayconditon ? { delay:settings['autoplay']['delay'] } : false,
							speed: settings['speed'],
							loop: settings['loop'],
							pauseOnMouseEnter: true,
							slidesPerView: settings['slidesPerView'],
							spaceBetween: settings['spaceBetween'],
							centeredSlides: settings['centeredSlides'],
							slidesPerGroup: settings['slidesPerGroup'],
							pagination: {
								el: $pagination,
								clickable: true,
								type: 'bullets',
							},
							navigation: {
								nextEl: $next,
								prevEl: $prev,
							},
							breakpoints: {
								0: {
									slidesPerView: settings['breakpoints']['0']['slidesPerView'],
								},
								425: {
									slidesPerView: settings['breakpoints']['425']['slidesPerView'],
								},
								576: {
									slidesPerView: settings['breakpoints']['576']['slidesPerView'],
								},
								768: {
									slidesPerView: settings['breakpoints']['768']['slidesPerView'],
								},
								992: {
									slidesPerView: settings['breakpoints']['992']['slidesPerView'],
								},
								1200: {
									slidesPerView: settings['breakpoints']['1200']['slidesPerView'],
								},
								1600: {
									slidesPerView: settings['breakpoints']['1600']['slidesPerView'],
								},
							},

						});
				}

				var target_slider = slider_wrap.find('.horizontal-slider');
				if (target_slider.length) {
					var settings = target_slider.data('xld');
					new Swiper(target_slider[0], {
						autoplay: autoplayconditon ? { delay:settings['autoplay']['delay'] } : false,
						speed: settings['speed'],
						loop: settings['loop'],
						effect: settings && settings['effect'],
						thumbs: {
							swiper: thumb_slider,
						},
						navigation: {
							nextEl: $next,
							prevEl: $prev,
						},
					});
				}
			});
		},

		/* Swiper slider */
		heroSlider: function () {
			let swiperAnimation = new SwiperAnimation();
			$('.rt-swiper-hero-slider').each(function () {
				var $this = $(this);
				var settings = $this.data('xld');
				var autoplayconditon = settings['auto'];
				var $pagination = $this.find('.swiper-pagination')[0];
				var $next = $this.find('.swiper-button-next')[0];
				var $prev = $this.find('.swiper-button-prev')[0];
				var swiper = new Swiper(this, {
					autoplay: autoplayconditon ? { delay:settings['autoplay']['delay'] } : false,
					speed: settings['speed'],
					loop: settings['loop'],
					pauseOnMouseEnter: true,
					effect: typeof settings['effect'] == "undefined" ? 'slide' : settings['effect'],
					slidesPerView: settings['slidesPerView'],
					spaceBetween: settings['spaceBetween'],
					centeredSlides: settings['centeredSlides'],
					slidesPerGroup: settings['slidesPerGroup'],
					parallax: true,
					on: {
						init: function () {
							let swiper = this;
							for (let i = 0; i < swiper.slides.length; i++) {
								$(swiper.slides[i])
									.find('.img-container')
									.attr({
										'data-swiper-parallax': 0.75 * swiper.width,
										'data-swiper-paralalx-opacity': 0.5
									});
							}
							let index = swiper.activeIndex;
							$(swiper.slides).removeClass('active');
							$(swiper.slides[index]).addClass('active');

							swiperAnimation.init(this).animate();
						},
						transitionEnd: function () {
							let swiper = this;
							let index = swiper.activeIndex;
							$(swiper.slides).removeClass('active');
							$(swiper.slides[index]).addClass('active');
						},
						resize: function () {
							this.update();
						},
						slideChange: function () {
							swiperAnimation.init(this).animate();
						}
					},
					pagination: {
						el: $pagination,
						clickable: true,
						renderBullet: function (index, className) {
							return '<span class="' + className + '">' + 0 + (index + 1) + "</span>";
						},
					},
					navigation: {
						nextEl: $next,
						prevEl: $prev,
					},
					scrollbar: {
						el: '.swiper-scrollbar',
						draggable: true,
					},

					breakpoints: {
						0: {
							slidesPerView: 1,
						},
						768: {
							slidesPerView: 1,
						},
						1200: {
							slidesPerView: 1,
						},
					},
				});
				swiper.init();
			});
		},
    };

    $(document).ready(function (e) {
        Fasheno._init();
    });

    $(document).on('load', () => {
        Fasheno.menuOffset();
    })

    $(window).on('scroll', (event) => {
        Fasheno.backTopTopScroll(event);
    });

    $(window).on('resize', () => {
        Fasheno.menuOffset($);
    });

    $(window).on('elementor/frontend/init', () => {
        if (elementorFrontend.isEditMode()) {
            //For all widgets
            elementorFrontend.hooks.addAction('frontend/element_ready/widget', () => {
                Fasheno.AjaxSearch();
                Fasheno.rtElementorParallax();
				Fasheno.rtAnimatedHeadline();
				Fasheno.rtCountDown();
				Fasheno.rtCategorySearchDropdown();
                Fasheno.magnificPopup();
				Fasheno.hasAnimation();
				Fasheno.pricingTab();
				Fasheno.imageFunction();
				Fasheno.rtMasonary();
				Fasheno.rtIsotope();
				Fasheno.rtOpenTabs();
				Fasheno.heroSlider();
				Fasheno.swiperSlider($);
				Fasheno.horizontalSwiperSlider();
            });

        }
    });

    window.Fasheno = Fasheno;

})(jQuery);
