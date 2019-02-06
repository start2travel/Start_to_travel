  var multi=function(){var e=function(e,t,n){var a=e.options[t.target.getAttribute("multi-index")];if(!a.disabled){a.selected=!a.selected;var i,d,r,l=n.limit;if(l>-1){for(var s=0,o=0;o<e.options.length;o++)e.options[o].selected&&s++;if(s===l){this.disabled_limit=!0,"function"==typeof n.limit_reached&&n.limit_reached();for(o=0;o<e.options.length;o++){(c=e.options[o]).selected||c.setAttribute("disabled",!0)}}else if(this.disabled_limit){for(o=0;o<e.options.length;o++){var c;"false"===(c=e.options[o]).getAttribute("data-origin-disabled")&&c.removeAttribute("disabled")}this.disabled_limit=!1}}i="change",d=e,(r=document.createEvent("HTMLEvents")).initEvent(i,!1,!0),d.dispatchEvent(r)}},t=function(e,t){if(e.wrapper.selected.innerHTML="",e.wrapper.non_selected.innerHTML="",t.non_selected_header&&t.selected_header){var n=document.createElement("div"),a=document.createElement("div");n.className="header",a.className="header",n.innerText=t.non_selected_header,a.innerText=t.selected_header,e.wrapper.non_selected.appendChild(n),e.wrapper.selected.appendChild(a)}if(e.wrapper.search)var i=e.wrapper.search.value;for(var d=null,r=null,l=0;l<e.options.length;l++){var s=e.options[l],o=s.value,c=s.textContent||s.innerText,p=document.createElement("a");if(p.tabIndex=0,p.className="item",p.innerHTML=c,p.setAttribute("role","button"),p.setAttribute("data-value",o),p.setAttribute("multi-index",l),s.disabled&&(p.className+=" disabled"),s.selected){p.className+=" selected";var u=p.cloneNode(!0);e.wrapper.selected.appendChild(u)}if("OPTGROUP"==s.parentNode.nodeName&&s.parentNode!=r){if(r=s.parentNode,(d=document.createElement("div")).className="item-group",s.parentNode.label){var m=document.createElement("span");m.innerHTML=s.parentNode.label,m.className="group-label",d.appendChild(m)}e.wrapper.non_selected.appendChild(d)}s.parentNode==e&&(d=null,r=null),(!i||i&&c.toLowerCase().indexOf(i.toLowerCase())>-1)&&(null!=d?d.appendChild(p):e.wrapper.non_selected.appendChild(p))}};return function(n,a){if((a=void 0!==a?a:{}).enable_search=void 0===a.enable_search||a.enable_search,a.search_placeholder=void 0!==a.search_placeholder?a.search_placeholder:"Search...",a.non_selected_header=void 0!==a.non_selected_header?a.non_selected_header:null,a.selected_header=void 0!==a.selected_header?a.selected_header:null,a.limit=void 0!==a.limit?parseInt(a.limit):-1,isNaN(a.limit)&&(a.limit=-1),null==n.dataset.multijs&&"SELECT"==n.nodeName&&n.multiple){n.style.display="none",n.setAttribute("data-multijs",!0);var i=document.createElement("div");if(i.className="multi-wrapper",a.enable_search){var d=document.createElement("input");d.className="search-input",d.type="text",d.setAttribute("placeholder",a.search_placeholder),d.addEventListener("input",function(){t(n,a)}),i.appendChild(d),i.search=d}var r=document.createElement("div");r.className="non-selected-wrapper";var l=document.createElement("div");l.className="selected-wrapper",i.addEventListener("click",function(t){t.target.getAttribute("multi-index")&&e(n,t,a)}),i.addEventListener("keypress",function(t){var i=32===t.keyCode||13===t.keyCode;t.target.getAttribute("multi-index")&&i&&(t.preventDefault(),e(n,t,a))}),i.appendChild(r),i.appendChild(l),i.non_selected=r,i.selected=l,n.wrapper=i,n.parentNode.insertBefore(i,n.nextSibling);for(var s=0;s<n.options.length;s++){var o=n.options[s];o.setAttribute("data-origin-disabled",o.disabled)}t(n,a),n.addEventListener("change",function(){t(n,a)})}}}();"undefined"!=typeof jQuery&&function(e){e.fn.multi=function(t){return t=void 0!==t?t:{},this.each(function(){var n=e(this);multi(n.get(0),t)})}}(jQuery);















var $slider = $('.slider');

var $slickTrack = $('.slick-track');
var $slickCurrent = $('.slick-current');

var slideDuration = 900;

//RESET ANIMATIONS
// On init slide change
$slider.on('init', function(slick){
  TweenMax.to($('.slick-track'), 0.9, {
    marginLeft: 0
  });
  TweenMax.to($('.slick-active'), 0.9, {
    x: 0,
    zIndex: 2
  });
});
// On before slide change
$slider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
  TweenMax.to($('.slick-track'), 0.9, {
    marginLeft: 0
  });
  TweenMax.to($('.slick-active'), 0.9, {
    x: 0
  });
});

// On after slide change
$slider.on('afterChange', function(event, slick, currentSlide){
  TweenMax.to($('.slick-track'), 0.9, {
    marginLeft: 0
  });
  $('.slick-slide').css('z-index','1');
  TweenMax.to($('.slick-active'), 0.9, {
    x: 0,
    zIndex: 2
  });
});

//SLICK INIT
$slider.slick({
  speed: slideDuration,
  dots: true,
  waitForAnimate: true,
  useTransform: true,
  cssEase: 'cubic-bezier(0.455, 0.030, 0.130, 1.000)'
})

//PREV
$('.slick-prev').on('mouseenter', function(){
                TweenMax.to($('.slick-track'), 0.6, {
                  marginLeft: "180px",
                  ease: Quad.easeOut
                });
                TweenMax.to($('.slick-current'), 0.6, {
                  x: -100,
                  ease: Quad.easeOut
                });
            });

$('.slick-prev').on('mouseleave', function(){
                TweenMax.to($('.slick-track'), 0.4, {
                  marginLeft: 0,
                  ease: Sine.easeInOut
                });
                TweenMax.to($('.slick-current'), 0.4, {
                  x: 0,
                  ease: Sine.easeInOut
                });
            });

//NEXT
$('.slick-next').on('mouseenter', function(){
  
                TweenMax.to($('.slick-track'), 0.6, {
                  marginLeft: "-180px",
                  ease: Quad.easeOut
                });
                TweenMax.to($('.slick-current'), 0.6, {
                  x: 100,
                  ease: Quad.easeOut
                });
            });

$('.slick-next').on('mouseleave', function(){
                TweenMax.to($('.slick-track'), 0.4, {
                  marginLeft: 0,
                  ease: Quad.easeInOut
                });
                TweenMax.to($('.slick-current'), 0.4, {
                  x: 0,
                  ease: Quad.easeInOut
                });
            });