/*! jQuery UI - v1.12.1 - 2017-01-23
* http://jqueryui.com
* Includes: widget.js
* Copyright jQuery Foundation and other contributors; Licensed MIT */

(function(t){"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)})(function(t){t.ui=t.ui||{},t.ui.version="1.12.1";var e=0,i=Array.prototype.slice;t.cleanData=function(e){return function(i){var s,n,o;for(o=0;null!=(n=i[o]);o++)try{s=t._data(n,"events"),s&&s.remove&&t(n).triggerHandler("remove")}catch(a){}e(i)}}(t.cleanData),t.widget=function(e,i,s){var n,o,a,r={},l=e.split(".")[0];e=e.split(".")[1];var h=l+"-"+e;return s||(s=i,i=t.Widget),t.isArray(s)&&(s=t.extend.apply(null,[{}].concat(s))),t.expr[":"][h.toLowerCase()]=function(e){return!!t.data(e,h)},t[l]=t[l]||{},n=t[l][e],o=t[l][e]=function(t,e){return this._createWidget?(arguments.length&&this._createWidget(t,e),void 0):new o(t,e)},t.extend(o,n,{version:s.version,_proto:t.extend({},s),_childConstructors:[]}),a=new i,a.options=t.widget.extend({},a.options),t.each(s,function(e,s){return t.isFunction(s)?(r[e]=function(){function t(){return i.prototype[e].apply(this,arguments)}function n(t){return i.prototype[e].apply(this,t)}return function(){var e,i=this._super,o=this._superApply;return this._super=t,this._superApply=n,e=s.apply(this,arguments),this._super=i,this._superApply=o,e}}(),void 0):(r[e]=s,void 0)}),o.prototype=t.widget.extend(a,{widgetEventPrefix:n?a.widgetEventPrefix||e:e},r,{constructor:o,namespace:l,widgetName:e,widgetFullName:h}),n?(t.each(n._childConstructors,function(e,i){var s=i.prototype;t.widget(s.namespace+"."+s.widgetName,o,i._proto)}),delete n._childConstructors):i._childConstructors.push(o),t.widget.bridge(e,o),o},t.widget.extend=function(e){for(var s,n,o=i.call(arguments,1),a=0,r=o.length;r>a;a++)for(s in o[a])n=o[a][s],o[a].hasOwnProperty(s)&&void 0!==n&&(e[s]=t.isPlainObject(n)?t.isPlainObject(e[s])?t.widget.extend({},e[s],n):t.widget.extend({},n):n);return e},t.widget.bridge=function(e,s){var n=s.prototype.widgetFullName||e;t.fn[e]=function(o){var a="string"==typeof o,r=i.call(arguments,1),l=this;return a?this.length||"instance"!==o?this.each(function(){var i,s=t.data(this,n);return"instance"===o?(l=s,!1):s?t.isFunction(s[o])&&"_"!==o.charAt(0)?(i=s[o].apply(s,r),i!==s&&void 0!==i?(l=i&&i.jquery?l.pushStack(i.get()):i,!1):void 0):t.error("no such method '"+o+"' for "+e+" widget instance"):t.error("cannot call methods on "+e+" prior to initialization; "+"attempted to call method '"+o+"'")}):l=void 0:(r.length&&(o=t.widget.extend.apply(null,[o].concat(r))),this.each(function(){var e=t.data(this,n);e?(e.option(o||{}),e._init&&e._init()):t.data(this,n,new s(o,this))})),l}},t.Widget=function(){},t.Widget._childConstructors=[],t.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",defaultElement:"<div>",options:{classes:{},disabled:!1,create:null},_createWidget:function(i,s){s=t(s||this.defaultElement||this)[0],this.element=t(s),this.uuid=e++,this.eventNamespace="."+this.widgetName+this.uuid,this.bindings=t(),this.hoverable=t(),this.focusable=t(),this.classesElementLookup={},s!==this&&(t.data(s,this.widgetFullName,this),this._on(!0,this.element,{remove:function(t){t.target===s&&this.destroy()}}),this.document=t(s.style?s.ownerDocument:s.document||s),this.window=t(this.document[0].defaultView||this.document[0].parentWindow)),this.options=t.widget.extend({},this.options,this._getCreateOptions(),i),this._create(),this.options.disabled&&this._setOptionDisabled(this.options.disabled),this._trigger("create",null,this._getCreateEventData()),this._init()},_getCreateOptions:function(){return{}},_getCreateEventData:t.noop,_create:t.noop,_init:t.noop,destroy:function(){var e=this;this._destroy(),t.each(this.classesElementLookup,function(t,i){e._removeClass(i,t)}),this.element.off(this.eventNamespace).removeData(this.widgetFullName),this.widget().off(this.eventNamespace).removeAttr("aria-disabled"),this.bindings.off(this.eventNamespace)},_destroy:t.noop,widget:function(){return this.element},option:function(e,i){var s,n,o,a=e;if(0===arguments.length)return t.widget.extend({},this.options);if("string"==typeof e)if(a={},s=e.split("."),e=s.shift(),s.length){for(n=a[e]=t.widget.extend({},this.options[e]),o=0;s.length-1>o;o++)n[s[o]]=n[s[o]]||{},n=n[s[o]];if(e=s.pop(),1===arguments.length)return void 0===n[e]?null:n[e];n[e]=i}else{if(1===arguments.length)return void 0===this.options[e]?null:this.options[e];a[e]=i}return this._setOptions(a),this},_setOptions:function(t){var e;for(e in t)this._setOption(e,t[e]);return this},_setOption:function(t,e){return"classes"===t&&this._setOptionClasses(e),this.options[t]=e,"disabled"===t&&this._setOptionDisabled(e),this},_setOptionClasses:function(e){var i,s,n;for(i in e)n=this.classesElementLookup[i],e[i]!==this.options.classes[i]&&n&&n.length&&(s=t(n.get()),this._removeClass(n,i),s.addClass(this._classes({element:s,keys:i,classes:e,add:!0})))},_setOptionDisabled:function(t){this._toggleClass(this.widget(),this.widgetFullName+"-disabled",null,!!t),t&&(this._removeClass(this.hoverable,null,"ui-state-hover"),this._removeClass(this.focusable,null,"ui-state-focus"))},enable:function(){return this._setOptions({disabled:!1})},disable:function(){return this._setOptions({disabled:!0})},_classes:function(e){function i(i,o){var a,r;for(r=0;i.length>r;r++)a=n.classesElementLookup[i[r]]||t(),a=e.add?t(t.unique(a.get().concat(e.element.get()))):t(a.not(e.element).get()),n.classesElementLookup[i[r]]=a,s.push(i[r]),o&&e.classes[i[r]]&&s.push(e.classes[i[r]])}var s=[],n=this;return e=t.extend({element:this.element,classes:this.options.classes||{}},e),this._on(e.element,{remove:"_untrackClassesElement"}),e.keys&&i(e.keys.match(/\S+/g)||[],!0),e.extra&&i(e.extra.match(/\S+/g)||[]),s.join(" ")},_untrackClassesElement:function(e){var i=this;t.each(i.classesElementLookup,function(s,n){-1!==t.inArray(e.target,n)&&(i.classesElementLookup[s]=t(n.not(e.target).get()))})},_removeClass:function(t,e,i){return this._toggleClass(t,e,i,!1)},_addClass:function(t,e,i){return this._toggleClass(t,e,i,!0)},_toggleClass:function(t,e,i,s){s="boolean"==typeof s?s:i;var n="string"==typeof t||null===t,o={extra:n?e:i,keys:n?t:e,element:n?this.element:t,add:s};return o.element.toggleClass(this._classes(o),s),this},_on:function(e,i,s){var n,o=this;"boolean"!=typeof e&&(s=i,i=e,e=!1),s?(i=n=t(i),this.bindings=this.bindings.add(i)):(s=i,i=this.element,n=this.widget()),t.each(s,function(s,a){function r(){return e||o.options.disabled!==!0&&!t(this).hasClass("ui-state-disabled")?("string"==typeof a?o[a]:a).apply(o,arguments):void 0}"string"!=typeof a&&(r.guid=a.guid=a.guid||r.guid||t.guid++);var l=s.match(/^([\w:-]*)\s*(.*)$/),h=l[1]+o.eventNamespace,c=l[2];c?n.on(h,c,r):i.on(h,r)})},_off:function(e,i){i=(i||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace,e.off(i).off(i),this.bindings=t(this.bindings.not(e).get()),this.focusable=t(this.focusable.not(e).get()),this.hoverable=t(this.hoverable.not(e).get())},_delay:function(t,e){function i(){return("string"==typeof t?s[t]:t).apply(s,arguments)}var s=this;return setTimeout(i,e||0)},_hoverable:function(e){this.hoverable=this.hoverable.add(e),this._on(e,{mouseenter:function(e){this._addClass(t(e.currentTarget),null,"ui-state-hover")},mouseleave:function(e){this._removeClass(t(e.currentTarget),null,"ui-state-hover")}})},_focusable:function(e){this.focusable=this.focusable.add(e),this._on(e,{focusin:function(e){this._addClass(t(e.currentTarget),null,"ui-state-focus")},focusout:function(e){this._removeClass(t(e.currentTarget),null,"ui-state-focus")}})},_trigger:function(e,i,s){var n,o,a=this.options[e];if(s=s||{},i=t.Event(i),i.type=(e===this.widgetEventPrefix?e:this.widgetEventPrefix+e).toLowerCase(),i.target=this.element[0],o=i.originalEvent)for(n in o)n in i||(i[n]=o[n]);return this.element.trigger(i,s),!(t.isFunction(a)&&a.apply(this.element[0],[i].concat(s))===!1||i.isDefaultPrevented())}},t.each({show:"fadeIn",hide:"fadeOut"},function(e,i){t.Widget.prototype["_"+e]=function(s,n,o){"string"==typeof n&&(n={effect:n});var a,r=n?n===!0||"number"==typeof n?i:n.effect||i:e;n=n||{},"number"==typeof n&&(n={duration:n}),a=!t.isEmptyObject(n),n.complete=o,n.delay&&s.delay(n.delay),a&&t.effects&&t.effects.effect[r]?s[e](n):r!==e&&s[r]?s[r](n.duration,n.easing,o):s.queue(function(i){t(this)[e](),o&&o.call(s[0]),i()})}}),t.widget});
/*! jquery.tocify - v1.9.0 - 2013-10-01 
* http://gregfranko.com/jquery.tocify.js/
* Copyright (c) 2013 Greg Franko; Licensed MIT*/
(function(e){"use strict";e(window.jQuery,window,document)})(function(e,t,s){"use strict";var i="tocify",o="tocify-focus",n="tocify-hover",a="tocify-hide",l="tocify-header",h="."+l,r="tocify-subheader",d="."+r,c="tocify-item",f="."+c,u="tocify-extend-page",p="."+u;e.widget("toc.tocify",{version:"1.9.0",options:{context:"body",ignoreSelector:null,selectors:"h1, h2, h3",showAndHide:!0,showEffect:"slideDown",showEffectSpeed:"medium",hideEffect:"slideUp",hideEffectSpeed:"medium",smoothScroll:!0,smoothScrollSpeed:"medium",scrollTo:0,showAndHideOnScroll:!0,highlightOnScroll:!0,highlightOffset:40,theme:"bootstrap",extendPage:!0,extendPageOffset:100,history:!0,scrollHistory:!1,hashGenerator:"compact",highlightDefault:!0},_create:function(){var s=this;s.extendPageScroll=!0,s.items=[],s._generateToc(),s._addCSSClasses(),s.webkit=function(){for(var e in t)if(e&&-1!==e.toLowerCase().indexOf("webkit"))return!0;return!1}(),s._setEventHandlers(),e(t).load(function(){s._setActiveElement(!0),e("html, body").promise().done(function(){setTimeout(function(){s.extendPageScroll=!1},0)})})},_generateToc:function(){var t,s,o=this,n=o.options.ignoreSelector;return t=-1!==this.options.selectors.indexOf(",")?e(this.options.context).find(this.options.selectors.replace(/ /g,"").substr(0,this.options.selectors.indexOf(","))):e(this.options.context).find(this.options.selectors.replace(/ /g,"")),t.length?(o.element.addClass(i),t.each(function(t){e(this).is(n)||(s=e("<ul/>",{id:l+t,"class":l}).append(o._nestElements(e(this),t)),o.element.append(s),e(this).nextUntil(this.nodeName.toLowerCase()).each(function(){0===e(this).find(o.options.selectors).length?e(this).filter(o.options.selectors).each(function(){e(this).is(n)||o._appendSubheaders.call(this,o,s)}):e(this).find(o.options.selectors).each(function(){e(this).is(n)||o._appendSubheaders.call(this,o,s)})}))}),undefined):(o.element.addClass(a),undefined)},_setActiveElement:function(e){var s=this,i=t.location.hash.substring(1),o=s.element.find('li[data-unique="'+i+'"]');return i.length?(s.element.find("."+s.focusClass).removeClass(s.focusClass),o.addClass(s.focusClass),s.options.showAndHide&&o.click()):(s.element.find("."+s.focusClass).removeClass(s.focusClass),!i.length&&e&&s.options.highlightDefault&&s.element.find(f).first().addClass(s.focusClass)),s},_nestElements:function(t,s){var i,o,n;return i=e.grep(this.items,function(e){return e===t.text()}),i.length?this.items.push(t.text()+s):this.items.push(t.text()),n=this._generateHashValue(i,t,s),o=e("<li/>",{"class":c,"data-unique":n}).append(e("<a/>",{text:t.text()})),t.before(e("<div/>",{name:n,"data-unique":n})),o},_generateHashValue:function(e,t,s){var i="",o=this.options.hashGenerator;if("pretty"===o){for(i=t.text().toLowerCase().replace(/\s/g,"-");i.indexOf("--")>-1;)i=i.replace(/--/g,"-");for(;i.indexOf(":-")>-1;)i=i.replace(/:-/g,"-")}else i="function"==typeof o?o(t.text(),t):t.text().replace(/\s/g,"");return e.length&&(i+=""+s),i},_appendSubheaders:function(t,s){var i=e(this).index(t.options.selectors),o=e(t.options.selectors).eq(i-1),n=+e(this).prop("tagName").charAt(1),a=+o.prop("tagName").charAt(1);a>n?t.element.find(d+"[data-tag="+n+"]").last().append(t._nestElements(e(this),i)):n===a?s.find(f).last().after(t._nestElements(e(this),i)):s.find(f).last().after(e("<ul/>",{"class":r,"data-tag":n})).next(d).append(t._nestElements(e(this),i))},_setEventHandlers:function(){var i=this;this.element.on("click.tocify","li",function(){if(i.options.history&&(t.location.hash=e(this).attr("data-unique")),i.element.find("."+i.focusClass).removeClass(i.focusClass),e(this).addClass(i.focusClass),i.options.showAndHide){var s=e('li[data-unique="'+e(this).attr("data-unique")+'"]');i._triggerShow(s)}i._scrollTo(e(this))}),this.element.find("li").on({"mouseenter.tocify":function(){e(this).addClass(i.hoverClass),e(this).css("cursor","pointer")},"mouseleave.tocify":function(){"bootstrap"!==i.options.theme&&e(this).removeClass(i.hoverClass)}}),(i.options.extendPage||i.options.highlightOnScroll||i.options.scrollHistory||i.options.showAndHideOnScroll)&&e(t).on("scroll.tocify",function(){e("html, body").promise().done(function(){var o,n,a,l,h=e(t).scrollTop(),r=e(t).height(),d=e(s).height(),c=e("body")[0].scrollHeight;if(i.options.extendPage&&(i.webkit&&h>=c-r-i.options.extendPageOffset||!i.webkit&&r+h>d-i.options.extendPageOffset)&&!e(p).length){if(n=e('div[data-unique="'+e(f).last().attr("data-unique")+'"]'),!n.length)return;a=n.offset().top,e(i.options.context).append(e("<div />",{"class":u,height:Math.abs(a-h)+"px","data-unique":u})),i.extendPageScroll&&(l=i.element.find("li.active"),i._scrollTo(e('div[data-unique="'+l.attr("data-unique")+'"]')))}setTimeout(function(){var s,n=null,a=null,l=e(i.options.context).find("div[data-unique]");l.each(function(t){var s=Math.abs((e(this).next().length?e(this).next():e(this)).offset().top-h-i.options.highlightOffset);return null==n||n>s?(n=s,a=t,undefined):!1}),s=e(l[a]).attr("data-unique"),o=e('li[data-unique="'+s+'"]'),i.options.highlightOnScroll&&o.length&&(i.element.find("."+i.focusClass).removeClass(i.focusClass),o.addClass(i.focusClass)),i.options.scrollHistory&&t.location.hash!=="#"+s&&t.location.replace("#"+s),i.options.showAndHideOnScroll&&i.options.showAndHide&&i._triggerShow(o,!0)},0)})})},show:function(t){var s=this;if(!t.is(":visible"))switch(t.find(d).length||t.parent().is(h)||t.parent().is(":visible")?t.children(d).length||t.parent().is(h)||(t=t.closest(d)):t=t.parents(d).add(t),s.options.showEffect){case"none":t.show();break;case"show":t.show(s.options.showEffectSpeed);break;case"slideDown":t.slideDown(s.options.showEffectSpeed);break;case"fadeIn":t.fadeIn(s.options.showEffectSpeed);break;default:t.show()}return t.parent().is(h)?s.hide(e(d).not(t)):s.hide(e(d).not(t.closest(h).find(d).not(t.siblings()))),s},hide:function(e){var t=this;switch(t.options.hideEffect){case"none":e.hide();break;case"hide":e.hide(t.options.hideEffectSpeed);break;case"slideUp":e.slideUp(t.options.hideEffectSpeed);break;case"fadeOut":e.fadeOut(t.options.hideEffectSpeed);break;default:e.hide()}return t},_triggerShow:function(e,t){var s=this;return e.parent().is(h)||e.next().is(d)?s.show(e.next(d),t):e.parent().is(d)&&s.show(e.parent(),t),s},_addCSSClasses:function(){return"jqueryui"===this.options.theme?(this.focusClass="ui-state-default",this.hoverClass="ui-state-hover",this.element.addClass("ui-widget").find(".toc-title").addClass("ui-widget-header").end().find("li").addClass("ui-widget-content")):"bootstrap"===this.options.theme?(this.element.find(h+","+d).addClass("nav nav-list"),this.focusClass="active"):(this.focusClass=o,this.hoverClass=n),this},setOption:function(){e.Widget.prototype._setOption.apply(this,arguments)},setOptions:function(){e.Widget.prototype._setOptions.apply(this,arguments)},_scrollTo:function(t){var s=this,i=s.options.smoothScroll||0,o=s.options.scrollTo,n=e('div[data-unique="'+t.attr("data-unique")+'"]');return n.length?(e("html, body").promise().done(function(){e("html, body").animate({scrollTop:n.offset().top-(e.isFunction(o)?o.call():o)+"px"},{duration:i})}),s):s}})});
	$(function() {
		var i = $("#toc").tocify({
			context: "#postpage",
            selectors: "h2,h3",
            extendPage: false,
            hideEffect: "slidUp",
            scrollTo: 50
            });
		i.find("li").length || $("#tag_toc").hide()
	});
$(window).bind("scroll",
  function() {
    //var o = $("#header").height() + $("#tabs-4").height() + $("#categories-2").height();
    //alert(o);
    var o = 1020;
    $(window).scrollTop() > o ? $("#tag_toc").addClass("fixed") : $("#tag_toc").removeClass("fixed")
})