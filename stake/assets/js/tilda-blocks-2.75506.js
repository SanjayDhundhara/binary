 
function t142_checkSize(recid){
  var el=$("#rec"+recid).find(".t142__submit");
  if(el.length){
    var btnheight = el.height() + 5;
    var textheight = el[0].scrollHeight;
    if (btnheight < textheight) {
      var btntext = el.text();
      el.addClass("t142__submit-overflowed");
    }
  }
} 
function t190_scrollToTop(){
    $('html, body').animate({scrollTop: 0}, 700);								
}	  
 
window.t256showvideo = function(recid){
    $(document).ready(function(){
        var el = $('#coverCarry'+recid);
        var videourl = '';

        var youtubeid=$("#rec"+recid+" .t256__video-container").attr('data-content-popup-video-url-youtube');
        if(youtubeid > '') {
            videourl = 'https://www.youtube.com/embed/' + youtubeid;
        }

        $("body").addClass("t256__overflow");
		$("#rec"+recid+" .t256__cover").addClass( "t256__hidden");
        $("#rec"+recid+" .t256__video-container").removeClass( "t256__hidden");
        $("#rec"+recid+" .t256__video-carier").html("<iframe id=\"youtubeiframe"+recid+"\" class=\"t256__iframe\" width=\"100%\" height=\"540\" src=\"" + videourl + "?rel=0&autoplay=1\" frameborder=\"0\" allowfullscreen></iframe><a class=\"t256__close-link\" href=\"javascript:t256hidevideo('"+recid+"');\"><div class=\"t256__close\"></div></a>");
    });
}

window.t256hidevideo = function(recid){
    $(document).ready(function(){
        $("body").removeClass("t256__overflow");
        $("#rec"+recid+" .t256__cover").removeClass( "t256__hidden");
        $("#rec"+recid+" .t256__video-container").addClass( "t256__hidden");
        $("#rec"+recid+" .t256__video-carier").html("<div class=\"t256__video-bg2\"></div>");
    });
} 
window.t266showvideo = function(recid){
    $(document).ready(function(){
        var el = $('#coverCarry'+recid);
        var videourl = '';

        var youtubeid=$("#rec"+recid+" .t266__video-container").attr('data-content-popup-video-url-youtube');
        if(youtubeid > '') {
            videourl = 'https://www.youtube.com/embed/' + youtubeid;
        }

        $("body").addClass("t266__overflow");
		$("#rec"+recid+" .t266__cover").addClass("t266__hidden");
        $("#rec"+recid+" .t266__video-container").removeClass("t266__hidden");
        $("#rec"+recid+" .t266__video-carier").html("<iframe id=\"youtubeiframe"+recid+"\" class=\"t266__iframe\" width=\"100%\" height=\"540\" src=\"" + videourl + "?rel=0&autoplay=1\" frameborder=\"0\" allowfullscreen></iframe><a class=\"t266__close-link\" href=\"javascript:t266hidevideo('"+recid+"');\"><div class=\"t266__close\"></div></a>");
    });
}

window.t266hidevideo = function(recid){
    $(document).ready(function(){
        $("body").removeClass("t266__overflow");
        $("#rec"+recid+" .t266__cover").removeClass("t266__hidden");
        $("#rec"+recid+" .t266__video-container").addClass("t266__hidden");
        $("#rec"+recid+" .t266__video-carier").html("<div class=\"t266__video-bg2\"></div>");
    });
} 
function t280_showMenu(recid){
  var el=$("#rec"+recid);
  
  
  el.find('.t280__burger, .t280__menu__bg, .t280__menu__item:not(".tooltipstered"):not(".t280__menu__item_submenu"), .t978__tooltip-menu_mobile').click(function(e){
    if ($(this).is(".t280__menu__item.tooltipstered, .t794__tm-link")) { return; }
    var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
    var menuItemsLength = el.find('.t280__menu__item').length;
    /* Hack for big amount of items in menu */
    var isAndroid = /(android)/i.test(navigator.userAgent);
    if (window.location.hash && isChrome && menuItemsLength > 10 && isAndroid) {
        setTimeout(function () {
            var hash = window.location.hash;
            window.location.hash = "";
            window.location.hash = hash;
        }, 50);
    }
    
    if (!$(this).is(".t978__tm-link, .t966__tm-link")) {
        $('body').toggleClass('t280_opened');
        el.find('.t280').toggleClass('t280__main_opened');
    }
    
    t280_changeSize(recid);
    t280_highlight(recid);
    
    el.find(".t978__tm-link, .t966__tm-link").click(function() {
        t280_changeSize(recid);
        el.find(".t280__menu").css('transition', 'none');

        el.find(".t978__menu-link").click(function() {
            t280_changeSize(recid);
        });
    });
  });

  $('.t280').bind('clickedAnchorInTooltipMenu',function(){
    $('body').removeClass('t280_opened');
    el.find('.t280').removeClass('t280__main_opened');
  });
  
  if (el.find('.t-menusub__link-item')) {
    el.find('.t-menusub__link-item').on('click', function() {
      $('body').removeClass('t280_opened');
      el.find('.t280').removeClass('t280__main_opened');
    });
  }
}

function t280_changeSize(recid){
  var el=$("#rec"+recid);
  var div = el.find(".t280__menu").height();
  var bottomheight = el.find(".t280__bottom").height();
  var headerheight = el.find(".t280__container").height();
  var wrapper = el.find(".t280__menu__wrapper");
  var win = $(window).height() - bottomheight - headerheight - 160;
  if (div > win ) {
    wrapper.addClass('t280__menu_static');
  }
  else {
    wrapper.removeClass('t280__menu_static');
  }
}

function t280_changeBgOpacityMenu(recid) {
  var window_width=$(window).width();
  var record = $("#rec"+recid);
  record.find(".t280__container__bg").each(function() {
        var el=$(this);
        var bgcolor=el.attr("data-bgcolor-rgba");
        var bgcolor_afterscroll=el.attr("data-bgcolor-rgba-afterscroll");
        var bgopacity=el.attr("data-bgopacity");
        var bgopacity_afterscroll=el.attr("data-bgopacity2");
        var menu_shadow=el.attr("data-menu-shadow");
        if ($(window).scrollTop() > 20) {
            el.css("background-color",bgcolor_afterscroll);
            if (bgopacity_afterscroll != "0" && bgopacity_afterscroll != "0.0") {
              el.css('box-shadow',menu_shadow);
            } else {
              el.css('box-shadow','none');
            }
        }else{
            el.css("background-color",bgcolor);
            if (bgopacity != "0" && bgopacity != "0.0") {
              el.css('box-shadow',menu_shadow);
            } else {
              el.css('box-shadow','none');
            }
        }
  });
}

function t280_appearMenu() {
  $('.t280').each(function() {
    var el = $(this);
    var appearoffset = el.attr('data-appearoffset');
    if (appearoffset != '') {
      if (appearoffset.indexOf('vh') > -1) {
        appearoffset = Math.floor(
          window.innerHeight * (parseInt(appearoffset) / 100)
        );
      }
      appearoffset = parseInt(appearoffset, 10);
      if ($(window).scrollTop() >= appearoffset) {
        if (el.css('visibility') == 'hidden') {
          el.finish();
          el.css('top', '-50px');
          el.css('opacity', '1');
          el.css('visibility', 'visible');
        }
      } else {
        el.stop();
        el.css('opacity', '0');
        el.css('visibility', 'hidden');
      }
    }
  });
}

function t280_highlight(recid){
  var url=window.location.href;
  var pathname=window.location.pathname;
  var hash=window.location.hash;
  if(url.substr(url.length - 1) == "/"){ url = url.slice(0,-1); }
  if(pathname.substr(pathname.length - 1) == "/"){ pathname = pathname.slice(0,-1); }
  if(pathname.charAt(0) == "/"){ pathname = pathname.slice(1); }
  if(pathname == ""){ pathname = "/"; }
  if(hash.substr(hash.length - 1) == "/"){ hash = hash.slice(0,-1); }
  if(hash == ""){ hash = "/"; }

  $("#rec"+recid).find(".t280__menu a").removeClass("t-active");
  
  $(".t280__menu a[href='"+url+"']").addClass("t-active");
  $(".t280__menu a[href='"+url+"/']").addClass("t-active");
  $(".t280__menu a[href='"+pathname+"']").addClass("t-active");
  $(".t280__menu a[href='/"+pathname+"']").addClass("t-active");
  $(".t280__menu a[href='"+pathname+"/']").addClass("t-active");
  $(".t280__menu a[href='/"+pathname+"/']").addClass("t-active");
  
  $(".t280__menu a[href='"+hash+"']").addClass("t-active");
  $(".t280__menu a[href='/"+hash+"']").addClass("t-active");
  $(".t280__menu a[href='"+hash+"/']").addClass("t-active");
  $(".t280__menu a[href='/"+hash+"/']").addClass("t-active");
}
 
function t347_setHeight(recid){
  var el=$('#rec'+recid);
  var div = el.find(".t347__table");
  var height=div.width() * 0.5625;
  div.height(height);
}

window.t347showvideo = function(recid){
    $(document).ready(function(){
        var el = $('#rec'+recid);
        var videourl = '';

        var youtubeid=$("#rec"+recid+" .t347__video-container").attr('data-content-popup-video-url-youtube');
        if(youtubeid > '') {
            videourl = 'https://www.youtube.com/embed/' + youtubeid;
        }

        $("#rec"+recid+" .t347__video-container").removeClass( "t347__hidden");
        $("#rec"+recid+" .t347__video-carier").html("<iframe id=\"youtubeiframe"+recid+"\" class=\"t347__iframe\" width=\"100%\" height=\"100%\" src=\"" + videourl + (videourl.indexOf('?') !== -1 ? '&' : '?') + "autoplay=1&rel=0\" frameborder=\"0\" allowfullscreen allow=\"autoplay\"></iframe>");
    });
}

window.t347hidevideo = function(recid){
    $(document).ready(function(){
        $("#rec"+recid+" .t347__video-container").addClass( "t347__hidden");
        $("#rec"+recid+" .t347__video-carier").html("");
    });
} 

function t396_init(recid){var data='';var res=t396_detectResolution();var ab=$('#rec'+recid).find('.t396__artboard');window.tn_window_width=$(window).width();window.tn_scale_factor = Math.round((window.tn_window_width / res)*100)/100;t396_initTNobj();t396_switchResolution(res);t396_updateTNobj();t396_artboard_build(data,recid);$( window ).resize(function () {tn_console('>>>> t396: Window on Resize event >>>>');t396_waitForFinalEvent(function(){if($isMobile){var ww=$(window).width();if(ww!=window.tn_window_width){t396_doResize(recid);}}else{t396_doResize(recid);}}, 500, 'resizeruniqueid'+recid);});$(window).on("orientationchange",function(){tn_console('>>>> t396: Orient change event >>>>');t396_waitForFinalEvent(function(){t396_doResize(recid);}, 600, 'orientationuniqueid'+recid);});$( window ).on('load', function() {t396_allelems__renderView(ab);if (typeof t_lazyload_update === 'function' && ab.css('overflow') === 'auto') {ab.bind('scroll', t_throttle(function() {if (window.lazy === 'y' || $('#allrecords').attr('data-tilda-lazy') === 'yes') {t_onFuncLoad('t_lazyload_update', function () {t_lazyload_update();});}}, 500));}if (window.location.hash !== '' && ab.css('overflow') === 'visible') {ab.css('overflow', 'hidden');setTimeout( function() { ab.css('overflow', 'visible');}, 1);}});var rec = $('#rec' + recid);if (rec.attr('data-connect-with-tab') == 'yes') {rec.find('.t396').bind('displayChanged', function() {var ab = rec.find('.t396__artboard');t396_allelems__renderView(ab);});}/* fix for disappearing elements in safari */if (isSafari) rec.find('.t396').addClass('t396_safari');var isScaled = t396_ab__getFieldValue(ab, 'upscale') === 'window';var isTildaModeEdit = $('#allrecords').attr('data-tilda-mode') == 'edit';if (isScaled && !isTildaModeEdit) t396_scaleBlock(recid);}function t396_getRotateValue(matrix) {console.log(matrix);var values = matrix.split('(')[1].split(')')[0].split(',');var a = values[0];var b = values[1];var c = values[2];var d = values[3];var scale = Math.sqrt(a*a + b*b);var sin = b/scale;var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));return angle;}function t396_scaleBlock(recid) {var isFirefox = navigator.userAgent.search("Firefox") !== -1;var res = t396_detectResolution();var rec = $('#rec' + recid);var $ab = rec.find('.t396__artboard');var abWidth = $ab.width();var updatedBlockHeight = Math.floor($ab.height() * window.tn_scale_factor);var ab_height_vh = t396_ab__getFieldValue($ab,'height_vh');window.tn_scale_offset = (abWidth * window.tn_scale_factor - abWidth) / 2;if (ab_height_vh != '') {var ab_min_height = t396_ab__getFieldValue($ab,'height');var ab_max_height = t396_ab__getHeight($ab);var scaledMinHeight = ab_min_height * window.tn_scale_factor;updatedBlockHeight = (scaledMinHeight >= ab_max_height) ? scaledMinHeight : ab_max_height;}$ab.addClass('t396__artboard_scale');var scaleStr = isFirefox ? ('transform: scale(' + window.tn_scale_factor + ') !important;') : ('zoom: ' + window.tn_scale_factor + ';');var styleStr ='<style class="t396__scale-style">' +'#rec' + recid + ' { overflow: visible !important; }' +'#rec' + recid + ' .t396__carrier,' +'#rec' + recid + ' .t396__filter,' +'#rec' + recid + ' .t396__artboard {' +'height: ' + updatedBlockHeight + 'px !important;' +'width: 100vw !important;' +'max-width: 100%;' +'}' +'<style>';$ab.append(styleStr);rec.find('.t396__elem').each(function() {var $el = $(this);var containerProp = t396_elem__getFieldValue($el, 'container');if (containerProp === 'grid') {if (isFirefox) {var scaleProp = 'scale(' + window.tn_scale_factor + ')';var transformMatrix = $el.find('.tn-atom').css('transform');var rotatation = (transformMatrix && transformMatrix !== 'none') ? t396_getRotateValue(transformMatrix) : null;if (rotatation) {$el.find('.tn-atom').css('transform-origin', 'center');scaleProp = scaleProp + ' rotate(' + rotatation + 'deg)';}$el.find('.tn-atom').css('transform', scaleProp);} else {$el.css('zoom', window.tn_scale_factor);if ($el.attr('data-elem-type') === 'text' && res < 1200) $el.find('.tn-atom').css('-webkit-text-size-adjust', 'auto');$el.find('.tn-atom').css('transform-origin', 'center');}}});} function t396_doResize(recid){var isFirefox = navigator.userAgent.search("Firefox") !== -1;var ww;var rec = $('#rec'+recid);if($isMobile){ww=$(window).width();} else {ww=window.innerWidth;}var res=t396_detectResolution();rec.find('.t396__scale-style').remove();if (!isFirefox) {rec.find('.t396__elem').css('zoom', '');rec.find('.t396__elem .tn-atom').css('transform-origin', '');}var ab = rec.find('.t396__artboard');var abWidth = ab.width();window.tn_window_width=ww;window.tn_scale_factor = Math.round((window.tn_window_width / res)*100)/100;window.tn_scale_offset = (abWidth * window.tn_scale_factor - abWidth) / 2;t396_switchResolution(res);t396_updateTNobj();t396_ab__renderView(ab);t396_allelems__renderView(ab);var isTildaModeEdit = $('#allrecords').attr('data-tilda-mode') == 'edit';var isScaled = t396_ab__getFieldValue(ab, 'upscale') === 'window';if (isScaled && !isTildaModeEdit) t396_scaleBlock(recid);}function t396_detectResolution(){var ww;if($isMobile){ww=$(window).width();} else {ww=window.innerWidth;}var res;res=1200;if(ww<1200){res=960;}if(ww<960){res=640;}if(ww<640){res=480;}if(ww<480){res=320;}return(res);}function t396_initTNobj(){tn_console('func: initTNobj');window.tn={};window.tn.canvas_min_sizes = ["320","480","640","960","1200"];window.tn.canvas_max_sizes = ["480","640","960","1200",""];window.tn.ab_fields = ["height","width","bgcolor","bgimg","bgattachment","bgposition","filteropacity","filtercolor","filteropacity2","filtercolor2","height_vh","valign"];}function t396_updateTNobj(){tn_console('func: updateTNobj');if(typeof window.zero_window_width_hook!='undefined' && window.zero_window_width_hook=='allrecords' && $('#allrecords').length){window.tn.window_width = parseInt($('#allrecords').width());}else{window.tn.window_width = parseInt($(window).width());}/* window.tn.window_width = parseInt($(window).width()); */if($isMobile){window.tn.window_height = parseInt($(window).height());} else {window.tn.window_height = parseInt(window.innerHeight);}if(window.tn.curResolution==1200){window.tn.canvas_min_width = 1200;window.tn.canvas_max_width = window.tn.window_width;}if(window.tn.curResolution==960){window.tn.canvas_min_width = 960;window.tn.canvas_max_width = 1200;}if(window.tn.curResolution==640){window.tn.canvas_min_width = 640;window.tn.canvas_max_width = 960;}if(window.tn.curResolution==480){window.tn.canvas_min_width = 480;window.tn.canvas_max_width = 640;}if(window.tn.curResolution==320){window.tn.canvas_min_width = 320;window.tn.canvas_max_width = 480;}window.tn.grid_width = window.tn.canvas_min_width;window.tn.grid_offset_left = parseFloat( (window.tn.window_width-window.tn.grid_width)/2 );}var t396_waitForFinalEvent = (function () {var timers = {};return function (callback, ms, uniqueId) {if (!uniqueId) {uniqueId = "Don't call this twice without a uniqueId";}if (timers[uniqueId]) {clearTimeout (timers[uniqueId]);}timers[uniqueId] = setTimeout(callback, ms);};})();function t396_switchResolution(res,resmax){tn_console('func: switchResolution');if(typeof resmax=='undefined'){if(res==1200)resmax='';if(res==960)resmax=1200;if(res==640)resmax=960;if(res==480)resmax=640;if(res==320)resmax=480;}window.tn.curResolution=res;window.tn.curResolution_max=resmax;}function t396_artboard_build(data,recid){tn_console('func: t396_artboard_build. Recid:'+recid);tn_console(data);/* set style to artboard */var ab=$('#rec'+recid).find('.t396__artboard');t396_ab__renderView(ab);/* create elements */ab.find('.tn-elem').each(function() {var item=$(this);if(item.attr('data-elem-type')=='text'){t396_addText(ab,item);}if(item.attr('data-elem-type')=='image'){t396_addImage(ab,item);}if(item.attr('data-elem-type')=='shape'){t396_addShape(ab,item);}if(item.attr('data-elem-type')=='button'){t396_addButton(ab,item);}if(item.attr('data-elem-type')=='video'){t396_addVideo(ab,item);}if(item.attr('data-elem-type')=='html'){t396_addHtml(ab,item);}if(item.attr('data-elem-type')=='tooltip'){t396_addTooltip(ab,item);}if(item.attr('data-elem-type')=='form'){t396_addForm(ab,item);}if(item.attr('data-elem-type')=='gallery'){t396_addGallery(ab,item);}});$('#rec'+recid).find('.t396__artboard').removeClass('rendering').addClass('rendered');if(ab.attr('data-artboard-ovrflw')=='visible'){$('#allrecords').css('overflow','hidden');}if($isMobile){$('#rec'+recid).append('<style>@media only screen and (min-width:1366px) and (orientation:landscape) and (-webkit-min-device-pixel-ratio:2) {.t396__carrier {background-attachment:scroll!important;}}</style>');}}function t396_ab__renderView(ab){var fields = window.tn.ab_fields;for ( var i = 0; i < fields.length; i++ ) {t396_ab__renderViewOneField(ab,fields[i]);}var ab_min_height=t396_ab__getFieldValue(ab,'height');var ab_max_height=t396_ab__getHeight(ab);var isTildaModeEdit = $('#allrecords').attr('data-tilda-mode') == 'edit';var isScaled = t396_ab__getFieldValue(ab, 'upscale') === 'window';var ab_height_vh = t396_ab__getFieldValue(ab,'height_vh');if (isScaled && !isTildaModeEdit && ab_height_vh != '') var scaledMinHeight = parseInt(ab_min_height, 10) * window.tn_scale_factor;var offset_top=0;if(ab_min_height == ab_max_height || (scaledMinHeight && scaledMinHeight >= ab_max_height)) {offset_top=0;}else{var ab_valign=t396_ab__getFieldValue(ab,'valign');if(ab_valign=='top'){offset_top=0;}else if(ab_valign=='center'){if (scaledMinHeight) {offset_top=parseFloat( (ab_max_height-scaledMinHeight)/2 ).toFixed(1);} else {offset_top=parseFloat( (ab_max_height-ab_min_height)/2 ).toFixed(1);}}else if(ab_valign=='bottom'){if (scaledMinHeight) {offset_top=parseFloat( (ab_max_height-scaledMinHeight) ).toFixed(1);} else {offset_top=parseFloat( (ab_max_height-ab_min_height) ).toFixed(1);}}else if(ab_valign=='stretch'){offset_top=0;ab_min_height=ab_max_height;}else{offset_top=0;}}ab.attr('data-artboard-proxy-min-offset-top',offset_top);ab.attr('data-artboard-proxy-min-height',ab_min_height);ab.attr('data-artboard-proxy-max-height',ab_max_height);var filter = ab.find('.t396__filter');var carrier = ab.find('.t396__carrier');var abHeightVh = t396_ab__getFieldValue(ab,'height_vh');abHeightVh = parseFloat(abHeightVh);if (window.isMobile && abHeightVh) {var height = document.documentElement.clientHeight * parseFloat( abHeightVh/100 );ab.css('height', height);filter.css('height', height);carrier.css('height', height);}}function t396_addText(ab,el){tn_console('func: addText');/* add data atributes */var fields_str='top,left,width,container,axisx,axisy,widthunits,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);/* render elem view */t396_elem__renderView(el);}function t396_addImage(ab,el){tn_console('func: addImage');/* add data atributes */var fields_str='img,width,filewidth,fileheight,top,left,container,axisx,axisy,widthunits,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);/* render elem view */t396_elem__renderView(el);el.find('img').on("load", function() {t396_elem__renderViewOneField(el,'top');if(typeof $(this).attr('src')!='undefined' && $(this).attr('src')!=''){setTimeout( function() { t396_elem__renderViewOneField(el,'top');} , 2000);} }).each(function() {if(this.complete) $(this).trigger('load');}); el.find('img').on('tuwidget_done', function(e, file) { t396_elem__renderViewOneField(el,'top');});}function t396_addShape(ab,el){tn_console('func: addShape');/* add data atributes */var fields_str='width,height,top,left,';fields_str+='container,axisx,axisy,widthunits,heightunits,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);/* render elem view */t396_elem__renderView(el);}function t396_addButton(ab,el){tn_console('func: addButton');/* add data atributes */var fields_str='top,left,width,height,container,axisx,axisy,caption,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);/* render elem view */t396_elem__renderView(el);return(el);}function t396_addVideo(ab,el){tn_console('func: addVideo');/* add data atributes */var fields_str='width,height,top,left,';fields_str+='container,axisx,axisy,widthunits,heightunits,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);/* render elem view */t396_elem__renderView(el);var viel=el.find('.tn-atom__videoiframe');var viatel=el.find('.tn-atom');viatel.css('background-color','#000');var vihascover=viatel.attr('data-atom-video-has-cover');if(typeof vihascover=='undefined'){vihascover='';}if(vihascover=='y'){viatel.click(function() {var viifel=viel.find('iframe');if(viifel.length){var foo=viifel.attr('data-original');viifel.attr('src',foo);}viatel.css('background-image','none');viatel.find('.tn-atom__video-play-link').css('display','none');});}var autoplay=t396_elem__getFieldValue(el,'autoplay');var showinfo=t396_elem__getFieldValue(el,'showinfo');var loop=t396_elem__getFieldValue(el,'loop');var mute=t396_elem__getFieldValue(el,'mute');var startsec=t396_elem__getFieldValue(el,'startsec');var endsec=t396_elem__getFieldValue(el,'endsec');var tmode=$('#allrecords').attr('data-tilda-mode');var url='';var viyid=viel.attr('data-youtubeid');if(typeof viyid!='undefined' && viyid!=''){ url='//www.youtube.com/embed/'; url+=viyid+'?rel=0&fmt=18&html5=1'; url+='&showinfo='+(showinfo=='y'?'1':'0'); if(loop=='y'){url+='&loop=1&playlist='+viyid;} if(startsec>0){url+='&start='+startsec;} if(endsec>0){url+='&end='+endsec;} if(mute=='y'){url+='&mute=1';} if(vihascover=='y'){ url+='&autoplay=1'; viel.html('<iframe id="youtubeiframe" width="100%" height="100%" data-original="'+url+'" frameborder="0" allowfullscreen data-flag-inst="y"></iframe>'); }else{ if(typeof tmode!='undefined' && tmode=='edit'){}else{ if(autoplay=='y'){url+='&autoplay=1';} } if(window.lazy=='y'){ viel.html('<iframe id="youtubeiframe" class="t-iframe" width="100%" height="100%" data-original="'+url+'" frameborder="0" allowfullscreen data-flag-inst="lazy"></iframe>'); el.append('<script>lazyload_iframe = new LazyLoad({elements_selector: ".t-iframe"});<\/script>'); }else{ viel.html('<iframe id="youtubeiframe" width="100%" height="100%" src="'+url+'" frameborder="0" allowfullscreen data-flag-inst="y"></iframe>'); } }}var vivid=viel.attr('data-vimeoid');if(typeof vivid!='undefined' && vivid>0){url='//player.vimeo.com/video/';url+=vivid+'?color=ffffff&badge=0';if(showinfo=='y'){url+='&title=1&byline=1&portrait=1';}else{url+='&title=0&byline=0&portrait=0';}if(loop=='y'){url+='&loop=1';}if(mute=='y'){url+='&muted=1';}if(vihascover=='y'){url+='&autoplay=1';viel.html('<iframe data-original="'+url+'" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');}else{if(typeof tmode!='undefined' && tmode=='edit'){}else{if(autoplay=='y'){url+='&autoplay=1';}}if(window.lazy=='y'){viel.html('<iframe class="t-iframe" data-original="'+url+'" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');el.append('<script>lazyload_iframe = new LazyLoad({elements_selector: ".t-iframe"});<\/script>');}else{viel.html('<iframe src="'+url+'" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');}}}}function t396_addHtml(ab,el){tn_console('func: addHtml');/* add data atributes */var fields_str='width,height,top,left,';fields_str+='container,axisx,axisy,widthunits,heightunits,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);/* render elem view */t396_elem__renderView(el);}function t396_addTooltip(ab, el) {tn_console('func: addTooltip');var fields_str = 'width,height,top,left,';fields_str += 'container,axisx,axisy,widthunits,heightunits,leftunits,topunits,tipposition';var fields = fields_str.split(',');el.attr('data-fields', fields_str);t396_elem__renderView(el);var pinEl = el.find('.tn-atom__pin');var tipEl = el.find('.tn-atom__tip');var tipopen = el.attr('data-field-tipopen-value');if (isMobile || (typeof tipopen!='undefined' && tipopen=='click')) {t396_setUpTooltip_mobile(el,pinEl,tipEl);} else {t396_setUpTooltip_desktop(el,pinEl,tipEl);}setTimeout(function() {$('.tn-atom__tip-img').each(function() {var foo = $(this).attr('data-tipimg-original');if (typeof foo != 'undefined' && foo != '') {$(this).attr('src', foo);}})}, 3000);}function t396_addForm(ab,el){tn_console('func: addForm');/* add data atributes */var fields_str='width,top,left,';fields_str+='inputs,container,axisx,axisy,widthunits,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);/* render elem view */t396_elem__renderView(el);}function t396_addGallery(ab,el){tn_console('func: addForm');/* add data atributes */var fields_str='width,height,top,left,';fields_str+='imgs,container,axisx,axisy,widthunits,heightunits,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);/* render elem view */t396_elem__renderView(el);}function t396_elem__setFieldValue(el,prop,val,flag_render,flag_updateui,res){if(res=='')res=window.tn.curResolution;if(res<1200 && prop!='zindex'){el.attr('data-field-'+prop+'-res-'+res+'-value',val);}else{el.attr('data-field-'+prop+'-value',val);}if(flag_render=='render')elem__renderViewOneField(el,prop);if(flag_updateui=='updateui')panelSettings__updateUi(el,prop,val);}function t396_elem__getFieldValue(el,prop){var res=window.tn.curResolution;var r;if(res<1200){if(res==960){r=el.attr('data-field-'+prop+'-res-960-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-value');}}if(res==640){r=el.attr('data-field-'+prop+'-res-640-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-res-960-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-value');}}}if(res==480){r=el.attr('data-field-'+prop+'-res-480-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-res-640-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-res-960-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-value');}}}}if(res==320){r=el.attr('data-field-'+prop+'-res-320-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-res-480-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-res-640-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-res-960-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-value');}}}}}}else{r=el.attr('data-field-'+prop+'-value');}return(r);}function t396_elem__renderView(el){tn_console('func: elem__renderView');var fields=el.attr('data-fields');if(! fields) {return false;}fields = fields.split(',');/* set to element value of every fieldvia css */for ( var i = 0; i < fields.length; i++ ) {t396_elem__renderViewOneField(el,fields[i]);}}function t396_elem__renderViewOneField(el,field){var value=t396_elem__getFieldValue(el,field);if(field=='left'){value = t396_elem__convertPosition__Local__toAbsolute(el,field,value);el.css('left',parseFloat(value).toFixed(1)+'px');}if(field=='top'){var ab = el.parents('.t396__artboard');value = t396_elem__convertPosition__Local__toAbsolute(el,field,value);el.css('top',parseFloat(value).toFixed(1)+'px');}if(field=='width'){value = t396_elem__getWidth(el,value);el.css('width',parseFloat(value).toFixed(1)+'px');var eltype=el.attr('data-elem-type');if(eltype=='tooltip'){var pinSvgIcon = el.find('.tn-atom__pin-icon');/*add width to svg nearest parent to fix InternerExplorer problem*/if (pinSvgIcon.length > 0) {var pinSize = parseFloat(value).toFixed(1) + 'px';pinSvgIcon.css({'width': pinSize, 'height': pinSize});}el.css('height',parseInt(value).toFixed(1)+'px');}if(eltype=='gallery') {var borderWidth = t396_elem__getFieldValue(el, 'borderwidth');var borderStyle = t396_elem__getFieldValue(el, 'borderstyle');if (borderStyle=='none' || typeof borderStyle=='undefined' || typeof borderWidth=='undefined' || borderWidth=='') borderWidth=0;value = value*1 - borderWidth*2;el.css('width', parseFloat(value).toFixed(1)+'px');el.find('.t-slds__main').css('width', parseFloat(value).toFixed(1)+'px');el.find('.tn-atom__slds-img').css('width', parseFloat(value).toFixed(1)+'px');}}if(field=='height'){var eltype = el.attr('data-elem-type');if (eltype == 'tooltip') {return;}value=t396_elem__getHeight(el,value);el.css('height', parseFloat(value).toFixed(1)+'px');if (eltype === 'gallery') {var borderWidth = t396_elem__getFieldValue(el, 'borderwidth');var borderStyle = t396_elem__getFieldValue(el, 'borderstyle');if (borderStyle=='none' || typeof borderStyle=='undefined' || typeof borderWidth=='undefined' || borderWidth=='') borderWidth=0;value = value*1 - borderWidth*2;el.css('height',parseFloat(value).toFixed(1)+'px');el.find('.tn-atom__slds-img').css('height', parseFloat(value).toFixed(1) + 'px');el.find('.t-slds__main').css('height', parseFloat(value).toFixed(1) + 'px');}}if(field=='container'){t396_elem__renderViewOneField(el,'left');t396_elem__renderViewOneField(el,'top');}if(field=='width' || field=='height' || field=='fontsize' || field=='fontfamily' || field=='letterspacing' || field=='fontweight' || field=='img'){t396_elem__renderViewOneField(el,'left');t396_elem__renderViewOneField(el,'top');}if(field=='inputs'){value=el.find('.tn-atom__inputs-textarea').val();try {t_zeroForms__renderForm(el,value);} catch (err) {}}}function t396_elem__convertPosition__Local__toAbsolute(el,field,value){var ab = el.parents('.t396__artboard');var blockVAlign = t396_ab__getFieldValue(ab, 'valign');var isScaled = t396_ab__getFieldValue(ab, 'upscale') === 'window';var isTildaModeEdit = $('#allrecords').attr('data-tilda-mode') == 'edit';var isFirefox = navigator.userAgent.search("Firefox") !== -1;var isScaledFirefox = !isTildaModeEdit && isScaled && isFirefox;var isScaledNotFirefox = !isTildaModeEdit && isScaled && !isFirefox;var el_axisy = t396_elem__getFieldValue(el,'axisy');value = parseInt(value);if(field=='left'){var el_container, offset_left, el_container_width, el_width;var container = t396_elem__getFieldValue(el, 'container');if (container === 'grid') {el_container = 'grid';offset_left = window.tn.grid_offset_left;el_container_width = window.tn.grid_width;} else {el_container = 'window';offset_left = 0;el_container_width = window.tn.window_width;}/* fluid or not*/var el_leftunits = t396_elem__getFieldValue(el,'leftunits');if (el_leftunits === '%') {value = t396_roundFloat(el_container_width * value / 100);}/*with scale logic*/if (!isTildaModeEdit && isScaled) {if (container === 'grid' && isFirefox) value = value * window.tn_scale_factor;} else {value = offset_left + value;}var el_axisx = t396_elem__getFieldValue(el, 'axisx');if (el_axisx === 'center') {el_width = t396_elem__getWidth(el);if (isScaledFirefox && el_container !== 'window') {el_container_width *= window.tn_scale_factor;el_width *= window.tn_scale_factor;}value = el_container_width/2 - el_width/2 + value;}if (el_axisx === 'right') {el_width = t396_elem__getWidth(el);if (isScaledFirefox && el_container !== 'window') {el_container_width *= window.tn_scale_factor;el_width *= window.tn_scale_factor;}value = el_container_width - el_width + value;}}if (field === 'top') {var el_container, offset_top, el_container_height, el_height;var ab = el.parent();var container = t396_elem__getFieldValue(el, 'container');if (container === 'grid') {el_container = 'grid';offset_top = parseFloat(ab.attr('data-artboard-proxy-min-offset-top'));el_container_height = parseFloat(ab.attr('data-artboard-proxy-min-height'));} else {el_container = 'window';offset_top = 0;el_container_height = parseFloat(ab.attr('data-artboard-proxy-max-height'));}/* fluid or not*/var el_topunits = t396_elem__getFieldValue(el, 'topunits');if (el_topunits === '%') {value = (el_container_height * (value/100));}if (isScaledFirefox && el_container !== 'window') {value *= window.tn_scale_factor;}if (isScaledNotFirefox && el_container !== 'window') {offset_top = blockVAlign === 'stretch' ? 0 : (offset_top / window.tn_scale_factor);}value = offset_top + value;var ab_height_vh = t396_ab__getFieldValue(ab,'height_vh');var ab_min_height = t396_ab__getFieldValue(ab,'height');var ab_max_height = t396_ab__getHeight(ab);if (isScaled && !isTildaModeEdit && ab_height_vh != '') {var scaledMinHeight = parseInt(ab_min_height, 10) * window.tn_scale_factor;}if (el_axisy === 'center') {el_height = t396_elem__getHeight(el);if (el.attr('data-elem-type') === 'image') {el_width = t396_elem__getWidth(el);var fileWidth = t396_elem__getFieldValue(el,'filewidth');var fileHeight = t396_elem__getFieldValue(el,'fileheight');if (fileWidth && fileHeight) {var ratio = parseInt(fileWidth) / parseInt(fileHeight);el_height = el_width / ratio;}}if (isScaledFirefox && el_container !== 'window') {if (blockVAlign !== 'stretch') {el_container_height = el_container_height * window.tn_scale_factor} else {if (scaledMinHeight) {el_container_height = scaledMinHeight > ab_max_height ? scaledMinHeight : ab_max_height;} else {el_container_height = ab.height();}}el_height *= window.tn_scale_factor;}if (!isTildaModeEdit && isScaled && !isFirefox && el_container !== 'window' && blockVAlign === 'stretch') {if (scaledMinHeight) {el_container_height = scaledMinHeight > ab_max_height ? scaledMinHeight : ab_max_height;} else {el_container_height = ab.height();}el_container_height = el_container_height / window.tn_scale_factor}value = el_container_height/2 - el_height/2 + value;}if (el_axisy === 'bottom') {el_height = t396_elem__getHeight(el);if (el.attr('data-elem-type') === 'image') {el_width = t396_elem__getWidth(el);var fileWidth = t396_elem__getFieldValue(el,'filewidth');var fileHeight = t396_elem__getFieldValue(el,'fileheight');if (fileWidth && fileHeight) {var ratio = parseInt(fileWidth) / parseInt(fileHeight);el_height = el_width / ratio;}}if (isScaledFirefox && el_container !== 'window') {if (blockVAlign !== 'stretch') {el_container_height = el_container_height * window.tn_scale_factor} else {if (scaledMinHeight) {el_container_height = scaledMinHeight > ab_max_height ? scaledMinHeight : ab_max_height;} else {el_container_height = ab.height();}}el_height *= window.tn_scale_factor;}if (!isTildaModeEdit && isScaled && !isFirefox && el_container !== 'window' && blockVAlign === 'stretch') {if (scaledMinHeight) {el_container_height = scaledMinHeight > ab_max_height ? scaledMinHeight : ab_max_height;} else {el_container_height = ab.height();}el_container_height = el_container_height / window.tn_scale_factor}value = el_container_height - el_height + value;} }return(value);}function t396_ab__setFieldValue(ab,prop,val,res){/* tn_console('func: ab__setFieldValue '+prop+'='+val);*/if(res=='')res=window.tn.curResolution;if(res<1200){ab.attr('data-artboard-'+prop+'-res-'+res,val);}else{ab.attr('data-artboard-'+prop,val);}}function t396_ab__getFieldValue(ab,prop){var res=window.tn.curResolution;var r;if(res<1200){if(res==960){r=ab.attr('data-artboard-'+prop+'-res-960');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'');}}if(res==640){r=ab.attr('data-artboard-'+prop+'-res-640');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'-res-960');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'');}}}if(res==480){r=ab.attr('data-artboard-'+prop+'-res-480');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'-res-640');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'-res-960');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'');}}}}if(res==320){r=ab.attr('data-artboard-'+prop+'-res-320');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'-res-480');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'-res-640');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'-res-960');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'');}}}}}}else{r=ab.attr('data-artboard-'+prop);}return(r);}function t396_ab__renderViewOneField(ab,field){var value=t396_ab__getFieldValue(ab,field);}function t396_allelems__renderView(ab){tn_console('func: allelems__renderView: abid:'+ab.attr('data-artboard-recid'));ab.find(".tn-elem").each(function() {t396_elem__renderView($(this));});}function t396_ab__filterUpdate(ab){var filter=ab.find('.t396__filter');var c1=filter.attr('data-filtercolor-rgb');var c2=filter.attr('data-filtercolor2-rgb');var o1=filter.attr('data-filteropacity');var o2=filter.attr('data-filteropacity2');if((typeof c2=='undefined' || c2=='') && (typeof c1!='undefined' && c1!='')){filter.css("background-color", "rgba("+c1+","+o1+")");}else if((typeof c1=='undefined' || c1=='') && (typeof c2!='undefined' && c2!='')){filter.css("background-color", "rgba("+c2+","+o2+")");}else if(typeof c1!='undefined' && typeof c2!='undefined' && c1!='' && c2!=''){filter.css({background: "-webkit-gradient(linear, left top, left bottom, from(rgba("+c1+","+o1+")), to(rgba("+c2+","+o2+")) )" });}else{filter.css("background-color", 'transparent');}}function t396_ab__getHeight(ab, ab_height){if(typeof ab_height=='undefined')ab_height=t396_ab__getFieldValue(ab,'height');ab_height=parseFloat(ab_height);/* get Artboard height (fluid or px) */var ab_height_vh=t396_ab__getFieldValue(ab,'height_vh');if(ab_height_vh!=''){ab_height_vh=parseFloat(ab_height_vh);if(isNaN(ab_height_vh)===false){var ab_height_vh_px=parseFloat( window.tn.window_height * parseFloat(ab_height_vh/100) );if( ab_height < ab_height_vh_px ){ab_height=ab_height_vh_px;}}} return(ab_height);} function t396_hex2rgb(hexStr){/*note: hexStr should be #rrggbb */var hex = parseInt(hexStr.substring(1), 16);var r = (hex & 0xff0000) >> 16;var g = (hex & 0x00ff00) >> 8;var b = hex & 0x0000ff;return [r, g, b];}String.prototype.t396_replaceAll = function(search, replacement) {var target = this;return target.replace(new RegExp(search, 'g'), replacement);};function t396_elem__getWidth(el,value){if(typeof value=='undefined')value=parseFloat( t396_elem__getFieldValue(el,'width') );var el_widthunits=t396_elem__getFieldValue(el,'widthunits');if(el_widthunits=='%'){var el_container=t396_elem__getFieldValue(el,'container');if(el_container=='window'){value=parseFloat( window.tn.window_width * parseFloat( parseInt(value)/100 ) );}else{value=parseFloat( window.tn.grid_width * parseFloat( parseInt(value)/100 ) );}}return(value);}function t396_elem__getHeight(el,value){if(typeof value=='undefined')value=t396_elem__getFieldValue(el,'height');value=parseFloat(value);if(el.attr('data-elem-type')=='shape' || el.attr('data-elem-type')=='video' || el.attr('data-elem-type')=='html' || el.attr('data-elem-type')=='gallery'){var el_heightunits=t396_elem__getFieldValue(el,'heightunits');if(el_heightunits=='%'){var ab=el.parent();var ab_min_height=parseFloat( ab.attr('data-artboard-proxy-min-height') );var ab_max_height=parseFloat( ab.attr('data-artboard-proxy-max-height') );var el_container=t396_elem__getFieldValue(el,'container');if(el_container=='window'){value=parseFloat( ab_max_height * parseFloat( value/100 ) );}else{value=parseFloat( ab_min_height * parseFloat( value/100 ) );}}}else if(el.attr('data-elem-type')=='button'){value = value;}else{value =parseFloat(el.innerHeight());}return(value);}function t396_roundFloat(n){n = Math.round(n * 100) / 100;return(n);}function tn_console(str){if(window.tn_comments==1)console.log(str);}function t396_setUpTooltip_desktop(el, pinEl, tipEl) {var timer;pinEl.mouseover(function() {/*if any other tooltip is waiting its timeout to be hided — hide it*/$('.tn-atom__tip_visible').each(function(){var thisTipEl = $(this).parents('.t396__elem');if (thisTipEl.attr('data-elem-id') != el.attr('data-elem-id')) {t396_hideTooltip(thisTipEl, $(this));}});clearTimeout(timer);if (tipEl.css('display') == 'block') {return;}t396_showTooltip(el, tipEl);});pinEl.mouseout(function() {timer = setTimeout(function() {t396_hideTooltip(el, tipEl);}, 300);})}function t396_setUpTooltip_mobile(el,pinEl,tipEl) {pinEl.on('click', function(e) {if (tipEl.css('display') == 'block' && $(e.target).hasClass("tn-atom__pin")) {t396_hideTooltip(el,tipEl);} else {t396_showTooltip(el,tipEl);}});var id = el.attr("data-elem-id");$(document).click(function(e) {var isInsideTooltip = ($(e.target).hasClass("tn-atom__pin") || $(e.target).parents(".tn-atom__pin").length > 0);if (isInsideTooltip) {var clickedPinId = $(e.target).parents(".t396__elem").attr("data-elem-id");if (clickedPinId == id) {return;}}t396_hideTooltip(el,tipEl);})}function t396_hideTooltip(el, tipEl) {tipEl.css('display', '');tipEl.css({"left": "","transform": "","right": ""});tipEl.removeClass('tn-atom__tip_visible');el.css('z-index', '');}function t396_showTooltip(el, tipEl) {var pos = el.attr("data-field-tipposition-value");if (typeof pos == 'undefined' || pos == '') {pos = 'top';};var elSize = el.height();var elTop = el.offset().top;var elBottom = elTop + elSize;var elLeft = el.offset().left;var elRight = el.offset().left + elSize;var winTop = $(window).scrollTop();var winWidth = $(window).width();var winBottom = winTop + $(window).height();var tipElHeight = tipEl.outerHeight();var tipElWidth = tipEl.outerWidth();var padd=15;if (pos == 'right' || pos == 'left') {var tipElRight = elRight + padd + tipElWidth;var tipElLeft = elLeft - padd - tipElWidth;if ((pos == 'right' && tipElRight > winWidth) || (pos == 'left' && tipElLeft < 0)) {pos = 'top';}}if (pos == 'top' || pos == 'bottom') {var tipElRight = elRight + (tipElWidth / 2 - elSize / 2);var tipElLeft = elLeft - (tipElWidth / 2 - elSize / 2);if (tipElRight > winWidth) {var rightOffset = -(winWidth - elRight - padd);tipEl.css({"left": "auto","transform": "none","right": rightOffset + "px"});}if (tipElLeft < 0) {var leftOffset = -(elLeft - padd);tipEl.css({"left": leftOffset + "px","transform": "none"});}}if (pos == 'top') {var tipElTop = elTop - padd - tipElHeight;var tipElBottom = elBottom + padd + tipElHeight;if (winBottom > tipElBottom && winTop > tipElTop) {pos = 'bottom';}}if (pos == 'bottom') {var tipElTop = elTop - padd - tipElHeight;var tipElBottom = elBottom + padd + tipElHeight;if (winBottom < tipElBottom && winTop < tipElTop) {pos = 'top';}}tipEl.attr('data-tip-pos', pos);tipEl.css('display', 'block');tipEl.addClass('tn-atom__tip_visible');el.css('z-index', '1000');}function t396_hex2rgba(hexStr, opacity){var hex = parseInt(hexStr.substring(1), 16);var r = (hex & 0xff0000) >> 16;var g = (hex & 0x00ff00) >> 8;var b = hex & 0x0000ff;return [r, g, b, parseFloat(opacity)];} 
 
function t409_unifyHeights(recid) {
  if($(window).width()>=960){
    var el = $("#rec"+recid);
    var imgwidth = el.find(".t409__img").width();
    var imgwrapperwidth = el.find(".t409__imgwrapper").css("max-width");
    var imgwrapperwidthpx = parseInt(imgwrapperwidth, 10);
    var margin = imgwrapperwidthpx - imgwidth;
    el.find(".t409__img").css("margin-left", margin);
  }
}
 
function t456_setListMagin(recid, imglogo) {
    if ($(window).width() > 980) {
        var t456__menu = $('#rec' + recid + ' .t456');
        var t456__leftpart = t456__menu.find('.t456__leftwrapper');
        var t456__listpart = t456__menu.find('.t456__list');
        if (imglogo) {
            t456__listpart.css("margin-right", t456__leftpart.width());
        } else {
            t456__listpart.css("margin-right", t456__leftpart.width() + 30);
        }
    }
}

function t456_highlight() {
    var url = window.location.href;
    var pathname = window.location.pathname;
    if (url.substr(url.length - 1) == "/") {
        url = url.slice(0, -1);
    }
    if (pathname.substr(pathname.length - 1) == "/") {
        pathname = pathname.slice(0, -1);
    }
    if (pathname.charAt(0) == "/") {
        pathname = pathname.slice(1);
    }
    if (pathname == "") {
        pathname = "/";
    }
    $(".t456__list_item a[href='" + url + "']").addClass("t-active");
    $(".t456__list_item a[href='" + url + "/']").addClass("t-active");
    $(".t456__list_item a[href='" + pathname + "']").addClass("t-active");
    $(".t456__list_item a[href='/" + pathname + "']").addClass("t-active");
    $(".t456__list_item a[href='" + pathname + "/']").addClass("t-active");
    $(".t456__list_item a[href='/" + pathname + "/']").addClass("t-active");
}


function t456_checkAnchorLinks(recid) {
    if ($(window).width() >= 960) {
        var t456_navLinks = $("#rec" + recid + " .t456__list_item a:not(.tooltipstered)[href*='#']");
        if (t456_navLinks.length > 0) {
            t456_catchScroll(t456_navLinks);
        }
    }
}

function t456_catchScroll(t456_navLinks) {
    var t456_clickedSectionId = null,
        t456_sections = new Array(),
        t456_sectionIdTonavigationLink = [],
        t456_interval = 100,
        t456_lastCall, t456_timeoutId;
    t456_navLinks = $(t456_navLinks.get().reverse());
    t456_navLinks.each(function () {
        var t456_cursection = t456_getSectionByHref($(this));
        if (typeof t456_cursection !== "undefined") {
            if (typeof t456_cursection.attr("id") != "undefined") {
                t456_sections.push(t456_cursection);
            }
            t456_sectionIdTonavigationLink[t456_cursection.attr("id")] = $(this);
        }
    });
    t456_updateSectionsOffsets(t456_sections);
    t456_sections.sort(function (a, b) {
        return b.attr("data-offset-top") - a.attr("data-offset-top");
    });
    $(window).bind('resize', t_throttle(function () {
        t456_updateSectionsOffsets(t456_sections);
    }, 200));
    $('.t456').bind('displayChanged', function () {
        t456_updateSectionsOffsets(t456_sections);
    });
    setInterval(function () {
        t456_updateSectionsOffsets(t456_sections);
    }, 5000);
    t456_highlightNavLinks(t456_navLinks, t456_sections, t456_sectionIdTonavigationLink, t456_clickedSectionId);

    t456_navLinks.click(function () {
        var t456_clickedSection = t456_getSectionByHref($(this));
        if (typeof t456_clickedSection !== "undefined" && !$(this).hasClass("tooltipstered") && typeof t456_clickedSection.attr("id") != "undefined") {
            t456_navLinks.removeClass('t-active');
            $(this).addClass('t-active');
            t456_clickedSectionId = t456_getSectionByHref($(this)).attr("id");
        }
    });
    
    $(window).scroll(function () {
        var t456_now = new Date().getTime();
        if (t456_lastCall && t456_now < (t456_lastCall + t456_interval)) {
            clearTimeout(t456_timeoutId);
            t456_timeoutId = setTimeout(function () {
                t456_lastCall = t456_now;
                t456_clickedSectionId = t456_highlightNavLinks(t456_navLinks, t456_sections, t456_sectionIdTonavigationLink, t456_clickedSectionId);
            }, t456_interval - (t456_now - t456_lastCall));
        } else {
            t456_lastCall = t456_now;
            t456_clickedSectionId = t456_highlightNavLinks(t456_navLinks, t456_sections, t456_sectionIdTonavigationLink, t456_clickedSectionId);
        }
    });
}


function t456_updateSectionsOffsets(sections) {
    $(sections).each(function () {
        var t456_curSection = $(this);
        t456_curSection.attr("data-offset-top", t456_curSection.offset().top);
    });
}


function t456_getSectionByHref(curlink) {
    var hash = curlink.attr("href").replace(/\s+/g, '').replace(/.*#/, '');
    var block = $(".r[id='" + hash + "']");
    var anchor = $(".r[data-record-type='215']").has("a[name='" + hash + "']");
    
    if (curlink.is('[href*="#rec"]')) {
        return block;
    } else if (anchor.length === 1) {
        return anchor;
    } else {
        return undefined;
    }
}


function t456_highlightNavLinks(t456_navLinks, t456_sections, t456_sectionIdTonavigationLink, t456_clickedSectionId) {
    var t456_scrollPosition = $(window).scrollTop(),
        t456_valueToReturn = t456_clickedSectionId;
    /*if first section is not at the page top (under first blocks)*/
    if (t456_sections.length != 0 && t456_clickedSectionId == null && t456_sections[t456_sections.length - 1].attr("data-offset-top") > (t456_scrollPosition + 300)) {
        t456_navLinks.removeClass('t-active');
        return null;
    }

    $(t456_sections).each(function (e) {
        var t456_curSection = $(this),
            t456_sectionTop = t456_curSection.attr("data-offset-top"),
            t456_id = t456_curSection.attr('id'),
            t456_navLink = t456_sectionIdTonavigationLink[t456_id];
        if (((t456_scrollPosition + 300) >= t456_sectionTop) || (t456_sections[0].attr("id") == t456_id && t456_scrollPosition >= $(document).height() - $(window).height())) {
            if (t456_clickedSectionId == null && !t456_navLink.hasClass('t-active')) {
                t456_navLinks.removeClass('t-active');
                t456_navLink.addClass('t-active');
                t456_valueToReturn = null;
            } else {
                if (t456_clickedSectionId != null && t456_id == t456_clickedSectionId) {
                    t456_valueToReturn = null;
                }
            }
            return false;
        }
    });
    return t456_valueToReturn;
}

function t456_setPath() {}

function t456_setBg(recid) {
    var window_width = $(window).width();
    if (window_width > 980) {
        $(".t456").each(function () {
            var el = $(this);
            if (el.attr('data-bgcolor-setbyscript') == "yes") {
                var bgcolor = el.attr("data-bgcolor-rgba");
                el.css("background-color", bgcolor);
            }
        });
    } else {
        $(".t456").each(function () {
            var el = $(this);
            var bgcolor = el.attr("data-bgcolor-hex");
            el.css("background-color", bgcolor);
            el.attr("data-bgcolor-setbyscript", "yes");
        });
    }
}

function t456_appearMenu(recid) {
    var window_width = $(window).width();
    if (window_width > 980) {
        $(".t456").each(function () {
            var el = $(this);
            var appearoffset = el.attr("data-appearoffset");
            if (appearoffset != "") {
                if (appearoffset.indexOf('vh') > -1) {
                    appearoffset = Math.floor((window.innerHeight * (parseInt(appearoffset) / 100)));
                }

                appearoffset = parseInt(appearoffset, 10);

                if ($(window).scrollTop() >= appearoffset) {
                    if (el.css('visibility') == 'hidden') {
                        el.finish();
                        el.css("top", "-50px");
                        el.css("visibility", "visible");
                        el.animate({
                            "opacity": "1",
                            "top": "0px"
                        }, 200, function () {});
                    }
                } else {
                    el.stop();
                    el.css("visibility", "hidden");
                }
            }
        });
    }

}

function t456_changebgopacitymenu(recid) {
    var window_width = $(window).width();
    if (window_width > 980) {
        $(".t456").each(function () {
            var el = $(this);
            var bgcolor = el.attr("data-bgcolor-rgba");
            var bgcolor_afterscroll = el.attr("data-bgcolor-rgba-afterscroll");
            var bgopacityone = el.attr("data-bgopacity");
            var bgopacitytwo = el.attr("data-bgopacity-two");
            var menushadow = el.attr("data-menushadow");
            if (menushadow == '100') {
                var menushadowvalue = menushadow;
            } else {
                var menushadowvalue = '0.' + menushadow;
            }
            if ($(window).scrollTop() > 20) {
                el.css("background-color", bgcolor_afterscroll);
                if (bgopacitytwo == '0' || menushadow == ' ') {
                    el.css("box-shadow", "none");
                } else {
                    el.css("box-shadow", "0px 1px 3px rgba(0,0,0," + menushadowvalue + ")");
                }
            } else {
                el.css("background-color", bgcolor);
                if (bgopacityone == '0.0' || menushadow == ' ') {
                    el.css("box-shadow", "none");
                } else {
                    el.css("box-shadow", "0px 1px 3px rgba(0,0,0," + menushadowvalue + ")");
                }
            }
        });
    }
}

function t456_createMobileMenu(recid) {
    var window_width = $(window).width(),
        el = $("#rec" + recid),
        menu = el.find(".t456"),
        burger = el.find(".t456__mobile");
    burger.click(function (e) {
        menu.fadeToggle(300);
        $(this).toggleClass("t456_opened")
    });
    $(window).bind('resize', t_throttle(function () {
        window_width = $(window).width();
        if (window_width > 980) {
            menu.fadeIn(0);
        }
    }, 200));
} 
function t477_setHeight(recid, imgHeight) {
  var el=$('#rec'+recid);
  if (imgHeight) el.find('.t477__blockimg').css('height', imgHeight);
  el.find('.t-container').each(function() {
    var highestBox = 0;
    el.find('.t477__col', this).each(function(){
        if($(this).height() > highestBox)highestBox = $(this).height(); 
    });
    el.find('.t477__textwrapper',this).css('height', highestBox);
    el.find('.t477__blockimg',this).css('height', highestBox);
  });
} 
function t478_setHeight(recid) {
  var el=$('#rec'+recid);
  var sizer = el.find('.t478__sizer');
  var height = sizer.height();
  var width = sizer.width();
  var ratio = width/height;
  var imgwrapper = el.find(".t478__blockimg, .t478__textwrapper");
  var imgwidth = imgwrapper.width();
  if (height != $(window).height()) {
    imgwrapper.css({'height':((width/ratio)+'px')});
  }
} 
function t509_setHeight(recid) {  
  var t509__el=$("#rec"+recid);	
  var t509__image = t509__el.find(".t509__blockimg");
  t509__image.each(function() {
    var t509__width = $(this).attr("data-image-width");
    var t509__height = $(this).attr("data-image-height");	
    var t509__ratio = t509__height/t509__width;
    var t509__padding = t509__ratio*100;    	
    $(this).css("padding-bottom",t509__padding+"%");		
  });
  
  if ($(window).width()>960){
    var t509__textwr = t509__el.find(".t509__textwrapper");
    var t509__deskimg = t509__el.find(".t509__desktopimg");
    t509__textwr.each(function() {    
    $(this).css("height", t509__deskimg.innerHeight());	
    });
  }
}
 
function t544_setHeight(recid) {
  var el=$('#rec'+recid);
  var sizer = el.find('.t544__sizer');
  var height = sizer.height();
  var width = sizer.width();
  var ratio = width/height;
  var imgwrapper = el.find(".t544__blockimg, .t544__textwrapper");
  var imgwidth = imgwrapper.width();
  if (height != $(window).height()) {
    imgwrapper.css({'height':((imgwidth/ratio)+'px')});
  }
} 
function t576_init(recid){
  var el = $('#rec'+recid),
      line = el.find('.t576__line'),
      cirqle = el.find('.t576__cicqle'),
      block = el.find('.t576__item'),
      t576_resize;

  block.each(function() {
    $(this).find('.t576__circle').css('top', $(this).find('.t576__img').outerHeight() + 15);
  });

  el.find('.t576__item:first-child').find('.t576__line').css('top', el.find('.t576__item:first-child').find('.t576__img').outerHeight() + 15);
                      
  el.find('.t576__item:last-child').find('.t576__line').css('height', el.find('.t576__item:last-child').find('.t576__img').outerHeight() + 20);
} 
function t585_init(recid) {
    var el = $('#rec' + recid);
    var toggler = el.find(".t585__header");

    var accordion = el.find('.t585__accordion');
    if (accordion) {
        accordion = accordion.attr('data-accordion');
    } else {
        accordion = "false";
    }
    
    var scrolltoExpand = el.find('.t585__accordion').attr('data-scroll-to-expanded');
    
    toggler.click(function () {
        if (accordion === "true") {
            toggler.not(this).removeClass("t585__opened").next().slideUp();
        }
        
        $(this).toggleClass("t585__opened");
        var _this = $(this);
        $(this).next().slideToggle(function() {
            if (scrolltoExpand === "true") {
                $('html, body').animate({
                    scrollTop: $(_this).offset().top || el.offset().top
                }, 300);
            }
        });
        if (window.lazy === 'y' || $('#allrecords').attr('data-tilda-lazy') === 'yes') {
            t_onFuncLoad('t_lazyload_update', function () {
                t_lazyload_update();
            });
        }
    });
} 
function t604_init(recid) {  
    var el = $('#rec' + recid);

    t604_imageHeight(recid);
    t604_arrowWidth(recid);
    t604_show(recid);
    t604_hide(recid);

    $(window).bind('resize', t_throttle(function() {
        t_onFuncLoad('t_slds_updateSlider', function () {
            t_slds_updateSlider(recid);
        });
        t604_arrowWidth(recid);
    }));

    el.find('.t604').bind('displayChanged', function() {
        t_onFuncLoad('t_slds_updateSlider', function () {
            t_slds_updateSlider(recid);
        });
        t604_arrowWidth(recid);
    });
}

function t604_show(recid) {  
  var el=$("#rec"+recid),
      play = el.find('.t604__play');
  play.click(function(){
    if($(this).attr('data-slider-video-type')=='youtube'){
      var url = $(this).attr('data-slider-video-url');
      $(this).next().html("<iframe class=\"t604__iframe\" width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/"+url+"?autoplay=1\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>");
    }
    if($(this).attr('data-slider-video-type')=='vimeo'){
      var url = $(this).attr('data-slider-video-url');
      $(this).next().html("<iframe class=\"t604__iframe\" width=\"100%\" height=\"100%\" src=\"https://player.vimeo.com/video/"+url+"?autoplay=1\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>");
    }
    $(this).next().css('z-index', '3');
  });
}

function t604_hide(recid) {  
  var el=$("#rec"+recid),
      body = el.find('.t604__frame');
  el.on('updateSlider', function(){
    body.html('').css('z-index', '');
  });
}

function t604_imageHeight(recid) {  
  var el=$("#rec"+recid); 
  var image = el.find(".t604__separator");
  image.each(function() {
    var width = $(this).attr("data-slider-image-width");
    var height = $(this).attr("data-slider-image-height"); 
    var ratio = height/width;
    var padding = ratio*100;      
    $(this).css("padding-bottom",padding+"%");    
  });
}

function t604_arrowWidth(recid) {  
  var el=$("#rec"+recid),
      arrow = el.find('.t-slds__arrow_wrapper'),
      slideWidth = el.find('.t-slds__wrapper').width(),
      windowWidth = $(window).width(),
      arrowWidth = windowWidth-slideWidth;
  if(windowWidth>960){
    arrow.css('width', arrowWidth/2);
  } else {
    arrow.css('width', '');
  }
} 
function t615_init(recid) {
    var el = $('#rec' + recid);

    if (el.find('.t615__title').length) {
        t615_equalHeight(el.find('.t615__title'));
    }
    if (el.find('.t615__descr').length) {
        t615_equalHeight(el.find('.t615__descr'));
    }
    if (el.find('.t615__price').length) {
        t615_equalHeight(el.find('.t615__price'));
    }
    if (el.find('.t615__imgwrapper').length) {
        t615_equalHeight(el.find('.t615__imgwrapper'));
        $(window).on('load', function () {
            t615_equalHeight(el.find('.t615__imgwrapper'));
        });
    }
}

function t615_equalHeight(element) {
    var highestBox = 0;

    element.css('height', '');

    element.each(function () {
        if ($(this).height() > highestBox) highestBox = $(this).height();
    });

    if ($(window).width() >= 960) {
        element.css('height', highestBox);
    } else {
        element.css('height', '');
    }
} 
function t650_unifyHeights(recid) {
if($(window).width()>=960){
	$('#rec'+recid+' .t650 .t-container .t650__row').each(function() {
		var t650_highestBox = 0,
			t650_currow = $(this);
		$('.t650__inner-col', this).each(function(){
			var t650_curCol = $(this),
                t650_curText = t650_curCol.find(".t650__text"),
                t650_curBtn = t650_curCol.find(".t650__btn-container"),
                t650_curColHeight = t650_curText.outerHeight() + t650_curBtn.outerHeight();			
			if(t650_curColHeight > t650_highestBox){t650_highestBox = t650_curColHeight;}
		});
		$('.t650__inner-col',this).css('height', t650_highestBox);
	});
} else {
	$('.t650__inner-col').css('height', 'auto');
}
}
 
function t686_init(recid) {
    var el = $("#rec" + recid);

    t686_setHeight(recid);

    $(window).on('resize', t_throttle(function () {
        t686_setHeight(recid);
    }));

    el.find('.t686').bind('displayChanged', function () {
        t686_setHeight(recid);
    });
}

function t686_setHeight(recid) {
    var el = $('#rec' + recid + ' .t686'),
        ratio = el.attr('data-tile-ratio'),
        ratioHeight = el.find('.t686__col').width() * ratio;

    var largestHeight = 0;
    el.find('.t686__row').each(function () {

        $('.t686__table', this).each(function () {
            var curCol = $(this),
                curColHeight = curCol.find(".t686__textwrapper").outerHeight();
            if ($(this).find(".t686__cell").hasClass("t686__button-bottom")) {
                curColHeight += curCol.find(".t686__button-container").outerHeight();
            }
            if (curColHeight > largestHeight) {
                largestHeight = curColHeight;
            }
        });

        if ($(window).width() >= 960) {
            if (largestHeight > ratioHeight) {
                $('.t686__table', this).css('height', largestHeight);
            } else {
                $('.t686__table', this).css('height', ratioHeight);
            }
            $('.t686__table', this).css('min-height', 'auto');
        } else {
            $('.t686__table', this).css('min-height', ratioHeight);
            $('.t686__table', this).css('height', '');
        }

        if (t686_GetIEVersion() > 0) {
            var curRowHeight = $('.t686__table', this).css('height');
            $('.t686__bg', this).css('height', curRowHeight);
            $('.t686__overlay', this).css('height', curRowHeight);
        }
    });
}

function t686_GetIEVersion() {
    var sAgent = window.navigator.userAgent;
    var Idx = sAgent.indexOf("MSIE");
    if (Idx > 0) {
        return parseInt(sAgent.substring(Idx + 5, sAgent.indexOf(".", Idx)));
    } else {
        if (!!navigator.userAgent.match(/Trident\/7\./)) {
            return 11;
        } else {
            return 0;
        }
    }
} 
function t688_unifyHeights(recid) {	
	if($(window).width()>=960){
		$('#rec'+recid+' .t688 .t-container .t688__row').each(function() {
			var t688_highestBox = 0,
				t688_currow = $(this);
			$(':not(.t688__featured) .t688__inner-col', this).each(function(){
				var t688_curCol = $(this),
                t688_curText = t688_curCol.find(".t688__textwrapper_inner"),	                
                t688_curColHeight = t688_curText.outerHeight();				
				if(t688_curColHeight > t688_highestBox){t688_highestBox = t688_curColHeight;}				
			});			
			$('.t688__textwrapper',this).css('height', t688_highestBox);
			$('.t688__featured',this).css('height',$('.t688__col',this).height()+'px');			
		});
	} else {
		$('.t688__textwrapper').css('height', 'auto');
		$("#rec"+recid).find(".t688__featured").css({'height':($("#rec"+recid).find(".t688__col").height()+'px')});
	}
} 
function t694_init(recid) {
    var el = $('#rec' + recid);
    t694_setHeight(recid);

    $(window).resize(t_throttle(function () {
        t694_setHeight(recid);
    }));

    el.find('.t694').bind('displayChanged', t_throttle(function () {
        t694_setHeight(recid);
    }));

    setTimeout(function() {
        t694_setHeight(recid);
    }, 500);
}

function t694_setHeight(recid) {
    var el = $('#rec' + recid + ' .t694');
    var t694_ratio = el.attr('data-tile-ratio');
    var t694_ratioHeight = el.find('.t694__col').width() * t694_ratio;

    if ($(window).width() >= 768) {
        el.find('.t694__row').each(function () {
            var t694_largestHeight = 0;

            $(this).find('.t694__table').each(function () {
                var t694_curCol = $(this),
                    t694_curColHeight = t694_curCol.find(".t694__textwrapper").outerHeight();
                if ($(this).find(".t694__cell").hasClass("t694__button-bottom")) {
                    t694_curColHeight += t694_curCol.find(".t694__button-container").outerHeight();
                }
                if (t694_curColHeight > t694_largestHeight) {
                    t694_largestHeight = t694_curColHeight;
                }
            });

            if (t694_largestHeight > t694_ratioHeight) {
                $(this).find('.t694__table').css('height', t694_largestHeight);
            } else {
                if ($(this).find('.t694__table').css('height') != '') {
                    $(this).find('.t694__table').css('height', '');
                }
            }
        });
    } else {
        el.find('.t694__table').css('height', '');
    }
}
 
function t698_fixcontentheight(id){
        /* correct cover height if content more when cover height */
        var el = $("#rec" + id);
        var hcover=el.find(".t-cover").height();
        var hcontent=el.find("div[data-hook-content]").outerHeight();
        if(hcontent>300 && hcover<hcontent){
         var hcontent=hcontent+120;
         if(hcontent>1000){hcontent+=100;}
         console.log('auto correct cover height: '+hcontent);
         el.find(".t-cover").height(hcontent);
         el.find(".t-cover__filter").height(hcontent);
         el.find(".t-cover__carrier").height(hcontent);
         el.find(".t-cover__wrapper").height(hcontent);
         el.find(".t-cover__container").height(hcontent);
         if($isMobile == false){
          setTimeout(function() {
           var divvideo=el.find(".t-cover__carrier");
           if(divvideo.find('iframe').length>0){
            console.log('correct video from cover_fixcontentheight');
      setWidthHeightYoutubeVideo(divvideo, hcontent+'px');
     }
    }, 2000);
   }
        }
 }

function t698_onSuccess(t698_form){
	var t698_inputsWrapper = t698_form.find('.t-form__inputsbox');
    var t698_inputsHeight = t698_inputsWrapper.height();
    var t698_inputsOffset = t698_inputsWrapper.offset().top;
    var t698_inputsBottom = t698_inputsHeight + t698_inputsOffset;
	var t698_targetOffset = t698_form.find('.t-form__successbox').offset().top;

    if ($(window).width()>960) {
        var t698_target = t698_targetOffset - 200;
    }	else {
        var t698_target = t698_targetOffset - 100;
    }

    if (t698_targetOffset > $(window).scrollTop() || ($(document).height() - t698_inputsBottom) < ($(window).height() - 100)) {
        t698_inputsWrapper.addClass('t698__inputsbox_hidden');
		setTimeout(function(){
			if ($(window).height() > $('.t-body').height()) {$('.t-tildalabel').animate({ opacity:0 }, 50);}
		}, 300);		
    } else {
        $('html, body').animate({ scrollTop: t698_target}, 400);
        setTimeout(function(){t698_inputsWrapper.addClass('t698__inputsbox_hidden');}, 400);
    }

	var successurl = t698_form.data('success-url');
    if(successurl && successurl.length > 0) {
        setTimeout(function(){
            window.location.href= successurl;
        },500);
    }

} 
function t744_init(recid) {
    t_onFuncLoad('t_sldsInit', function () {
        t_sldsInit(recid);
    });

    setTimeout(function () {
        t_onFuncLoad('t_prod__init', function () {
            t_prod__init(recid);
        });
        t744__hoverZoom_init(recid);
    }, 500);

    $('#rec' + recid).find('.t744').bind('displayChanged', function () {
        t744_updateSlider(recid);
    });
    $('body').trigger('twishlist_addbtn');
}

function t744__hoverZoom_init(recid) {
    if (window.isMobile) {
        return;
    }
    var rec = $('#rec' + recid);
    try {
        if (rec.find('[data-hover-zoom]')[0]) {
            if (!jQuery.cachedZoomScript) {
                jQuery.cachedZoomScript = function (url) {
                    var options = {
                        dataType: 'script',
                        cache: true,
                        url: url
                    };
                    return jQuery.ajax(options);
                };
            }
            $.cachedZoomScript(
                'https://static.tildacdn.com/js/tilda-hover-zoom-1.0.min.js'
            ).done(function (script, textStatus) {
                if (textStatus == 'success') {
                    setTimeout(function () {
                        t_hoverZoom_init(recid, '.t-slds__container');
                    }, 500);
                } else {
                    console.log('Upload script error: ' + textStatus);
                }
            });
        }
    } catch (e) {
        console.log('Zoom image init error: ' + e.message);
    }
}

function t744_updateSlider(recid) {
    var el = $('#rec' + recid);
    t_onFuncLoad('t_slds_SliderWidth', function () {
        t_slds_SliderWidth(recid);
    });
    var sliderWrapper = el.find('.t-slds__items-wrapper');
    var sliderWidth = el.find('.t-slds__container').width();
    var pos = parseFloat(sliderWrapper.attr('data-slider-pos'));
    sliderWrapper.css({
        transform: 'translate3d(-' + (sliderWidth * pos) + 'px, 0, 0)'
    });
    t_onFuncLoad('t_slds_UpdateSliderHeight', function () {
        t_slds_UpdateSliderHeight(recid);
    });

    t_onFuncLoad('t_slds_UpdateSliderArrowsHeight', function () {
        t_slds_UpdateSliderArrowsHeight(recid);
    });
} 
function t754__init(recid) {
    setTimeout(function() {
        t_onFuncLoad('t_prod__init', function () {
            t_prod__init(recid);
        });
        t754__hoverZoom_init(recid);
        t754_initPopup(recid);
        t754__updateLazyLoad(recid);
        t754__alignButtons_init(recid);
        if (typeof t_store_addProductQuantityEvents !== 'undefined') {
            t754_initProductQuantity(recid);
        }
        $('body').trigger('twishlist_addbtn');
    }, 500);
}

function t754_initProductQuantity(recid) {
    var el = $('#rec' + recid);
    var productList = el.find(".t754__col, .t754__product-full");
    productList.each(function(i, product) {
        t_store_addProductQuantityEvents($(product));
    });
}

function t754__showMore(recid) {
    var el = $('#rec' + recid).find(".t754");
    var showmore = el.find('.t754__showmore');
    var cards_count = parseInt(el.attr('data-show-count'), 10);
    
    if (cards_count > 0) {
        if (showmore.text() === '') {
            showmore.find('td').text(t754__dict('loadmore'));
        }
        
        showmore.show();
        el.find('.t754__col').hide();
    
        var cards_size = el.find('.t754__col').size();
        var cards_count = parseInt(el.attr('data-show-count'), 10);
        var x = cards_count;
        var y = cards_count;
        
        t754__showSeparator(el, x);
    
        el.find('.t754__col:lt(' + x + ')').show();
    
        showmore.click(function () {
            x = (x + y <= cards_size) ? x + y : cards_size;
            el.find('.t754__col:lt(' + x + ')').show();
            if (x == cards_size) {
                showmore.hide();
            }
            if (typeof $('.t-records').attr('data-tilda-mode') == 'undefined') {
                if (window.lazy === 'y' || $('#allrecords').attr('data-tilda-lazy') === 'yes') {
                    t_onFuncLoad('t_lazyload_update', function () {
                        t_lazyload_update();
                    });
                }
            }
            t754__showSeparator(el, x);
            if ($('#rec' + recid).find('[data-buttons-v-align]')[0]) {
                t754__alignButtons(recid);
            }
        });
    }
}

function t754__showSeparator(el, x) {
    el.find('.t754__separator_number').addClass('t754__separator_hide');
    el.find('.t754__separator_hide').each(function() {
        if ($(this).attr('data-product-separator-number') <= x) {
            $(this).removeClass('t754__separator_hide');
        }
    });
}

function t754__dict(msg) {
    var dict = [];

    dict['loadmore'] = {
        EN: 'Load more',
        RU: 'Загрузить еще',
        FR: 'Charger plus',
        DE: 'Mehr laden',
        ES: 'Carga más',
        PT: 'Carregue mais',
        UK: 'Завантажити ще',
        JA: 'もっと読み込む',
        ZH: '裝載更多',
    };

    var lang = window.browserLang;

    if (typeof dict[msg] !== 'undefined') {
        if (typeof dict[msg][lang] !== 'undefined' && dict[msg][lang] != '') {
            return dict[msg][lang];
        } else {
            return dict[msg]['EN'];
        }
    }

    return 'Text not found "' + msg + '"';
}

function t754__alignButtons_init(recid) {
    var el = $('#rec' + recid);
    if (el.find('[data-buttons-v-align]')[0]) {
        try {
            t754__alignButtons(recid);
            $(window).bind(
                'resize',
                t_throttle(function() {
                    if (
                        typeof window.noAdaptive !== 'undefined' &&
                        window.noAdaptive === true &&
                        $isMobile
                    ) {
                        return;
                    }
                    t754__alignButtons(recid);
                }, 200)
            );

            el.find('.t754').bind('displayChanged', function() {
                t754__alignButtons(recid);
            });

            if ($isMobile) {
                $(window).on('orientationchange', function() {
                    t754__alignButtons(recid);
                });
            }
        } catch (e) {
            console.log('buttons-v-align error: ' + e.message);
        }
    }
}

function t754__alignButtons(recid) {
    var rec = $('#rec' + recid);
    var wrappers = rec.find('.t754__textwrapper');
    var maxHeight = 0;
    var itemsInRow = rec.find('.t-container').attr('data-blocks-per-row') * 1;

    var mobileView = $(window).width() <= 480;
    var tableView = $(window).width() <= 960 && $(window).width() > 480;
    var mobileOneRow =
        $(window).width() <= 960 && rec.find('.t754__container_mobile-flex')[0]
            ? true
            : false;
    var mobileTwoItemsInRow =
        $(window).width() <= 480 && rec.find('.t754 .mobile-two-columns')[0]
            ? true
            : false;

    if (mobileView) {
        itemsInRow = 1;
    }

    if (tableView) {
        itemsInRow = 2;
    }

    if (mobileTwoItemsInRow) {
        itemsInRow = 2;
    }

    if (mobileOneRow) {
        itemsInRow = 999999;
    }

    var i = 1;
    var wrappersInRow = [];

    $.each(wrappers, function(key, element) {
        element.style.height = 'auto';
        if (itemsInRow === 1) {
            element.style.height = 'auto';
        } else {
            
            wrappersInRow.push(element);
            if (element.offsetHeight > maxHeight) {
                maxHeight = element.offsetHeight;
            }

            $.each(wrappersInRow, function(key, wrapper) {
                wrapper.style.height = maxHeight + 'px';
            });

            if (i === itemsInRow) {
                i = 0;
                maxHeight = 0;
                wrappersInRow = [];
            }

            i++;
        }
    });
}


function t754__hoverZoom_init(recid) {
    if(isMobile) {
        return;
    }
    var rec = $('#rec'+recid);
    try {
        if (rec.find('[data-hover-zoom]')[0]) {
            if (!jQuery.cachedZoomScript) {
                jQuery.cachedZoomScript = function(url) {
                    var options = {
                        dataType: 'script',
                        cache: true,
                        url: url
                    };
                    return jQuery.ajax(options);
                };
            }
            $.cachedZoomScript(
                'https://static.tildacdn.com/js/tilda-hover-zoom-1.0.min.js'
            ).done(function(script, textStatus) {
                if (textStatus == 'success') {
                    setTimeout(function() {
                        t_hoverZoom_init(recid, ".t-slds__container");
                    }, 500);
                } else {
                    console.log('Upload script error: ' + textStatus);
                }
            });
        }
    } catch (e) {
        console.log('Zoom image init error: ' + e.message);
    } 
}

function t754__updateLazyLoad(recid) {
  var scrollContainer = $("#rec"+recid+" .t754__container_mobile-flex");
  var curMode = $(".t-records").attr("data-tilda-mode");
  if (scrollContainer.length && curMode!="edit" && curMode!="preview") {
    scrollContainer.bind('scroll', t_throttle(function() {
        if (window.lazy === 'y' || $('#allrecords').attr('data-tilda-lazy') === 'yes') {
            t_onFuncLoad('t_lazyload_update', function () {
                t_lazyload_update();
            });
        }
    }));
  }
}

function t754_initPopup(recid){
  var rec=$('#rec'+recid); 
  rec.find('[href^="#prodpopup"]').one( "click", function(e) {
      e.preventDefault();	  
	  var el_popup=rec.find('.t-popup');
	  var el_prod=$(this).closest('.js-product');
      var lid_prod=el_prod.attr('data-product-lid');
      t_onFuncLoad('t_sldsInit', function () {
        t_sldsInit(recid+' #t754__product-' + lid_prod + '');
      });
  });
  rec.find('[href^="#prodpopup"]').click(function(e){	
      e.preventDefault();
      if ($(e.target).hasClass('t1002__addBtn') || $(e.target).parents().hasClass('t1002__addBtn')) {
		return
	  }
      t754_showPopup(recid);	  
	  var el_popup=rec.find('.t-popup');
	  var el_prod=$(this).closest('.js-product');
	  var lid_prod=el_prod.attr('data-product-lid');
	  el_popup.find('.js-product').css('display','none');
	  var el_fullprod=el_popup.find('.js-product[data-product-lid="'+lid_prod+'"]');
	  el_fullprod.css('display','block');
    
    var analitics=el_popup.attr('data-track-popup');
    if (analitics > '') {
        var virtTitle = el_fullprod.find('.js-product-name').text();
        if (! virtTitle) {
            virtTitle = 'prod'+lid_prod;
        }
        Tilda.sendEventToStatistics(analitics, virtTitle);
    }

	  var curUrl = window.location.href;
      if (curUrl.indexOf('#!/tproduct/')<0 && curUrl.indexOf('%23!/tproduct/')<0 && curUrl.indexOf('#%21%2Ftproduct%2F') < 0) {
        if (typeof history.replaceState!='undefined'){
          window.history.replaceState('','',window.location.href+'#!/tproduct/'+recid+'-'+lid_prod);
        }
      }	
      t754_updateSlider(recid+' #t754__product-' + lid_prod + '');
        if (window.lazy === 'y' || $('#allrecords').attr('data-tilda-lazy') === 'yes') {
            t_onFuncLoad('t_lazyload_update', function () {
                t_lazyload_update();
            });
        }
  });
  if ($('#record'+recid).length==0){ t754_checkUrl(recid); }
  t754_copyTypography(recid);
}

function t754_checkUrl(recid){
  var curUrl = window.location.href;
  var tprodIndex = curUrl.indexOf('#!/tproduct/');
  if(/iPhone|iPad|iPod/i.test(navigator.userAgent) && tprodIndex<0){ 
      tprodIndex = curUrl.indexOf('%23!/tproduct/'); 
      if(tprodIndex<0){tprodIndex = curUrl.indexOf('#%21%2Ftproduct%2F')};
  }
  if (tprodIndex>=0){
    var curUrl = curUrl.substring(tprodIndex,curUrl.length);
    var curProdLid = curUrl.substring(curUrl.indexOf('-')+1,curUrl.length);
    var rec=$('#rec'+recid);
    if (curUrl.indexOf(recid)>=0 && rec.find('[data-product-lid='+curProdLid+']').length) {
  	  rec.find('[data-product-lid='+curProdLid+'] [href^="#prodpopup"]').triggerHandler('click');
    }
  }
}

function t754_updateSlider(recid) {
    var el=$('#rec'+recid);
    t_onFuncLoad('t_slds_SliderWidth', function () {
        t_slds_SliderWidth(recid);
    });
    var sliderWrapper = el.find('.t-slds__items-wrapper');
    var sliderWidth = el.find('.t-slds__container').width();
    var pos = parseFloat(sliderWrapper.attr('data-slider-pos'));
    sliderWrapper.css({
        transform: 'translate3d(-' + (sliderWidth * pos) + 'px, 0, 0)'
    });
    t_onFuncLoad('t_slds_UpdateSliderHeight', function () {
        t_slds_UpdateSliderHeight(recid);
    });
    t_onFuncLoad('t_slds_UpdateSliderArrowsHeight', function () {
        t_slds_UpdateSliderArrowsHeight(recid);
    });
}

function t754_showPopup(recid){
  var el=$('#rec'+recid);
  var popup = el.find('.t-popup');

  popup.css('display', 'block');
  setTimeout(function() {
    popup.find('.t-popup__container').addClass('t-popup__container-animated');
    popup.addClass('t-popup_show');
    if (window.lazy === 'y' || $('#allrecords').attr('data-tilda-lazy') === 'yes') {
        t_onFuncLoad('t_lazyload_update', function () {
            t_lazyload_update();
        });
    }
  }, 50);

  $('body').addClass('t-body_popupshowed');
  $('body').trigger('twishlist_addbtn');

  el.find('.t-popup').mousedown(function(e){
    var windowWidth = $(window).width();
    var maxScrollBarWidth = 17;
    var windowWithoutScrollBar = windowWidth - maxScrollBarWidth;
    if(e.clientX > windowWithoutScrollBar) {
        return;
    }
    if (e.target == this) {
      t754_closePopup();
    }
  });

  el.find('.t-popup__close, .t754__close-text').click(function(e){
    t754_closePopup();
  });

  $(document).keydown(function(e) {
    if (e.keyCode == 27) {
      t754_closePopup();
    }
  });
}

function t754_closePopup(){
  $('body').removeClass('t-body_popupshowed');
  $('.t-popup').removeClass('t-popup_show');
  $('body').trigger('twishlist_addbtn');
  var curUrl=window.location.href;
  var indexToRemove=curUrl.indexOf('#!/tproduct/');
  if(/iPhone|iPad|iPod/i.test(navigator.userAgent) && indexToRemove<0){ 
  indexToRemove=curUrl.indexOf('%23!/tproduct/'); 
  if(indexToRemove<0){indexToRemove = curUrl.indexOf('#%21%2Ftproduct%2F')};
  }
  curUrl=curUrl.substring(0,indexToRemove);
  setTimeout(function() {
    $(".t-popup").scrollTop(0);  
    $('.t-popup').not('.t-popup_show').css('display', 'none');
	if (typeof history.replaceState!='undefined'){
      window.history.replaceState('','',curUrl);
    }                                                                        	
  }, 300);
}

function t754_removeSizeStyles(styleStr){
	if(typeof styleStr!="undefined" && (styleStr.indexOf('font-size')>=0 || styleStr.indexOf('padding-top')>=0 || styleStr.indexOf('padding-bottom')>=0)){
		var styleStrSplitted = styleStr.split(';');
		styleStr = "";
		for (var i=0;i<styleStrSplitted.length;i++){
			if(styleStrSplitted[i].indexOf('font-size')>=0 || styleStrSplitted[i].indexOf('padding-top')>=0 || styleStrSplitted[i].indexOf('padding-bottom')>=0){
				styleStrSplitted.splice(i,1); i--; continue;
			}			
			if(styleStrSplitted[i]==""){continue;}
			styleStr+=styleStrSplitted[i]+";";
		}
	}
	return styleStr;
}

function t754_copyTypography(recid){
  var rec=$('#rec'+recid);
  var titleStyle=rec.find('.t754__title').attr('style');
	var descrStyle=rec.find('.t754__descr').attr('style');
	rec.find('.t-popup .t754__title').attr("style",t754_removeSizeStyles(titleStyle));
	rec.find('.t-popup .t754__descr, .t-popup .t754__text').attr("style",t754_removeSizeStyles(descrStyle));
} 
function t814_init(recid) {
    var el = $('#rec' + recid);

    t814_setHeight(recid);

    $(window).bind('resize', t_throttle(function () {
        if (typeof window.noAdaptive !== "undefined" && window.noAdaptive === true && window.isMobile) { return; }
        t814_setHeight(recid);
    }));

    el.find('.t814').on('displayChanged', function () {
        t814_setHeight(recid);
    });
}

function t814_setHeight(recid) {
    var el = $('#rec' + recid);

    var imgWrapperHeight = el.find(".t814__blockimg").height();
    var blockTextWrapper = el.find(".t814__blocktext-wrapper");
    var textWrapper = el.find(".t814__blocktext");

    if ($(window).width() > 960) {
        textWrapper.css('height', imgWrapperHeight);
        blockTextWrapper.css('height', textWrapper.outerHeight(true));
    } else {
        blockTextWrapper.css('height', 'auto');
    }
} 
function t816_init(recid, padding) {
  var rec = $('#rec'+recid);
  var el = rec.find('.t816');

  t816_setHeight(rec, padding);

  $(window).bind('resize', t_throttle(function() {
    if (typeof window.noAdaptive!="undefined" && window.noAdaptive==true && $isMobile){return;}
    t816_setHeight(rec, padding);
  }, 200));

  $('.t816').bind('displayChanged',function(){
    t816_setHeight(rec, padding);
  });

}

function t816_setHeight(rec, padding) {

  var galleryContainer = rec.find('.t816__container');
  var galleryRow = rec.find('.t816__row:first-child');
  var colOffset = rec.find('.t816__tile_offset');
  if (colOffset.length == 0) {return;}
  var containerOffset = colOffset.position().top - padding;

   if ($(window).width() >= 960) {
     galleryContainer.css('padding-bottom', containerOffset);
   }

}
 
function t827_init(recid) {
    var rec = $('#rec' + recid);
    var grid = rec.find('.t827__grid');
    var sizer = rec.find('.t827__grid-sizer');
    var item = rec.find('.t827__grid-item');
    var images = rec.find('.t827__grid img');
    var overlay = rec.find('.t827__overlay');
    var startContainerWidth = rec.find('.t827__grid-sizer').width();

    t827_reverse(grid, item);

    images.load(function () {
        t827_initMasonry(rec, recid, grid);
        setTimeout(function () {
            t827_showOverlay(overlay, item);
        }, 500);
    });

    if (overlay.hasClass('t827__overlay_preview')) {
        setTimeout(function () {
            t827_showOverlay(overlay, item);
        }, 1000);
    }

    t827_initMasonry(rec, recid, grid);

    $(window).bind('resize', t_throttle(function() {
        if (typeof window.noAdaptive !== 'undefined' && window.noAdaptive === true && window.isMobile) { return; }
        t827_calcColumnWidth(rec, startContainerWidth, grid, sizer, item);
    }));

    rec.find('.t827').bind('displayChanged', function () {
        t827_initMasonry(rec, recid, grid);
        t827_calcColumnWidth(rec, startContainerWidth, grid, sizer, item);
    });

    setTimeout(function() {
        t827_calcColumnWidth(rec, startContainerWidth, grid, sizer, item);
    });
}


function t827_reverse(grid, item) {
    if (grid.hasClass('t827__grid_reverse')) {
        grid.append(function () {
            return $(this).children().get().reverse();
        });
    }
}

function t827_initMasonry(rec, recid, grid) {
    var $grid = grid;
    var gutterSizerWidth = rec.find('.t827__gutter-sizer').width();
    var gutterElement = rec.find('.t827__gutter-sizer').width() == 40 ? 39 : '#rec' + recid + ' .t827__gutter-sizer';
    t_onFuncLoad('imagesLoaded', function () {
        $grid.imagesLoaded(function () {
            $grid.masonry({
                itemSelector: '#rec' + recid + ' .t827__grid-item',
                columnWidth: '#rec' + recid + ' .t827__grid-sizer',
                gutter: gutterElement,
                isFitWidth: true,
                transitionDuration: 0
            });
        });
    });
}

function t827_showOverlay(overlay, item) {
    if ($(window).width() >= 1024) {
        overlay.css('display', 'block');
    } else {
        item.click(function () {
            if ($(this).find('.t827__overlay').css('opacity') == '0') {
                overlay.css('opacity', '0');
                $(this).find('.t827__overlay').css('opacity', '1');
            } else {
                $(this).find('.t827__overlay').css('opacity', '0');
            }
        });
    }
}

function t827_calcColumnWidth(rec, startcontainerwidth, grid, sizer, item) {
    var containerWidth = rec.find('.t827__container').width();
    var sizerWidth = rec.find('.t827__grid-sizer').width();
    var itemWidth = rec.find('.t827__grid-item').width();
    var gutterSizerWidth = rec.find('.t827__gutter-sizer').width() == 40 ? 39 : rec.find('.t827__gutter-sizer').width();
    var columnAmount = Math.round(containerWidth / startcontainerwidth);
    var newSizerWidth = ((containerWidth - gutterSizerWidth * (columnAmount - 1)) / columnAmount);

    if (containerWidth >= itemWidth) {
        sizer.css('width', newSizerWidth);
        item.css('width', newSizerWidth);
    } else {
        grid.css('width', '100%');
        sizer.css('width', '100%');
        item.css('width', '100%');
    }
}
 
function t835_init(recid) {
    var rec = $('#rec' + recid);
    var quizWrapper = rec.find('.t835__quiz-wrapper');
    var quizFormWrapper = rec.find('.t835__quiz-form-wrapper');
    var form = rec.find('.t835 .t-form');
    var quizQuestion = rec.find('.t835 .t-input-group');
    var prevBtn = rec.find('.t835__btn_prev');
    var nextBtn = rec.find('.t835__btn_next');
    var resultBtn = rec.find('.t835__btn_result');
    var errorBoxMiddle = rec.find('.t-form__errorbox-middle .t-form__errorbox-wrapper');
    var captureFormHTML = '<div class="t835__capture-form"></div>';
    rec.find('.t835 .t-form__errorbox-middle').before(captureFormHTML);
    var quizQuestionNumber = 0;
    form.removeClass('js-form-proccess');
    var specCommentInput = form.find('input.js-form-spec-comments[name="form-spec-comments"]');
    if (form.data('formactiontype') != 1 && !specCommentInput.length) {
		form.append('<div style="position: absolute; left: -5000px; bottom:0;"><input type="text" name="form-spec-comments" value="Its good" class="js-form-spec-comments"  tabindex="-1" /></div>');
	}
    $(quizQuestion[quizQuestionNumber]).show();
    $(quizQuestion[quizQuestionNumber]).addClass('t-input-group-step_active');

    t835_workWithAnswerCode(rec);

    quizQuestion.each(function (i) {
        $(quizQuestion[i]).attr('data-question-number', i);
    });

    t835_wrapCaptureForm(rec);

    t835_showCounter(rec, quizQuestionNumber);
    t835_disabledPrevBtn(rec, quizQuestionNumber);
    t835_checkLength(rec);

    prevBtn.click(function (e) {
        if (quizQuestionNumber > 0) {
            quizQuestionNumber--;
        }

        t835_setProgress(rec, -1);

        if (typeof $('.t-records').attr('data-tilda-mode') == 'undefined') {
            if (window.lazy === 'y' || $('#allrecords').attr('data-tilda-lazy') === 'yes') {
                t_onFuncLoad('t_lazyload_update', function () {
                    t_lazyload_update();
                });
            }
        }

        t835_awayFromResultScreen(rec);
        t835_showCounter(rec, quizQuestionNumber);
        t835_hideError(rec, quizQuestionNumber);
        t835_disabledPrevBtn(rec, quizQuestionNumber);
        t835_switchQuestion(rec, quizQuestionNumber);
        t835_scrollToTop(quizWrapper);

        e.preventDefault();
    });

    nextBtn.click(function (e) {
        if (quizWrapper.hasClass('t835__quiz-published')) {
            var showErrors = t835_setError(rec, quizQuestionNumber);
        }

        if (showErrors) {
            errorBoxMiddle.hide();
        }

        if (!showErrors) {
            quizQuestionNumber++;
            prevBtn.attr('disabled', false);
            t835_setProgress(rec, 1);
            t835_showCounter(rec, quizQuestionNumber);
            t835_switchQuestion(rec, quizQuestionNumber);
            t835_scrollToTop(quizWrapper);
        }

        if (typeof $('.t-records').attr('data-tilda-mode') == 'undefined') {
            if (window.lazy === 'y' || $('#allrecords').attr('data-tilda-lazy') === 'yes') {
                t_onFuncLoad('t_lazyload_update', function () {
                    t_lazyload_update();
                });
            }
        }

        e.preventDefault();
    });

    quizQuestion.keypress(function (e) {
        var activeStep = form.find('.t-input-group-step_active');
        if (event.keyCode === 13 && !form.hasClass('js-form-proccess') && !activeStep.hasClass('t-input-group_ta')) {
            if (quizWrapper.hasClass('t835__quiz-published')) {
                var showErrors = t835_setError(rec, quizQuestionNumber);
            }
            var questionArr = t835_createQuestionArr(rec);

            if (showErrors) {
                errorBoxMiddle.hide();
            }

            prevBtn.attr('disabled', false);
            if (!showErrors) {
                quizQuestionNumber++;
                t835_setProgress(rec, 1);

                if (quizQuestionNumber < questionArr.length) {
                    t835_switchQuestion(rec, quizQuestionNumber);
                } else {
                    t835_switchResultScreen(rec);
                    form.addClass('js-form-proccess');
                }

                t835_scrollToTop(quizWrapper);
                t835_disabledPrevBtn(rec, quizQuestionNumber);
            }

            if (typeof $('.t-records').attr('data-tilda-mode') == 'undefined') {
                if (window.lazy === 'y' || $('#allrecords').attr('data-tilda-lazy') === 'yes') {
                    t_onFuncLoad('t_lazyload_update', function () {
                        t_lazyload_update();
                    });
                }
            }

            e.preventDefault();
        }
    });

    resultBtn.click(function (e) {

        if (quizWrapper.hasClass('t835__quiz-published')) {
            var showErrors = t835_setError(rec, quizQuestionNumber);
        }

        if (showErrors) {
            errorBoxMiddle.hide();
        }

        if (!showErrors) {
            quizQuestionNumber++;
            t835_setProgress(rec, 1);
            t835_switchResultScreen(rec);
            t835_scrollToTop(quizWrapper);
            form.addClass('js-form-proccess');
            t835_disabledPrevBtn(rec, quizQuestionNumber);
        }

        e.preventDefault();
    });
}


function t835_workWithAnswerCode(rec) {
    rec.find('.t-input-group_ri').find('input').each(function () {
        var $this = $(this);
        if ($this.val().indexOf('value::') != -1) {
            t835_setAnswerCode($this);
            var label = $this.parent().find('.t-img-select__text');
            label.text(label.text().split('value::')[0].trim());
        }
    });

    rec.find('.t-input-group_rd').find('input').each(function () {
        var $this = $(this);
        if ($this.val().indexOf('value::') != -1) {
            t835_setAnswerCode($this);
            var label = $this.parent();

            label.html(function () {
                var html = $(this).html().split('value::')[0].trim();
                return html;
            });
        }
    });


    rec.find('.t-input-group_sb').find('option').each(function () {
        var $this = $(this);
        if ($this.val().indexOf('value::') != -1) {
            t835_setAnswerCode($this);
            $this.text($this.text().split('value::')[0].trim());
        }
    });
}


function t835_setAnswerCode($this) {
    var parameter = $this.val().split('value::')[1].trim();
    $this.val(parameter);
}


function t835_scrollToTop(quizFormWrapper) {
    var topCoordinateForm = quizFormWrapper.offset().top;
    var paddingTop = 0;
    var blockContainer = quizFormWrapper.parents('.t835');
    
    if (topCoordinateForm >= window.scrollY || blockContainer.hasClass('t835_scroll-disabled')) return;
    
    if ($('.t228__positionfixed').length > 0 && !window.isMobile) {
        paddingTop = paddingTop + $('.t228__positionfixed').height();
    }
    $('html, body').animate({
        scrollTop: topCoordinateForm - paddingTop
    }, 0);
}


function t835_checkLength(rec) {
    var nextBtn = rec.find('.t835__btn_next');
    var resultBtn = rec.find('.t835__btn_result');
    var questionArr = t835_createQuestionArr(rec);

    if (questionArr.length < 2) {
        nextBtn.hide();
        resultBtn.show();
    }
}


function t835_showCounter(rec, quizQuestionNumber) {
    var counter = rec.find('.t835__quiz-description-counter');
    var questionArr = t835_createQuestionArr(rec);
    counter.html(quizQuestionNumber + 1 + '/' + questionArr.length);
}


function t835_setError(rec, quizQuestionNumber) {
    var questionArr = t835_createQuestionArr(rec);
    var currentQuestion = $(questionArr[quizQuestionNumber]);
    var arErrors = window.tildaForm.validate(currentQuestion);
    var showErrors;
    currentQuestion.addClass('js-error-control-box');
    var errorsTypeObj = arErrors[0];

    if (errorsTypeObj != undefined) {
        var errorType = errorsTypeObj.type[0];
        var errorTextCustom = rec.find('.t835 .t-form').find('.t-form__errorbox-middle').find('.js-rule-error-' + errorType).text();
        var sError = '';
        if (errorTextCustom != '') {
            sError = errorTextCustom;
        } else {
            t_onFuncLoad('t_form_dict', function () {
                sError = t_form_dict(errorType);
            });
        }
        showErrors = errorType == 'emptyfill' ? false : window.tildaForm.showErrors(currentQuestion, arErrors);
        currentQuestion.find('.t-input-error').html(sError);
    }

    return showErrors;
}


function t835_hideError(rec, quizQuestionNumber) {
    var questionArr = t835_createQuestionArr(rec);
    var currentQuestion = $(questionArr[quizQuestionNumber]);
    currentQuestion.removeClass('js-error-control-box');
    currentQuestion.find('.t-input-error').html('');
}


function t835_setProgress(rec, index) {
    var progressbarWidth = rec.find('.t835__progressbar').width();
    var progress = rec.find('.t835__progress');
    var questionArr = t835_createQuestionArr(rec);
    var progressWidth = progress.width();
    var progressStep = progressbarWidth / (questionArr.length);
    var percentProgressWidth = (progressWidth + index * progressStep) / progressbarWidth * 100 + '%';

    progress.css('width', percentProgressWidth);
}


function t835_wrapCaptureForm(rec) {
    var captureForm = rec.find('.t835__capture-form');
    var quizQuestion = rec.find('.t835 .t-input-group');
    var quizFormWrapper = rec.find('.t835__quiz-form-wrapper');

    quizQuestion.each(function (i) {
        var currentQuizQuestion = $(quizQuestion[i]);
        var emailInputExist = $(currentQuizQuestion).hasClass('t-input-group_em');
        var nameInputExist = $(currentQuizQuestion).hasClass('t-input-group_nm');
        var phoneInputExist = $(currentQuizQuestion).hasClass('t-input-group_ph');
        var checkboxInputExist = $(currentQuizQuestion).hasClass('t-input-group_cb');
        var quizQuestionNumber = currentQuizQuestion.attr('data-question-number');
        var maxCountOfCaptureFields = quizFormWrapper.hasClass('t835__quiz-form-wrapper_withcheckbox') ? 4 : 3;

        if (quizQuestionNumber >= quizQuestion.length - maxCountOfCaptureFields) {
            var isCaptureGroup = true;
            
            if (quizFormWrapper.hasClass('t835__quiz-form-wrapper_newcapturecondition')) {
                var inputsGroup = currentQuizQuestion.nextAll('.t-input-group');
                inputsGroup.each(function() {
                    isCaptureGroup = $(this).hasClass('t-input-group_cb') || $(this).hasClass('t-input-group_em') || $(this).hasClass('t-input-group_nm') || $(this).hasClass('t-input-group_ph');
                });
            }
            
            if (isCaptureGroup) {
                if (quizFormWrapper.hasClass('t835__quiz-form-wrapper_withcheckbox')) {
                    if (emailInputExist || nameInputExist || phoneInputExist || checkboxInputExist) {
                        currentQuizQuestion.addClass('t835__t-input-group_capture');
                        captureForm.append(currentQuizQuestion);
                    }
                } else {
                    if (emailInputExist || nameInputExist || phoneInputExist) {
                        currentQuizQuestion.addClass('t835__t-input-group_capture');
                        captureForm.append(currentQuizQuestion);
                    }
                }
            }
        }
    });
}


function t835_createQuestionArr(rec) {
    var quizQuestion = rec.find('.t835 .t-input-group');
    var questionArr = [];

    quizQuestion.each(function (i) {
        var question = $(quizQuestion[i]);
        if (!question.hasClass('t835__t-input-group_capture')) {
            questionArr.push(quizQuestion[i]);
        }
    });

    return questionArr;
}


function t835_disabledPrevBtn(rec, quizQuestionNumber) {
    var prevBtn = rec.find('.t835__btn_prev');
    quizQuestionNumber == 0 ? prevBtn.attr('disabled', true) : prevBtn.attr('disabled', false);
}


function t835_switchQuestion(rec, quizQuestionNumber) {
    var nextBtn = rec.find('.t835__btn_next');
    var resultBtn = rec.find('.t835__btn_result');
    var questionArr = t835_createQuestionArr(rec);

    $(questionArr).hide();
    $(questionArr).removeClass('t-input-group-step_active');
    $(questionArr[quizQuestionNumber]).show();
    $(questionArr[quizQuestionNumber]).addClass('t-input-group-step_active');

    if (quizQuestionNumber === questionArr.length - 1) {
        nextBtn.hide();
        resultBtn.show();
    } else {
        nextBtn.show();
        resultBtn.hide();
    }
}


function t835_switchResultScreen(rec) {
    var captureForm = rec.find('.t835__capture-form');
    var quizDescription = rec.find('.t835__quiz-description');
    var resultTitle = rec.find('.t835__result-title');
    var resultBtn = rec.find('.t835__btn_result');
    var submitBtnWrapper = rec.find('.t835 .t-form__submit');
    var questionArr = t835_createQuestionArr(rec);

    $(questionArr).hide();
    $(captureForm).show();

    resultBtn.hide();
    quizDescription.hide();
    resultTitle.show();

    submitBtnWrapper.show();
}


function t835_awayFromResultScreen(rec) {
    var captureForm = rec.find('.t835__capture-form');
    var quizDescription = rec.find('.t835__quiz-description');
    var resultTitle = rec.find('.t835__result-title');
    var submitBtnWrapper = rec.find('.t835 .t-form__submit');

    submitBtnWrapper.hide();
    $(captureForm).hide();
    quizDescription.show();
    resultTitle.hide();
}


function t835_onSuccess(form) {
    var inputsWrapper = form.find('.t-form__inputsbox');
    var inputsHeight = inputsWrapper.height();
    var inputsOffset = inputsWrapper.offset().top;
    var inputsBottom = inputsHeight + inputsOffset;
    var targetOffset = form.find('.t-form__successbox').offset().top;
    var prevBtn = form.parents('.t835').find('.t835__btn_prev');
    var target;

    if ($(window).width() > 960) {
        target = targetOffset - 200;
    } else {
        target = targetOffset - 100;
    }

    if (targetOffset > $(window).scrollTop() || ($(document).height() - inputsBottom) < ($(window).height() - 100)) {
        inputsWrapper.addClass('t835__inputsbox_hidden');
        setTimeout(function () {
            if ($(window).height() > $('.t-body').height()) {
                $('.t-tildalabel').animate({
                    opacity: 0
                }, 50);
            }
        }, 300);
    } else {
        $('html, body').animate({
            scrollTop: target
        }, 400);
        setTimeout(function () {
            inputsWrapper.addClass('t835__inputsbox_hidden');
        }, 400);
    }

    var successurl = form.data('success-url');
    if (successurl && successurl.length > 0) {
        setTimeout(function () {
            window.location.href = successurl;
        }, 500);
    }

    prevBtn.hide();
}
 
function t843_init(recid) {
    var rec = $('#rec' + recid);
    var container = rec.find('.t843');

    t843_setHeight(rec);

    $(window).bind('resize', t_throttle(function () {
        if (typeof window.noAdaptive !== 'undefined' && window.noAdaptive === true && window.isMobile) { return; }
        t843_setHeight(rec);
        
    }));

    rec.find('.t843').bind('displayChanged', function () {
        t843_setHeight(rec);
    });

    if (container.hasClass('t843__previewmode')) {
        setInterval(function () {
            t843_setHeight(rec);
        }, 5000);
    }
}

function t843_setHeight(rec) {
    var image = rec.find('.t843__blockimg');
    var isLoaded = true;
    
    image.each(function () {
        var width = $(this).attr('data-image-width');
        var height = $(this).attr('data-image-height');
        var ratio = height / width;
        var padding = ratio * 100;
        $(this).css('padding-bottom', padding + '%');
        
        if (!$(this).hasClass('loaded')) {
            isLoaded = false;
        }
    });

    if ($(window).width() > 960) {
        var textwr = rec.find('.t843__textwrapper');
        var deskimg = rec.find('.t843__desktopimg');
        textwr.each(function (i) {
            $(this).css('height', $(deskimg[i]).innerHeight());
        });
    }
    
    if (!isLoaded) {
        if (window.lazy === 'y' || $('#allrecords').attr('data-tilda-lazy') === 'yes') {
           t_onFuncLoad('t_lazyload_update', function () {
                t_lazyload_update();
           });
        }
    }
}
 
function t849_init(recid) {
    var el = $('#rec' + recid);
    var toggler = el.find('.t849__header');
    var accordion = el.find('.t849__accordion');
    if (accordion) {
        accordion = accordion.attr('data-accordion');
    } else {
        accordion = "false";
    }

    toggler.click(function () {
        if (accordion === "true") {
            toggler.not(this).removeClass("t849__opened").next().slideUp();
        }

        $(this).toggleClass('t849__opened');
        $(this).next().slideToggle();
        if (window.lazy === 'y' || $('#allrecords').attr('data-tilda-lazy') === 'yes') {
            t_onFuncLoad('t_lazyload_update', function () {
                t_lazyload_update();
            });
        }
    });
} 
function t859_init(recid) {
  var rec = $('#rec' + recid);
  var container = rec.find('.t859');
  var doResize;

  t859_unifyHeights(rec);

	$(window).on('resize', t_throttle(function() {
	    if (typeof window.noAdaptive!="undefined" && window.noAdaptive==true && $isMobile){return;}
        t859_unifyHeights(rec);
	}));

  $(window).on('load', function() {
    t859_unifyHeights(rec);
  });

  rec.find('.t859').on('displayChanged', function() {
    t859_unifyHeights(rec);
  });

  if (container.hasClass('t859__previewmode')) {
    setInterval(function() {
      t859_unifyHeights(rec);
    }, 5000);
  }
}


function t859_unifyHeights(rec) {
  if ($(window).width() >= 960) {
    rec.find('.t859 .t-container .t859__row').each(function() {
      var highestBox = 0;
      var currow = $(this);
      $('.t859__inner-col', this).each(function() {
        var curCol = $(this);
        var curWrap = curCol.find('.t859__wrap');
        var curColHeight = curWrap.outerHeight();
        if (curColHeight > highestBox) {highestBox = curColHeight;}
      });
      $('.t859__inner-col', this).css('height', highestBox);
    });
  } else {
    $('.t859__inner-col').css('height', 'auto');
  }
}
 
function t868_setHeight(recid) {
  var rec = $('#rec' + recid);
  var div = rec.find('.t868__video-carier');
  var height = div.width() * 0.5625;
  div.height(height);
  div.parent().height(height);
}


function t868_initPopup(recid) {
  var rec = $('#rec' + recid);
  $('#rec' + recid).attr('data-animationappear', 'off');
  $('#rec' + recid).css('opacity', '1');
  var el = $('#rec' + recid).find('.t-popup');
  var hook = el.attr('data-tooltip-hook');
  var analitics = el.attr('data-track-popup');
  var customCodeHTML = t868__readCustomCode(rec);

  if (hook !== '') {
    $('.r').on('click', 'a[href="' + hook + '"]', function(e) {
      t868_showPopup(recid, customCodeHTML);
      t868_resizePopup(recid);
      e.preventDefault();
      if (analitics > '') {
        var virtTitle = hook;
        if (virtTitle.substring(0,7) == '#popup:') {
          virtTitle = virtTitle.substring(7);
        }
        Tilda.sendEventToStatistics(analitics, virtTitle);
      }
    });
  }
}


function t868__readCustomCode(rec) {
  var customCode = rec.find('.t868 .t868__code-wrap').html();
  rec.find('.t868 .t868__code-wrap').remove();
  return customCode;
}


function t868_showPopup(recid, customCodeHTML) {
  var rec = $('#rec' + recid);
  var popup = rec.find('.t-popup');
  var popupContainer = rec.find('.t-popup__container');
  popupContainer.append(customCodeHTML);

  popup.css('display', 'block');
  t868_setHeight(recid);
  setTimeout(function() {
    popup.find('.t-popup__container').addClass('t-popup__container-animated');
    popup.addClass('t-popup_show');
  }, 50);

  $('body').addClass('t-body_popupshowed');
  
  rec.find('.t-popup').click(function(e) {
    var container = e.target.closest('.t-popup__container');
    if (!container) {
      t868_closePopup(recid);
    }
  });

  rec.find('.t-popup__close').click(function(e) {
    t868_closePopup(recid);
  });

  rec.find('a[href*="#"]').click(function(e) {
    var url = $(this).attr('href');
    if (url.indexOf('#order') != -1) {
        var popupContainer = rec.find('.t-popup__container');
        setTimeout(function() {
            popupContainer.empty();
        }, 600);
    }
    if (!url || url.substring(0,7) != '#price:') {
      t868_closePopup();
      if (!url || url.substring(0,7) == '#popup:') {
        setTimeout(function() {
          $('body').addClass('t-body_popupshowed');
        }, 300);
      }
    }
  });

  $(document).keydown(function(e) {
    if (e.keyCode == 27) { t868_closePopup(recid); }
  });
}


function t868_closePopup(recid) {
  var rec = $('#rec' + recid);
  var popup = rec.find('.t-popup');
  var popupContainer = rec.find('.t-popup__container');

  $('body').removeClass('t-body_popupshowed');
  $('#rec' + recid + ' .t-popup').removeClass('t-popup_show');

  popupContainer.empty();

  setTimeout(function() {
    $('.t-popup').not('.t-popup_show').css('display', 'none');
  }, 300);
}


function t868_resizePopup(recid) {
  var rec = $('#rec' + recid);
  var div = rec.find('.t-popup__container').height();
  var win = $(window).height();
  var popup = rec.find('.t-popup__container');
  if (div > win ) {
    popup.addClass('t-popup__container-static');
  } else {
    popup.removeClass('t-popup__container-static');
  }
}


/* deprecated */
function t868_sendPopupEventToStatistics(popupname) {
  var virtPage = '/tilda/popup/';
  var virtTitle = 'Popup: ';
  if (popupname.substring(0,7) == '#popup:') {
    popupname = popupname.substring(7);
  }

  virtPage += popupname;
  virtTitle += popupname;

  if(ga) {
    if (window.mainTracker != 'tilda') {
      ga('send', {'hitType':'pageview', 'page':virtPage, 'title':virtTitle});
    }
  }

  if (window.mainMetrika > '' && window[window.mainMetrika]) {
    window[window.mainMetrika].hit(virtPage, {title: virtTitle,referer: window.location.href});
  }
}
 
function t889_init(recid) {
    var el = $('#rec' + recid);

    t889_setHeight(recid);

    $(window).bind('resize', t_throttle(function () {
        if (typeof window.noAdaptive !== 'undefined' && window.noAdaptive === true && window.isMobile) { return; }
        t889_setHeight(recid);
    }));

    el.find('.t889').bind('displayChanged', function () {
        t889_setHeight(recid);
    });

    if (window.isMobile) {
        $(window).on('orientationchange', function () {
            t889_setHeight(recid);
        });
    }
}

function t889_setHeight(recid) {
    var el = $('#rec' + recid);
    var wrapper = el.find('.t889__wrapper');
    var imgWrapper = el.find('.t889__blockimg');
    var textWrapperHeight = el.find('.t889__content').outerHeight(true);

    var img = new Image();
    var imgSrc = imgWrapper.find('img').data('original') || imgWrapper.find('img').attr('src');
    $(img).attr('src', imgSrc);
    $(img).load(function () {
        if ($(window).width() > 960) {
            var imgHeight = imgWrapper.height();
            if (textWrapperHeight >= imgHeight) {
                wrapper.css('height', textWrapperHeight);
            } else {
                wrapper.css('height', imgHeight);
            }
        } else {
            wrapper.css('height', '');
        }
    });
} 
function t905_init(recid) {
    var el = $('#rec' + recid);

    t905_unifyHeights(recid);

    $(window).on('resize', t_throttle(function () {
        t905_unifyHeights(recid)
    }));

    $(window).on('load', function () {
        t905_unifyHeights(recid);
    });

    el.find('.t905').on('displayChanged', function () {
        t905_unifyHeights(recid);
    });
}

function t905_unifyHeights(recid) {
    var el = $('#rec' + recid);
    var cards = el.find('.t905__card');

    cards.each(function(i, card) {
        var img = $(card).find('.t905__image');
        var imgHeight = $(img).outerHeight();
        var content = $(card).find('.t905__content');
        var contentHeight = $(content).outerHeight();

        if (contentHeight > imgHeight) {
            img.css('height', contentHeight + 'px');
            img.css('padding-bottom', 'initial');
        }
    });
}
 
function t922_init(recid){
  setTimeout(function(){
    $('#rec'+recid+' .t-cover__carrier').addClass('js-product-img');
    t_onFuncLoad('t_prod__init', function () {
        t_prod__init(recid);
    });
  }, 500);

  $('body').trigger('twishlist_addbtn');
}