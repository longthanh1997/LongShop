/****************************************
				jMap 1.0
		Auto Image Map Resizer
*****************************************/
!function(t){t.fn.jMap=function(){var a=this,r=function(){a.each(function(){if("undefined"!=typeof t(this).attr("usemap")){var a=t(this);t("<img />").load(function(){var r="width",i="height",n=a.attr(r),e=a.attr(i);n&&e||(n||(n=this.width),e||(e=this.height));var h=a.width()/100,s=a.height()/100,o=a.attr("usemap").replace("#",""),c="coords";t('map[name="'+o+'"] area').each(function(){var a=t(this);a.data(c)||a.data(c,a.attr(c));for(var r=a.data(c).split(","),i=new Array(r.length),o=0;o<i.length;++o)o%2===0?i[o]=parseInt(r[o]/n*100*h):i[o]=parseInt(r[o]/e*100*s);a.attr(c,i.toString())})}).attr("src",a.attr("src"))}})};return t(window).resize(r),r(),this}}(jQuery);
