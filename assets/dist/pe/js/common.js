// JavaScript Document
$( window ).load(function() {
setFooter();
setHeight();
});
$( window ).resize(function() {
setFooter();
setHeight();
});
function setFooter(){
var windowHeight = $(window).height();
var container_intHeight = windowHeight-82;
console.log("Window Height->"+ windowHeight);
console.log("document Height->"+ $(document).height());
$(".container_int_wrapper").css("height", container_intHeight+"px");
var position = $( ".foot_tag" ).position();
$(".foot_tag").attr("style", "margin-top: 75px !important");
var foot_tag_total_height = position.top +$(".foot_tag").height()+parseInt($(".foot_tag").css("margin-top"))+parseInt($(".foot_tag").css("margin-bottom"));
if($( document ).height()> foot_tag_total_height){
var height_diff = $( document ).height()-foot_tag_total_height;
var new_margin_top = parseInt($(".foot_tag").css("margin-top"))+height_diff;
new_margin_top = new_margin_top - parseInt($(".navbar").height());
if(new_margin_top < 75) {
new_margin_top = 75;
}
$(".foot_tag").attr("style", "margin-top: "+(new_margin_top-1)+"px !important");
}else{
}

}

/*********************************** Sets height of BG_Div*******************/
function setHeight() {
   //windowHeight = $(window).innerHeight();
   windowHeight = $(window).height();
   //$('.bg_div').css('min-height', windowHeight);
   $('.bg_div').height(windowHeight);
}