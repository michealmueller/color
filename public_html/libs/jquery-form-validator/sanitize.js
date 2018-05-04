/** File generated by Grunt -- do not modify
 *  JQUERY-FORM-VALIDATOR
 *
 *  @version 2.3.54
 *  @website http://formvalidator.net/
 *  @author Victor Jonsson, http://victorjonsson.se
 *  @license MIT
 */
!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):"object"==typeof exports?module.exports=b(require("jquery")):b(jQuery)}(this,function(a){!function(a,b){"use strict";var c='[type="button"], [type="submit"], [type="radio"], [type="checkbox"], [type="reset"], [type="search"]',d={upper:function(a){return a.toLocaleUpperCase()},lower:function(a){return a.toLocaleLowerCase()},trim:function(b){return a.trim(b)},trimLeft:function(a){return a.replace(/^\s+/,"")},trimRight:function(a){return a.replace(/\s+$/,"")},capitalize:function(b){var c=b.split(" ");return a.each(c,function(a,b){c[a]=b.substr(0,1).toUpperCase()+b.substr(1,b.length)}),c.join(" ")},insert:function(a,b,c){var d=(b.attr("data-sanitize-insert-"+c)||"").replace(/\[SPACE\]/g," ");return"left"===c&&0===a.indexOf(d)||"right"===c&&a.substring(a.length-d.length)===d?a:("left"===c?d:"")+a+("right"===c?d:"")},insertRight:function(a,b){return this.insert(a,b,"right")},insertLeft:function(a,b){return this.insert(a,b,"left")},numberFormat:function(a,c){if(0===a.length)return a;if(!("numeral"in b))throw new ReferenceError('Using sanitation function "numberFormat" requires that you include numeral.js (http://numeraljs.com/)');return a=numeral().unformat(a),a=numeral(a).format(c.attr("data-sanitize-number-format"))},strip:function(b,c){var d=c.attr("data-sanitize-strip")||"";return a.split(d,function(c){var d=new RegExp(a.isNumeric(c)?c:"\\"+c,"g");b=b.replace(d,"")}),b},escape:function(b,c){var d=c.valAttr("is-escaped"),e={"<":"__%AMP%__lt;",">":"__%AMP%__gt;","&":"__%AMP%__amp;","'":"__%AMP%__#8217;",'"':"__%AMP%__quot;"};return"yes"===d?b:(c.valAttr("is-escaped","yes"),c.one("keyup",function(a){9!==a.keyCode&&c.valAttr("is-escaped","no")}),a.each(e,function(a,c){b=b.replace(new RegExp(a,"g"),c)}),b.replace(new RegExp("__%AMP%__","g"),"&"))}},e=function(b,e,f){e||(e=a("form")),e.each||(e=a(e));var g=function(){var b=a(this),c=b.val();a.split(b.attr("data-sanitize"),function(a){if(!(a in d))throw new Error('Use of unknown sanitize command "'+a+'"');c=d[a](c,b,f)}),b.val(c).trigger("keyup.validation")};e.each(function(){var b=a(this);f.sanitizeAll&&b.find("input,textarea").not(c).each(function(){var b=a(this),c=b.attr("data-sanitize")||"";b.attr("data-sanitize",f.sanitizeAll+" "+c)}),b.find("[data-sanitize]").unbind("blur.sanitation",g).bind("blur.sanitation",g),a(function(){b.trigger("blur.sanitation")})})};a(b).on("validatorsLoaded formValidationSetup",e),a.formUtils.setupSanitation=e}(a,window)});