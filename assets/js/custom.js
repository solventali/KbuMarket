
jQuery(window).load(function() {
   
   // Page Preloader
   jQuery('#status').fadeOut();
   jQuery('#preloader').delay(350).fadeOut(function(){
      jQuery('body').delay(350).css({'overflow':'visible'});
   });
});

jQuery(document).ready(function() {
   
   // Toggle Left Menu
   jQuery('.nav-parent > a').click(function() {
      
      var parent = jQuery(this).parent();
      var sub = parent.find('> ul');
      
      // Dropdown works only when leftpanel is not collapsed
      if(!jQuery('body').hasClass('leftpanel-collapsed')) {
         if(sub.is(':visible')) {
            sub.slideUp(200, function(){
               parent.removeClass('nav-active');
               jQuery('.mainpanel').css({height: ''});
               adjustmainpanelheight();
            });
         } else {
            closeVisibleSubMenu();
            parent.addClass('nav-active');
            sub.slideDown(200, function(){
               adjustmainpanelheight();
            });
         }
      }
      return false;
   });
   
   function closeVisibleSubMenu() {
      jQuery('.nav-parent').each(function() {
         var t = jQuery(this);
         if(t.hasClass('nav-active')) {
            t.find('> ul').slideUp(200, function(){
               t.removeClass('nav-active');
            });
         }
      });
   }
   
   function adjustmainpanelheight() {
      // Adjust mainpanel height
      var docHeight = jQuery(document).height();
      if(docHeight > jQuery('.mainpanel').height())
         jQuery('.mainpanel').height(docHeight);
   }
   
   
   // Tooltip
   jQuery('.tooltips').tooltip({ container: 'body'});
   
   // Popover
   jQuery('.popovers').popover();
   
   // Close Button in Panels
   jQuery('.panel .panel-close').click(function(){
      jQuery(this).closest('.panel').fadeOut(200);
      return false;
   });
   
   // Form Toggles
   jQuery('.toggle').toggles({on: true});
   
   jQuery('.toggle-chat1').toggles({on: false});
   
   // Sparkline
   jQuery('#sidebar-chart').sparkline([4,3,3,1,4,3,2,2,3,10,9,6], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#428BCA'
   });
   
   jQuery('#sidebar-chart2').sparkline([1,3,4,5,4,10,8,5,7,6,9,3], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#D9534F'
   });
   
   jQuery('#sidebar-chart3').sparkline([5,9,3,8,4,10,8,5,7,6,9,3], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#1CAF9A'
   });
   
   jQuery('#sidebar-chart4').sparkline([4,3,3,1,4,3,2,2,3,10,9,6], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#428BCA'
   });
   
   jQuery('#sidebar-chart5').sparkline([1,3,4,5,4,10,8,5,7,6,9,3], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#F0AD4E'
   });
   
   
   // Minimize Button in Panels
   jQuery('.minimize').click(function(){
      var t = jQuery(this);
      var p = t.closest('.panel');
      if(!jQuery(this).hasClass('maximize')) {
         p.find('.panel-body, .panel-footer').slideUp(200);
         t.addClass('maximize');
         t.html('&plus;');
      } else {
         p.find('.panel-body, .panel-footer').slideDown(200);
         t.removeClass('maximize');
         t.html('&minus;');
      }
      return false;
   });
   
   
   // Add class everytime a mouse pointer hover over it
   jQuery('.nav-bracket > li').hover(function(){
      jQuery(this).addClass('nav-hover');
   }, function(){
      jQuery(this).removeClass('nav-hover');
   });
   
   
   // Menu Toggle
   jQuery('.menutoggle').click(function(){
      
      var body = jQuery('body');
      var bodypos = body.css('position');
      
      if(bodypos != 'relative') {
         
         if(!body.hasClass('leftpanel-collapsed')) {
            body.addClass('leftpanel-collapsed');
            jQuery('.nav-bracket ul').attr('style','');
            
            jQuery(this).addClass('menu-collapsed');
            
         } else {
            body.removeClass('leftpanel-collapsed chat-view');
            jQuery('.nav-bracket li.active ul').css({display: 'block'});
            
            jQuery(this).removeClass('menu-collapsed');
            
         }
      } else {
         
         if(body.hasClass('leftpanel-show'))
            body.removeClass('leftpanel-show');
         else
            body.addClass('leftpanel-show');
         
         adjustmainpanelheight();         
      }

   });
   
   // Chat View
   jQuery('#chatview').click(function(){
      
      var body = jQuery('body');
      var bodypos = body.css('position');
      
      if(bodypos != 'relative') {
         
         if(!body.hasClass('chat-view')) {
            body.addClass('leftpanel-collapsed chat-view');
            jQuery('.nav-bracket ul').attr('style','');
            
         } else {
            
            body.removeClass('chat-view');
            
            if(!jQuery('.menutoggle').hasClass('menu-collapsed')) {
               jQuery('body').removeClass('leftpanel-collapsed');
               jQuery('.nav-bracket li.active ul').css({display: 'block'});
            } else {
               
            }
         }
         
      } else {
         
         if(!body.hasClass('chat-relative-view')) {
            
            body.addClass('chat-relative-view');
            body.css({left: ''});
         
         } else {
            body.removeClass('chat-relative-view');   
         }
      }
      
   });
   
   reposition_searchform();
   
   jQuery(window).resize(function(){
      
      if(jQuery('body').css('position') == 'relative') {

         jQuery('body').removeClass('leftpanel-collapsed chat-view');
         
      } else {
         
         jQuery('body').removeClass('chat-relative-view');         
         jQuery('body').css({left: '', marginRight: ''});
      }
      
      reposition_searchform();
      
   });
   
   function reposition_searchform() {
      if(jQuery('.searchform').css('position') == 'relative') {
         jQuery('.searchform').insertBefore('.leftpanelinner .userlogged');
      } else {
         jQuery('.searchform').insertBefore('.header-right');
      }
   }
   
   
   // Sticky Header
   if(jQuery.cookie('sticky-header'))
      jQuery('body').addClass('stickyheader');
      
   // Sticky Left Panel
   if(jQuery.cookie('sticky-leftpanel')) {
      jQuery('body').addClass('stickyheader');
      jQuery('.leftpanel').addClass('sticky-leftpanel');
   }
   
   // Left Panel Collapsed
   if(jQuery.cookie('leftpanel-collapsed')) {
      jQuery('body').addClass('leftpanel-collapsed');
      jQuery('.menutoggle').addClass('menu-collapsed');
   }
   
   // Changing Skin
   var c = jQuery.cookie('change-skin');
   if(c) {
      jQuery('head').append('<link id="skinswitch" rel="stylesheet" href="css/style.'+c+'.css" />');
   }
   

});

var list = $("nav>ul li > a"); //Liste de tout les liens
//Gestion du clique sur le boutton des trois bars afin d'afficher le menu dans les support avec un width <769
$("nav > a").click(function(event){
    $("nav>ul").slideToggle();
});
//Gestion des cliques sur les liens avec élimination du comportement par défaut du a dans le cas où il existe un sous menu
list.click(function (event) {
    var submenu = this.parentNode.getElementsByTagName("ul").item(0);
    //S'il existe un sous menu sinon c'est un lien terminal
    if(submenu!=null){
        event.preventDefault();
        $(submenu).slideToggle();
    }
});
//Gestion du resize de la fenetre pour eliminer le style ajouté par la méthode .slideToggle()
$(window).resize(function () {
    if ($(window).width() > 1024) {
        $("nav > ul, nav > ul  li  ul").removeAttr("style");
    }
});

$(function(){
    var Slider=0;
    $.Slider=function(toplam){
        $(".slide-button > li").removeClass("aktif");
        $(".slide-item").hide();
        if (Slider<toplam-1){
            Slider++;

            $(".slide-button > li:eq("+Slider+")").addClass("aktif");
            $(".slide-item:eq("+Slider+")").show();
        }
        else
        {
            $(".slide-button > li:first").addClass("aktif");
            $(".slide-item:first").show();
            Slider=0;
        }
    }
    var toplamLi=$(".slide-item").length;
    var interval=setInterval('$.Slider('+toplamLi+')',6000);
    $(".p-slider").hover(function(){
        clearInterval(interval);
    },function(){
        interval=setInterval('$.Slider('+toplamLi+')',3000);
    });
    $(".slide-container").hover(
        function(){$(".slvnt-buton").show();},
        function(){$(".slvnt-buton").hide();}
    );

    $(".slide-button > li:first").addClass("aktif");
    $(".slide-item").hide();
    $(".slide-item:first").show();
    $(".slide-button > li").click(function(){
        var indis=$(this).index();
        $(".slide-button > li").removeClass("aktif");
        $(".slide-item").hide();
        $(this).addClass("aktif");
        $(".slide-item:eq("+indis+")").show();
        Slider=indis;
        return false;
    });
    $(".slvnt-prev").click(function(){
        var indis=$(".slide-button > li.aktif").index();
        if (indis>0)
        {
            indis--;
            $(".slide-button > li").removeClass("aktif");
            $(".slide-item").hide();
            $(".slide-button > li:eq("+indis+")").addClass("aktif");
            $(".slide-item:eq("+indis+")").show();
            Slider=indis;
        }
        else{
            indis=$(".slide-item").length-1;
            $(".slide-button > li").removeClass("aktif");
            $(".slide-item").hide();
            $(".slide-button > li:eq("+indis+")").addClass("aktif");
            $(".slide-item:eq("+indis+")").show();
            Slider=indis;
        }
        return false;
    });
    $(".slvnt-next").click(function(){
        var indis=$(".slide-button > li.aktif").index();
        if (indis<$(".slide-item").length-1)
        {
            indis++;
            $(".slide-button > li").removeClass("aktif");
            $(".slide-item").hide();
            $(".slide-button > li:eq("+indis+")").addClass("aktif");
            $(".slide-item:eq("+indis+")").show();
            Slider=indis;
        }
        else{
            indis=0;
            $(".slide-button > li").removeClass("aktif");
            $(".slide-item").hide();
            $(".slide-button > li:eq("+indis+")").addClass("aktif");
            $(".slide-item:eq("+indis+")").show();
            Slider=indis;
        }
        return false;
    });
});


/* ürün sayfalama*/

var toplamP = $(".product-a").size();
var veriSayisi = 12;

var gt = 0;
$(".product-a:gt(" + (veriSayisi - 1) + ")").hide();

var sayfaSayisi = Math.round(toplamP / veriSayisi);
$("#paging").append('<a href="javascript:void(0)">' +"<<"+ '</a>');
$("#paging").append('<a href="javascript:void(0)">' +"<"+ '</a>');
for (var i = 1; i <= sayfaSayisi; i++)
{
    $("#paging").append('<a href="javascript:void(0)">' + i + '</a>');
}
$("#paging").append('<a href="javascript:void(0)">' +">"+ '</a>');
$("#paging").append('<a href="javascript:void(0)">' +">>"+ '</a>');

$("#paging a:first").addClass("aktif");

$("#paging a").live('click', function () {
    var topindis = $("#paging a").size();

    var indis = $(this).index();
    if (indis>1 && (indis+2)<topindis)
        gt=veriSayisi * (indis-1);
    if (indis==0)
        gt=veriSayisi;
    if (indis==1){
        if (gt>veriSayisi)
            gt-=veriSayisi;
        else
            gt=veriSayisi;
    }
    if ((indis+2)==topindis){
        if (gt<toplamP)
            gt+=veriSayisi;
        else
            gt=toplamP;
    }
    if ((indis+1)==topindis)
        gt=(topindis-4)*veriSayisi;
    $("#paging a").removeClass("aktif");
    $(this).addClass("aktif");

    $(".product-a").hide();
    for (i = gt - veriSayisi; i < gt; i++)
    {
        $(".product-a:eq(" + i + ")").show();
    }
});