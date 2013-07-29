if ($.browser.mozilla || $.browser.opera) {
  document.removeEventListener("DOMContentLoaded", $.ready, false);
  document.addEventListener("DOMContentLoaded", function() {
    $.ready()
  }, false)
}
$.event.remove(window, "load", $.ready);
$.event.add(window, "load", function() {
  $.ready()
});
$.extend({includeStates: {}, include: function(url, callback, dependency) {
    if (typeof callback != 'function' && !dependency) {
      dependency = callback;
      callback = null
    }
    url = url.replace('\n', '');
    $.includeStates[url] = false;
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.onload = function() {
      $.includeStates[url] = true;
      if (callback)
        callback.call(script)
    };
    script.onreadystatechange = function() {
      if (this.readyState != "complete" && this.readyState != "loaded")
        return;
      $.includeStates[url] = true;
      if (callback)
        callback.call(script)
    };
    script.src = url;
    if (dependency) {
      if (dependency.constructor != Array)
        dependency = [dependency];
      setTimeout(function() {
        var valid = true;
        $.each(dependency, function(k, v) {
          if (!v()) {
            valid = false;
            return false
          }
        });
        if (valid)
          document.getElementsByTagName('head')[0].appendChild(script);
        else
          setTimeout(arguments.callee, 10)
      }, 10)
    } else
      document.getElementsByTagName('head')[0].appendChild(script);
    return function() {
      return $.includeStates[url]
    }
  }, readyOld: $.ready, ready: function() {
    if ($.isReady)
      return;
    imReady = true;
    $.each($.includeStates, function(url, state) {
      if (!state)
        return imReady = false
    });
    if (imReady) {
      $.readyOld.apply($, arguments)
    } else {
      setTimeout(arguments.callee, 10)
    }
  }});


$(function() {
  $.fx.speeds._default = 1000;
  $(function() {
    $("#pro_dialog").dialog({
      autoOpen: false,
      show: "fade",
      hide: "fade",
      minWidth: 600,
      minHeight: 200
    });

    $("#pro_opener").click(function() {
      $("#pro_dialog").dialog("open");
      return false;
    });
  });
  $.fx.speeds._default = 1000;
  $(function() {
    $("#pro_dialog2").dialog({
      autoOpen: false,
      show: "fade",
      hide: "fade",
      minWidth: 600,
      minHeight: 200,
      modal: true
    });

    $("#pro_opener2").click(function() {
      $("#pro_dialog2").dialog("open");
      return false;
    });
  });
  $.fx.speeds._default = 1000;
  $(function() {
    $("#pro_dialog3").dialog({
      autoOpen: false,
      show: "fade",
      hide: "fade",
      modal: true
    });

    $("#pro_opener3").click(function() {
      $("#pro_dialog3").dialog("open");
      return false;
    });
  });
});
if ($("#pro_accordion").length) {
  $(function() {
    $("#pro_accordion").accordion();
  });
}
/**
 * jQuery Cycle
 * @returns {undefined}
 */
$(function() {
  function onAfter(curr, next, opts, fwd) {
    //get the height of the current slide
    var $ht = $(this).height();
    //set the container's height to that of the current slide
    $(this).parent().animate({height: $ht}, 200);
  }
  ;
});
$(function() {
  $('#pro_slideshow1').cycle();

  var fx;

  $('#pro_choices li').click(function() {
    fx = $.trim($(this).text());
    $(this).parent('#pro_choices').find('li').removeClass('active');
    $(this).addClass('active')
    start();
  });

  var markup = '<div id="pro_slideshow">'
          + '<img src="images/stock_images/700x430_5.jpg"><img src="images/stock_images/700x430_6.jpg"><img src="images/stock_images/700x430_7.jpg"><img src="images/stock_images/700x430_8.jpg">'
          + '</div>';
  function start() {
    $('#pro_slideshow').cycle('stop').remove();
    $('#pro_show1').css({display: 'none'});
    $('#pro_slideshow1').cycle('stop')
    $('#pro_show').append(markup).css({display: 'block'});
    $('#pro_effect').html('Slideshow with effect &ndash; ' + fx);
    $('#pro_slideshow').cycle({
      fx: fx,
      timeout: 6000,
      delay: -1000
    });
  }
});

/**
 * Utilities
 * @returns {undefined}
 */

$(function() {
  $('.sf-menu').superfish({speed: 'fast'});
  $('.pro_menu').superfish({speed: 'fast'});
  /**
   * Twitter
   */
  if ($('.pro_tweet').length) {
    jQuery(function($) {
      $(".pro_tweet").tweet({username: "templatehelpcom", join_text: "auto", count: 3, auto_join_text_default: "we said,", auto_join_text_ed: "we", auto_join_text_ing: "we were", auto_join_text_reply: "we replied to", auto_join_text_url: "we were checking out", loading_text: "loading tweets..."});
    });
  }
  /**
   * Lightbox Images
   */
  if ($('.lightbox-image').length) {
    jQuery(function($) {
      $('.lightbox-image').prettyPhoto({theme: 'facebook', autoplay_slideshow: false, social_tools: false, animation_speed: 'fast'}).append('<span></span>').hover(function() {
        $(this).find('>img').stop().animate({opacity: .5})
      }, function() {
        $(this).find('>img').stop().animate({opacity: 1})
      })
    });
  }
  /**
   * Newsletter Form
   */
  if ($('#pro_newsletter').length) {
    $(window).load(function() {
      $('#pro_newsletter').sForm({ownerEmail: '#', sitename: 'sitename.link'})
    })
  }
  /**
   * Contact form 1
   */
  if ($('#pro_contact-form').length) {
    $(window).load(function() {
      $('#pro_contact-form').forms({ownerEmail: '#'})

    })
  }
  /**
   * Contact form 2
   */
  if ($('#form1').length) {
    $('#form1').forms({ownerEmail: '#'})
  }
  /**
   * Kwicks Slider
   */
  if ($('.pro_kwicks').length) {
    $(function() {
      $('.pro_kwicks').kwicks({max: 900, spacing: 0});
      $('.pro_kwicks li').hover(function() {
        $(this).find('.pro_kwicks-banner').stop().animate({bottom: '10px'}, 500)
      }, (function() {
        $(this).find('.pro_kwicks-banner').stop().animate({bottom: '-27px'}, 500)
      }))
    })
  }
  /**
   * Comming soon counter
   */
  if ($('#pro_counter').length) {
    $(document).ready(function() {
      var _date = new Date()
              , countdown_to = {
        year: 2013
                , month: 5 /* January = 0, February = 1, March = 2, April = 3, May = 4, June = 5, July = 6, August = 7, September = 8, October = 9, November = 10, December = 11 */
                , date: 27
                , hours: 0
                , minutes: 15
                , seconds: 00
      }

      _date.setFullYear(countdown_to.year, countdown_to.month, countdown_to.date)
      _date.setHours(countdown_to.hours)
      _date.setMinutes(countdown_to.minutes)
      _date.setSeconds(countdown_to.seconds)

      /*code for demonstration*/
      _date = new Date()
      _date.setMonth(_date.getMonth() + 1)
      console.log(_date);
      /*end code for demonstration*/

      $('#pro_counter').countdown({
        image: 'assests/images/pro_images/digits.png',
        startTime: _date
      });
    });
  }
  /**
   * Tool Tip
   */
  if ($('.fixedtip').length || $('.clicktip').length || $('.normaltip').length) {
    $(function() {
      $('.normaltip').aToolTip();
      $('.fixedtip').aToolTip({fixed: true});
      $('.clicktip').aToolTip({clickIt: true, tipContent: 'ToolTip with content from param'});
    });
  }

  $("pre.pro_htmlCode2").snippet("html", {style: "print", showNum: false, menu: false});
  $("pre.pro_jsCode2").snippet("javascript", {style: "print", showNum: false, menu: false});
  $(".pro_description-box dd").show()
  $("pre.pro_htmlCode").snippet("html", {style: "print"});
  $("pre.pro_cssCode").snippet("css", {style: "print"});
  $("pre.pro_jsCode").snippet("javascript", {style: "print"});
  $(".pro_description-box dd").hide()
  $(".pro_description-box dt").click(function() {
    $(this).toggleClass("active").parent(".pro_description-box").find("dd").slideToggle(400);
  });
  $(".pro_slide-down-box dt").click(function() {
    $(this).toggleClass("active").parent(".pro_slide-down-box").find("dd").slideToggle(200);
  });
  $(".pro_slide-down-box2 dt").click(function() {
    $(this).toggleClass("active").parent(".pro_slide-down-box2").find("dd").slideToggle(200);
  });
  $(".pro_tabs1 ul").tabs(".pro_tabs1 .pro_tab-content");
  $(".pro_tabs2 ul").tabs(".pro_tabs2 .pro_tab-content");
  $(".pro_tabs3 ul").tabs(".pro_tabs3 .pro_tab-content");
  $(".pro_tabs4 ul").tabs(".pro_tabs4 .pro_tab-content");
  $(".pro_tabs5 ul").tabs(".pro_tabs5 .pro_tab-content");
  $(".pro_tabs-horz-top ul.pro_tabs-nav").tabs(".pro_tabs-horz-top .pro_tab-content");
  $(".pro_tabs-horz-bottom ul.pro_tabs-nav").tabs(".pro_tabs-horz-bottom .pro_tab-content");
  $(".pro_tabs-horz-top2 ul.pro_tabs-nav").tabs(".pro_tabs-horz-top2 .pro_tab-content");
  $(".pro_tabs-horz-bottom2 ul.pro_tabs-nav").tabs(".pro_tabs-horz-bottom2 .pro_tab-content");
  $(".pro_tabs-vert-left ul.pro_tabs-nav").tabs(".pro_tabs-vert-left .pro_tab-content");
  $(".pro_tabs-vert-right ul.pro_tabs-nav").tabs(".pro_tabs-vert-right .pro_tab-content");
  $('#pro_form2').jqTransform({imgPath: 'images/'});
  $('.pro_list-car').uCarousel({show: 4, buttonClass: 'pro_car-button', pageStep: 1, shift: false})
  $('.pro_carousel').uCarousel({show: 4, buttonClass: 'pro_car-button'})
  $('.pro_slider')._TMS({show: 0, pauseOnHover: false, prevBu: '.pro_prev', nextBu: '.pro_next', playBu: '.pro_play', items: '.pro_items>li', duration: 1000, preset: 'simpleFade', bannerCl: 'pro_banner', numStatusCl: 'pro_numStatus', pauseCl: 'pro_paused', pagination: true, paginationCl: 'pro_pagination', pagNums: false, slideshow: 7000, numStatus: true, banners: 'fade', waitBannerAnimation: false, progressBar: '<div class="pro_progbar"></div>'})
  $('.pro_simple_gallery')._TMS({show: 0, pauseOnHover: true, prevBu: false, nextBu: false, playBu: false, pagNums: false, numStatus: false, duration: 1000, preset: 'simpleFade', items: '.pro_items>li', bannerCl: 'pro_banner', pagination: $('.pro_img-pags').uCarousel({show: 10, shift: 0, buttonClass: 'pro_btn'}), paginationCl: 'pro_gal-pags', slideshow: 5000, banners: 'fade', waitBannerAnimation: false, progressBar: '<div class="pro_progbar"></div>'})
  $("#pro_font-size-slider").change(function(e) {
    $(".pro_icons.pro_basic li a").css("font-size", $(this).val() + "px");
  });
  $(".pro_color-slider").change(function(e) {
    $(".pro_icons.pro_basic li a").css("color", "hsla(" + $("#pro_color-slider-1").val() + ", " + $("#pro_color-slider-2").val() + "%, " + $("#pro_color-slider-3").val() + "%, 1)");
  });
  $(".pro_shadow-slider").change(function(e) {
    $(".pro_icons.pro_basic li a").css("text-shadow", $("#pro_shadow-slider-1").val() + "px " + $("#pro_shadow-slider-2").val() + "px " + $("#pro_shadow-slider-3").val() + "px black");
  });
  $('#pro_testimonials').cycle({fx: 'fade', height: 'auto', timeout: 0, next: '#pro_next_testim', prev: '#pro_prev_testim', after: onAfter});
  $(".pro_notClicked").click(function(event) {
    event.preventDefault();
  });
})
$(function() {
  if ($("#pro-search-btn").length) {
    $("#pro-search-btn").on('click', function(event) {
      document.getElementById('pro_search').submit();
    });
  }
  $("#click_me").on('click', function(event) {
    event.preventDefault();
    $.get("/blog/crud", null, function(status) {
      var response = $.parseJSON(status)
      if (response.result == true) {
        console.log(response.data)
      } else {
        console.log(response);
      }
    });
  });
  //$('body').prepend('<div id="advanced"><span class="trigger"><strong></strong><em></em></span><div class="bg_pro"><div class="pro_main"><span class="pro_logo"></span><ul class="pro_menu"><li><a href="index.html"><img src="assests/images/pro_images/pro_home.png" alt=""></a></li><li><a href="404.html">Pages<span></span></a><ul>	<li><a href="under_construction.html">Under Construction</a></li><li><a href="intro.html">Intro Page</a></li><li><a href="404.html">404 page</a></li></ul></li><li><a href="layouts.html">Layouts</a></li><li><a href="typography.html">Typography</a></li><li><a href="portfolio.html">Gallery Layouts<span></span></a><ul><li><a href="portfolio.html">Portfolio</a></li><li><span></span><a href="just-slider.html">Sliders</a><ul><li><a href="just-slider.html">Just Slider</a></li><li><a href="kwicks.html">Kwicks Slider</a></li><li><a href="functional-slider.html">Functional Slider</a></li></ul></li><li><a href="gallery-page1.html">Gallery</a></li></ul></li><li><a href="misc.html">Extras<span></span></a><ul><li><a href="social_media.html">Social and Media<br> Sharing</a></li><li><a href="css3.html">CSS3 Tricks</a></li><li><a href="misc.html">Misc</a></li></ul></li></ul><div class="pro_clear"></div></div></div><div class="bg_pro2"></div></div>');
  $(window).scroll(function() {
    if ($(this).scrollTop() > 0) {
      $("#advanced").css({position: 'fixed'});
    } else {
      $("#advanced").css({position: 'relative'});
    }
  });
  $.cookie("panel");
  $.cookie("panel2");
  var strCookies = $.cookie("panel");
  var strCookies2 = $.cookie("panel2");
  if (strCookies == 'boo')
  {
    if (strCookies2 == 'opened') {
      $("#advanced").css({marginTop: '0px'}).removeClass('closed')
    } else {
      $("#advanced").css({marginTop: '-40px'}).addClass('closed')
    }
    $("#advanced .trigger").toggle(function() {
      $(this).find('strong').animate({opacity: 0}).parent().parent('#advanced').removeClass('closed').animate({marginTop: '0px'}, "fast");
      strCookies2 = $.cookie("panel2", 'opened');
      strCookies = $.cookie("panel", null);
    }, function() {
      $(this).find('strong').animate({opacity: 1}).parent().parent('#advanced').addClass('closed').animate({marginTop: '-40px'}, "fast")
      strCookies2 = $.cookie("panel2", null);
      strCookies = $.cookie("panel", 'boo');
    });
    if ($(window).scrollTop() > 0) {
      $("#advanced").css({position: 'fixed'});
    } else {
      $("#advanced").css({position: 'relative'});
    }
  }
  else
  {
    $("#advanced").css({marginTop: '0px'}).removeClass('closed');
    $("#advanced .trigger").toggle(function() {
      $(this).find('strong').animate({opacity: 1}).parent().parent('#advanced').addClass('closed').animate({marginTop: '-40px'}, "fast");
      strCookies2 = $.cookie("panel2", null);
      strCookies = $.cookie("panel", 'boo');
    }, function() {
      $(this).find('strong').animate({opacity: 0}).parent().parent('#advanced').removeClass('closed').animate({marginTop: '0px'}, "fast")
      strCookies2 = $.cookie("panel2", 'opened');
      strCookies = $.cookie("panel", null);
    });
    if ($(window).scrollTop() > 0) {
      $("#advanced").css({position: 'fixed'});
    } else {
      $("#advanced").css({position: 'relative'});
    }
  }
  $('.slider')._TMS({show: 0, pauseOnHover: false, duration: 10000, preset: 'zoomer', pagination: true, pagNums: false, slideshow: 7000, numStatus: false, banners: 'fade', waitBannerAnimation: false})
  $("img.grey").hover(function() {
    $(this).stop().animate({"opacity": "0"}, "slow");
  }, function() {
    $(this).stop().animate({"opacity": "1"}, "slow");
  });
  $().UItoTop({easingType: 'easeOutQuart'});
});
function onAfter(curr, next, opts, fwd) {
  var $ht = $(this).height();
  $(this).parent().animate({height: $ht})
}