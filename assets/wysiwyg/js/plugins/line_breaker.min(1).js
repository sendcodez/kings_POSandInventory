/*!
 * froala_editor v3.2.1 (https://www.froala.com/wysiwyg-editor)
 * License https://froala.com/wysiwyg-editor/terms/
 * Copyright 2014-2020 Froala Labs
 */

!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?t(require("froala-editor")):"function"==typeof define&&define.amd?define(["froala-editor"],t):t(e.FroalaEditor)}(this,function(b){"use strict";b=b&&b.hasOwnProperty("default")?b["default"]:b,Object.assign(b.DEFAULTS,{lineBreakerTags:["table","hr","form","dl","span.fr-video",".fr-embedly","img"],lineBreakerOffset:15,lineBreakerHorizontalOffset:10}),b.PLUGINS.lineBreaker=function(g){var v,t,a,m=g.$;function f(e,t){var n,r,a,o,i,s,f,l;if(null==e)i=(o=t.parent()).offset().top,n=(f=t.offset().top)-Math.min((f-i)/2,g.opts.lineBreakerOffset),a=o.outerWidth(),r=o.offset().left;else if(null==t)(s=(o=e.parent()).offset().top+o.outerHeight())<(l=e.offset().top+e.outerHeight())&&(s=(o=m(o).parent()).offset().top+o.outerHeight()),n=l+Math.min(Math.abs(s-l)/2,g.opts.lineBreakerOffset),a=o.outerWidth(),r=o.offset().left;else{o=e.parent();var p=e.offset().top+e.height(),u=t.offset().top;if(u<p)return!1;n=(p+u)/2,a=o.outerWidth(),r=o.offset().left}if(g.opts.iframe){var c=g.helpers.getPX(g.$wp.find(".fr-iframe").css("padding-top")),d=g.helpers.getPX(g.$wp.find(".fr-iframe").css("padding-left"));r+=g.$iframe.offset().left-g.helpers.scrollLeft()+d,n+=g.$iframe.offset().top-g.helpers.scrollTop()+c}g.$box.append(v),v.css("top",n-g.win.pageYOffset),v.css("left",r-g.win.pageXOffset),v.css("width",a),v.data("tag1",e),v.data("tag2",t),v.addClass("fr-visible").data("instance",g)}function l(e){if(e){var t=m(e);if(0===g.$el.find(t).length)return null;if(e.nodeType!=Node.TEXT_NODE&&t.is(g.opts.lineBreakerTags.join(",")))return t;if(0<t.parents(g.opts.lineBreakerTags.join(",")).length)return e=t.parents(g.opts.lineBreakerTags.join(",")).get(0),0!==g.$el.find(m(e)).length&&m(e).is(g.opts.lineBreakerTags.join(","))?m(e):null}return null}function o(e,t){var n=g.doc.elementFromPoint(e,t);return n&&!m(n).closest(".fr-line-breaker").length&&!g.node.isElement(n)&&n!=g.$wp.get(0)&&function r(e){if("undefined"!=typeof e.inFroalaWrapper)return e.inFroalaWrapper;for(var t=e;e.parentNode&&e.parentNode!==g.$wp.get(0);)e=e.parentNode;return t.inFroalaWrapper=e.parentNode==g.$wp.get(0),t.inFroalaWrapper}(n)?n:null}function i(e,t,n){for(var r=n,a=null;r<=g.opts.lineBreakerOffset&&!a;)(a=o(e,t-r))||(a=o(e,t+r)),r+=n;return a}function p(e,t,n){for(var r=null,a=100;!r&&e>g.$box.offset().left&&e<g.$box.offset().left+g.$box.outerWidth()&&0<a;)(r=o(e,t))||(r=i(e,t,5)),"left"==n?e-=g.opts.lineBreakerHorizontalOffset:e+=g.opts.lineBreakerHorizontalOffset,a-=g.opts.lineBreakerHorizontalOffset;return r}function n(e){var t=a=null,n=null,r=g.doc.elementFromPoint(e.pageX-g.win.pageXOffset,e.pageY-g.win.pageYOffset);(t=r&&("HTML"==r.tagName||"BODY"==r.tagName||g.node.isElement(r)||0<=(r.getAttribute("class")||"").indexOf("fr-line-breaker"))?((n=i(e.pageX-g.win.pageXOffset,e.pageY-g.win.pageYOffset,1))||(n=p(e.pageX-g.win.pageXOffset-g.opts.lineBreakerHorizontalOffset,e.pageY-g.win.pageYOffset,"left")),n||(n=p(e.pageX-g.win.pageXOffset+g.opts.lineBreakerHorizontalOffset,e.pageY-g.win.pageYOffset,"right")),l(n)):l(r))?function s(e,t){var n,r,a=e.offset().top,o=e.offset().top+e.outerHeight();if(Math.abs(o-t)<=g.opts.lineBreakerOffset||Math.abs(t-a)<=g.opts.lineBreakerOffset)if(Math.abs(o-t)<Math.abs(t-a)){for(var i=(r=e.get(0)).nextSibling;i&&i.nodeType==Node.TEXT_NODE&&0===i.textContent.length;)i=i.nextSibling;if(!i)return f(e,null),!0;if(n=l(i))return f(e,n),!0}else{if(!(r=e.get(0)).previousSibling)return f(null,e),!0;if(n=l(r.previousSibling))return f(n,e),!0}v.removeClass("fr-visible").removeData("instance")}(t,e.pageY):g.core.sameInstance(v)&&v.removeClass("fr-visible").removeData("instance")}function r(e){return!(v.hasClass("fr-visible")&&!g.core.sameInstance(v))&&(g.popups.areVisible()||g.el.querySelector(".fr-selected-cell")?(v.removeClass("fr-visible"),!0):void(!1!==t||g.edit.isDisabled()||(a&&clearTimeout(a),a=setTimeout(n,30,e))))}function s(){a&&clearTimeout(a),v&&v.hasClass("fr-visible")&&v.removeClass("fr-visible").removeData("instance")}var u=function u(){t=!0,s()},c=function c(){t=!1};function d(e){e.preventDefault();var t=v.data("instance")||g;v.removeClass("fr-visible").removeData("instance");var n=v.data("tag1"),r=v.data("tag2"),a=g.html.defaultTag();null==n?a&&"TD"!=r.parent().get(0).tagName&&0===r.parents(a).length?r.before("<".concat(a,">").concat(b.MARKERS,"<br></").concat(a,">")):r.before("".concat(b.MARKERS,"<br>")):a&&"TD"!=n.parent().get(0).tagName&&0===n.parents(a).length?n.after("<".concat(a,">").concat(b.MARKERS,"<br></").concat(a,">")):n.after("".concat(b.MARKERS,"<br>")),t.selection.restore(),g.toolbar.enable()}return{_init:function h(){if(!g.$wp)return!1;!function e(){g.shared.$line_breaker||(g.shared.$line_breaker=m(document.createElement("div")).attr("class","fr-line-breaker").html('<a class="fr-floating-btn" role="button" tabIndex="-1" title="'.concat(g.language.translate("Break"),'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="17" y="7" width="2" height="8"/><rect x="10" y="13" width="7" height="2"/><path d="M10.000,10.000 L10.000,18.013 L5.000,14.031 L10.000,10.000 Z"/></svg></a>'))),v=g.shared.$line_breaker,g.events.on("shared.destroy",function(){v.html("").removeData().remove(),v=null},!0),g.events.on("destroy",function(){v.removeData("instance").removeClass("fr-visible"),m("body").first().append(v),clearTimeout(a)},!0),g.events.$on(v,"mousemove",function(e){e.stopPropagation()},!0),g.events.bindClick(v,"a",d)}(),t=!1,g.events.$on(g.$win,"mousemove",r),g.events.$on(m(g.win),"scroll",s),g.events.on("popups.show.table.edit",s),g.events.on("commands.after",s),g.events.$on(m(g.win),"mousedown",u),g.events.$on(m(g.win),"mouseup",c)}}}});