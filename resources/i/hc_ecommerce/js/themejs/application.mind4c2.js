function display(e){}$(document).ready(function(){var t,n,a;$(window).load(function(){$("body").addClass("loaded")}),$("[data-toggle='tooltip']").tooltip().on("click",function(){$(this).tooltip("hide")}),$(".header-top-right .top-link > li").mouseenter(function(){$(".header-top-right .top-link > li.account").addClass("inactive")}),$(".header-top-right .top-link > li").mouseleave(function(){$(".header-top-right .top-link > li.account").removeClass("inactive")}),$(".header-top-right .top-link > li.account").mouseenter(function(){$(".header-top-right .top-link > li.account").removeClass("inactive")}),$(".collapsed-block .expander").click(function(e){var i=$(this).attr("href"),t=$(this);$(i).hasClass("open")?t.removeClass("open").html("<i class='fa fa-angle-down'></i>"):t.addClass("open").html("<i class='fa fa-angle-up'></i>"),$(i).hasClass("open")?$(i).removeClass("open").slideUp("normal"):$(i).addClass("open").slideDown("normal"),e.preventDefault()}),$("ul.yt-accordion li").each(function(){0<$(this).index()?$(this).children(".accordion-inner").css("display","none"):$(this).find(".accordion-heading").addClass("active");var e=navigator.userAgent.match(/iPad/i)?"touchstart":"click";$(this).children(".accordion-heading").bind(e,function(){$(this).addClass(function(){return $(this).hasClass("active")?"":"active"}),$(this).siblings(".accordion-inner").slideDown(350),$(this).parent().siblings("li").children(".accordion-inner").slideUp(350),$(this).parent().siblings("li").find(".active").removeClass("active")})}),$(".image-popup").magnificPopup({type:"image",closeOnContentClick:!0,image:{verticalFit:!1}}),$(".blog-listitem").magnificPopup({delegate:".popup-gallery",type:"image",tLoading:"Loading image #%curr%...",mainClass:"mfp-img-mobile",gallery:{enabled:!0,navigateByImgClick:!0,preload:[0,1]},image:{tError:'<a href="%url%">The image #%curr%</a> could not be loaded.',titleSrc:function(e){return e.el.attr("title")}}}),jQuery(function(i){"use strict";var e=i(".social-widgets .items .item"),t=0;e.each(function(){var e="item-0"+ ++t;i(this).addClass(e)})}),jQuery(function(t){"use strict";t(".social-widgets .item").each(function(){var i;t(this).on("mouseenter",function(){var e=t(this);i&&clearTimeout(i),i=setTimeout(function(){e.addClass("active")},200)}).on("mouseleave",function(){var e=t(this);i&&clearTimeout(i),i=setTimeout(function(){e.removeClass("active")},100)}).on("click",function(e){e.preventDefault()})})}),jQuery(function(t){"use strict";var e=t(".social-widgets .item a");e.click(function(e){e.preventDefault()}),e.hover(function(e){var i;t(this).parent().hasClass("load")||(i=t(this).parent().find(".loading"),t.ajax({url:t(this).attr("href"),cache:!1,success:function(e){setTimeout(function(){i.html(e)},1e3)}}),t(this).parent().addClass("load"))})}),$(".back-to-top").addClass("hidden-top"),$(window).scroll(function(){0===$(this).scrollTop()?$(".back-to-top").addClass("hidden-top"):$(".back-to-top").removeClass("hidden-top")}),$(".back-to-top").click(function(){return $("body,html").animate({scrollTop:0},1200),!1}),$("#slider").length&&(window.startRangeValues=[28,562],$("#slider").slider({range:!0,min:10,max:580,values:window.startRangeValues,step:.01,slide:function(e,i){var t=i.values[0].toFixed(2),n=i.values[1].toFixed(2),a=$(this).siblings(".range");a.children(".min_value").val(t).next().val(n),a.children(".min_val").text("$"+t).next().text("$"+n)},create:function(e,i){var t=$(this),n=t.slider("values",0).toFixed(2),a=t.slider("values",1).toFixed(2),s=t.siblings(".range");s.children(".min_value").val(n).next().val(a),s.children(".min_val").text("$"+n).next().text("$"+a)}})),window.startRangeValues&&(t=window.startRangeValues,n=t[0].toFixed(2),a=t[1].toFixed(2),$(".filter_reset").on("click",function(){var e=$(this).closest("form"),i=e.find(".range");console.log(t),e.find("#slider").slider("values",0,n),e.find("#slider").slider("values",1,a),e.find(".options_list").children().eq(0).children().trigger("click"),i.children(".min_value").val(n).next().val(a),i.children(".min_val").text("$"+n).next().text("$"+a)}))}),$(function(l){"use strict";var t,n,a;l.initQuantity=function(s){s.each(function(){var e=l(this),i=e.data("inited-control"),t=l(".input-group-addon:last",e),n=l(".input-group-addon:first",e),a=l(".form-control",e);i||(s.attr("unselectable","on").css({"-moz-user-select":"none","-o-user-select":"none","-khtml-user-select":"none","-webkit-user-select":"none","-ms-user-select":"none","user-select":"none"}).bind("selectstart",function(){return!1}),t.click(function(){var e=parseInt(a.val())+1;return a.val(e),!1}),n.click(function(){var e=parseInt(a.val())-1;return a.val(0<e?e:1),!1}),a.blur(function(){var e=parseInt(a.val());a.val(0<e?e:1)}))})},l.initQuantity(l(".quantity-control")),l.initSelect=function(e){e.each(function(){var n=l(this),e=n.data("inited-select"),a=l(".value",n),s=l(".input-hidden",n),i=l(".dropdown-menu li > a",n);e||(i.click(function(e){0<l(this).closest(".sort-isotope").length&&e.preventDefault();var i=l(this).attr("data-value"),t=l(this).html();n.trigger("change",{value:i,html:t}),a.html(t),s.length&&s.val(i)}),n.data("inited-select",!0))})},l.initSelect(l(".btn-select")),window.startRangeValues&&(t=window.startRangeValues,n=t[0].toFixed(2),a=t[1].toFixed(2),l(".filter_reset").on("click",function(){var e=l(this).closest("form"),i=e.find(".range");console.log(t),e.find("#slider").slider("values",0,n),e.find("#slider").slider("values",1,a),e.find(".options_list").children().eq(0).children().trigger("click"),i.children(".min_value").val(n).next().val(a),i.children(".min_val").text("$"+n).next().text("$"+a)}))}),$(document).ready(function(e){e(".date").datetimepicker({pickTime:!1}),e("img[usemap]").rwdImageMaps()}),$(document).ready(function(){$("#cat_accordion").cutomAccordion({eventType:"click",autoClose:!0,saveState:!0,disableLink:!0,speed:"slow",showCount:!1,autoExpand:!0,cookie:"dcjq-accordion-1",classExpand:"button-view"})}),$(function(){var e=new Date(2019,2,28);$(".defaultCountdown-30").countdown(e,function(e){$(this).html(e.strftime('<div class="time-item time-day"><div class="num-time">%D</div><div class="name-time">Day </div></div><div class="time-item time-hour"><div class="num-time">%H</div><div class="name-time">Hour </div></div><div class="time-item time-min"><div class="num-time">%M</div><div class="name-time">Min </div></div><div class="time-item time-sec"><div class="num-time">%S</div><div class="name-time">Sec </div></div>'))})}),$(document).ready(function(){}),$(document).ready(function(){$(".large-image img").elevateZoom({zoomType:"inner",lensSize:"200",easing:!0,gallery:"thumb-slider",cursor:"pointer",galleryActiveClass:"active"}),$("#thumb-slider .owl2-item").each(function(){$(this).find("[data-index='0']").addClass("active")}),$(".thumb-video").magnificPopup({type:"iframe",iframe:{patterns:{youtube:{index:"youtube.com/",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"}}}}),$(".product-options li.radio").click(function(){$(this).addClass(function(){return $(this).hasClass("active")?"":"active"}),$(this).siblings("li").removeClass("active"),$(this).parent().find(".selected-option").html('<span class="label label-success">'+$(this).find("img").data("original-title")+"</span>")}),$(".reviews_button,.write_review_button").click(function(){var e=$(".producttab").offset().top;$("html, body").animate({scrollTop:e},1e3)})});