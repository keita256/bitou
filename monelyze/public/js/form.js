//金額フォーム処理
$(function(){
    $(".keyword").blur(function(){
        charChange($(this));
    });
 
    //全角→半角
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
    var count = 1;
    var clonecode = $("#template").clone(true);
    clonecode.css("display", "block");
    clonecode.attr("id", "form_row" + count);
    clonecode.insertBefore($("#fixed"));
});

//form減少
function form_remove(cross_mark_el){
    $(cross_mark_el).parent().parent().remove();
}


//action属性変更
function setAction(url) {
    $('#paymentForm').attr('action', url);
}

$(function() {
	$(".dateChange").click(function() {
        // value値を取得
        const year = $("#selectYear").val();
		const month = $("#selectMonth").val();
        const url = "/payment/" + year + "/" + month;
        $('.dateForm').attr('action', url);
	});
});


//値挿入
$(function() {
	$(".insertVal").click(function(value) {
        const content = value.target.parentNode.children[0].textContent;
        const amount = value.target.parentNode.children[1].textContent;
        const number = value.target.parentNode.children[2].textContent;
        //設定
        $("#Input1").val(content);
        $("#Input2").val(amount);
        $("#Input3").val(number);
	});
});
