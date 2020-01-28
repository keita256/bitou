//全角→半角
$(function(){
    $(".keyword").blur(function(){
        charChange($(this));
    });
 
 
    charChange = function(e){
        var val = e.val();
        var str = val.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){return String.fromCharCode(s.charCodeAt(0)-0xFEE0)});
 
        if(val.match(/[Ａ-Ｚａ-ｚ０-９]/g)){
            $(e).val(str);
        }
    }
});

//form増加
$(document).on("click", ".add", function() {
    var clonecode = $("#template").clone(true, false);
    clonecode.css("display", "inline-flex");
    clonecode.insertBefore($("#template"));
});

//form減少
function form_remove(cross_mark_el){
    $(cross_mark_el).parent().remove();
}