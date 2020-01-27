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
    $(this).parent().clone(true).insertAfter($(this).parent());
});
$(document).on("click", ".del", function() {
    var target = $(this).parent();
    if (target.parent().children().length > 1) {
        target.remove();
    }
});
