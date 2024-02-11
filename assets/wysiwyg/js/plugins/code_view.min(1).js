/*!
 * froala_editor v3.2.1 (https://www.froala.com/wysiwyg-editor)
 * License https://froala.com/wysiwyg-editor/terms/
 * Copyright 2014-2020 Froala Labs
 */

!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?t(require("froala-editor")):"function"==typeof define&&define.amd?define(["froala-editor"],t):t(e.FroalaEditor)}(this,function(e){"use strict";e=e&&e.hasOwnProperty("default")?e["default"]:e,Object.assign(e.DEFAULTS,{codeMirror:window.CodeMirror,codeMirrorOptions:{lineNumbers:!0,tabMode:"indent",indentWithTabs:!0,lineWrapping:!0,mode:"text/html",tabSize:2},codeBeautifierOptions:{end_with_newline:!0,indent_inner_html:!0,extra_liners:["p","h1","h2","h3","h4","h5","h6","blockquote","pre","ul","ol","table","dl"],brace_style:"expand",indent_char:"\t",indent_size:1,wrap_line_length:0},codeViewKeepActiveButtons:["fullscreen"]}),e.PLUGINS.codeView=function(c){var d,f,h=c.$,p=function p(){return c.$box.hasClass("fr-code-view")};function u(){return f?f.getValue():d.val()}function g(){p()&&(f&&f.setSize(null,c.opts.height?c.opts.height:"auto"),c.opts.heightMin||c.opts.height?(c.$box.find(".CodeMirror-scroll, .CodeMirror-gutters").css("min-height",c.opts.heightMin||c.opts.height),d.css("height",c.opts.height)):c.$box.find(".CodeMirror-scroll, .CodeMirror-gutters").css("min-height",""))}var m,b=!1;function v(){p()&&c.events.trigger("blur")}function w(){p()&&b&&c.events.trigger("focus")}function o(e){d||(!function l(){d=h('<textarea class="fr-code" tabIndex="-1">'),c.$wp.append(d),d.attr("dir",c.opts.direction),c.$box.hasClass("fr-basic")||(m=h('<a data-cmd="html" title="Code View" class="fr-command fr-btn html-switch'.concat(c.helpers.isMobile()?"":" fr-desktop",'" role="button" tabIndex="-1"><i class="fa fa-code"></i></button>')),c.$box.append(m),c.events.bindClick(c.$box,"a.html-switch",function(){c.events.trigger("commands.before",["html"]),M(!1),c.events.trigger("commands.after",["html"])}));var e=function e(){return!p()};c.events.on("buttons.refresh",e),c.events.on("copy",e,!0),c.events.on("cut",e,!0),c.events.on("paste",e,!0),c.events.on("destroy",x,!0),c.events.on("html.set",function(){p()&&M(!0)}),c.events.on("codeView.update",g),c.events.on("codeView.toggle",function(){c.$box.hasClass("fr-code-view")&&M()}),c.events.on("form.submit",function(){p()&&(c.html.set(u()),c.events.trigger("contentChanged",[],!0))},!0)}(),!f&&c.opts.codeMirror?((f=c.opts.codeMirror.fromTextArea(d.get(0),c.opts.codeMirrorOptions)).on("blur",v),f.on("focus",w)):(c.events.$on(d,"keydown keyup change input",function(){c.opts.height?this.removeAttribute("rows"):(this.rows=1,0===this.value.length?this.style.height="auto":this.style.height="".concat(this.scrollHeight,"px"))}),c.events.$on(d,"blur",v),c.events.$on(d,"focus",w))),c.undo.saveStep(),c.html.cleanEmptyTags(),c.html.cleanWhiteTags(!0),c.core.hasFocus()&&(c.core.isEmpty()||(c.selection.save(),c.$el.find('.fr-marker[data-type="true"]').first().replaceWith('<span class="fr-tmp fr-sm">F</span>'),c.$el.find('.fr-marker[data-type="false"]').last().replaceWith('<span class="fr-tmp fr-em">F</span>')));var t=c.html.get(!1,!0);c.$el.find("span.fr-tmp").remove(),c.$box.toggleClass("fr-code-view",!0);var r,o,n=!1;if(c.core.hasFocus()&&(n=!0,c.events.disableBlur(),c.$el.blur()),t=(t=t.replace(/<span class="fr-tmp fr-sm">F<\/span>/,"FROALA-SM")).replace(/<span class="fr-tmp fr-em">F<\/span>/,"FROALA-EM"),c.codeBeautifier&&!t.includes("fr-embedly")&&(t=c.codeBeautifier.run(t,c.opts.codeBeautifierOptions)),f){r=t.indexOf("FROALA-SM"),(o=t.indexOf("FROALA-EM"))<r?r=o:o-=9;var s=(t=t.replace(/FROALA-SM/g,"").replace(/FROALA-EM/g,"")).substring(0,r).length-t.substring(0,r).replace(/\n/g,"").length,i=t.substring(0,o).length-t.substring(0,o).replace(/\n/g,"").length;r=t.substring(0,r).length-t.substring(0,t.substring(0,r).lastIndexOf("\n")+1).length,o=t.substring(0,o).length-t.substring(0,t.substring(0,o).lastIndexOf("\n")+1).length,f.setSize(null,c.opts.height?c.opts.height:"auto"),c.opts.heightMin&&c.$box.find(".CodeMirror-scroll").css("min-height",c.opts.heightMin),f.setValue(t),b=!n,f.focus(),b=!0,f.setSelection({line:s,ch:r},{line:i,ch:o}),f.refresh(),f.clearHistory()}else{r=t.indexOf("FROALA-SM"),o=t.indexOf("FROALA-EM")-9,c.opts.heightMin&&d.css("min-height",c.opts.heightMin),c.opts.height&&d.css("height",c.opts.height),c.opts.heightMax&&d.css("max-height",c.opts.height||c.opts.heightMax),d.val(t.replace(/FROALA-SM/g,"").replace(/FROALA-EM/g,"")).trigger("change");var a=h(c.o_doc).scrollTop();b=!n,d.focus(),b=!0,d.get(0).setSelectionRange(r,o),h(c.o_doc).scrollTop(a)}c.$tb.find(".fr-btn-grp > .fr-command, .fr-more-toolbar > .fr-command, .fr-btn-grp > .fr-btn-wrap > .fr-command, .fr-more-toolbar > .fr-btn-wrap > .fr-command").not(e).filter(function(){return c.opts.codeViewKeepActiveButtons.indexOf(h(this).data("cmd"))<0}).addClass("fr-disabled").attr("aria-disabled",!0),e.addClass("fr-active").attr("aria-pressed",!0),!c.helpers.isMobile()&&c.opts.toolbarInline&&c.toolbar.hide()}function M(e){void 0===e&&(e=!p());var t=c.$tb.find('.fr-command[data-cmd="html"]');e?(c.popups.hideAll(),o(t)):(c.$box.toggleClass("fr-code-view",!1),function r(e){var t=u();c.html.set(t),c.$el.blur(),c.$tb.find(".fr-btn-grp > .fr-command, .fr-more-toolbar > .fr-command, .fr-btn-grp > .fr-btn-wrap > .fr-command, .fr-more-toolbar > .fr-btn-wrap > .fr-command").not(e).removeClass("fr-disabled").attr("aria-disabled",!1),e.removeClass("fr-active").attr("aria-pressed",!1),c.selection.setAtStart(c.el),c.selection.restore(),c.placeholder.refresh(),c.undo.saveStep()}(t),c.events.trigger("codeView.update"))}function x(){p()&&M(!1),f&&f.toTextArea(),d.val("").removeData().remove(),d=null,m&&(m.remove(),m=null)}return{_init:function e(){if(c.events.on("focus",function(){c.opts.toolbarContainer&&function t(){var e=c.$tb.find('.fr-command[data-cmd="html"]');p()?(c.$tb.find(".fr-btn-grp > .fr-command, .fr-more-toolbar > .fr-command").not(e).filter(function(){return c.opts.codeViewKeepActiveButtons.indexOf(h(this).data("cmd"))<0}).addClass("fr-disabled").attr("aria-disabled",!1),e.addClass("fr-active").attr("aria-pressed",!1)):(c.$tb.find(".fr-btn-grp > .fr-command, .fr-more-toolbar > .fr-command").not(e).removeClass("fr-disabled").attr("aria-disabled",!1),e.removeClass("fr-active").attr("aria-pressed",!1))}()}),!c.$wp)return!1},toggle:M,isActive:p,get:u}},e.RegisterCommand("html",{title:"Code View",undo:!1,focus:!1,forcedRefresh:!0,toggle:!0,callback:function(){this.codeView.toggle()},plugin:"codeView"}),e.DefineIcon("html",{NAME:"code",SVG_KEY:"codeView"})});