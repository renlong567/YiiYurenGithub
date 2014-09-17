// ajax提交表单
function ajaxSubmitForm(id, type, param)
{
    var add_data = '';
    if (param)
    {
        for (key in param) {
            add_data += "&" + key + "=" + param[key];
        }
    }
    // 开启按钮禁用
    set_button_off();
    $.ajaxSetup({
        cache: false
    });
    $.post($(id).attr('action'), $(id).serialize() + add_data, function(data) {
        // 调用自定义回调设置函数
        callback(type, data);
        // 取消按钮禁用
        set_button_on();
    }, 'json');
}
function ajaxSubmitUrl(url, type, param, data_type)
{
    var add_data = '';
    if (param)
    {
        for (key in param) {
            add_data += "&" + key + "=" + param[key];
        }
    }
    if (!data_type)
    {
        data_type = 'json';
    }
    $.ajaxSetup({
        cache: false
    });
    set_button_off();
    $.post(url, add_data, function(data) {
        callback(type, data);
        set_button_on();
    }, data_type);
}
// 设置不同类型的ajax请求返回方法
function callback(type, data)
{

    if (type == 'login' || type == 'add' || type == 'delete' || type == 'update')
    {
        $.jBox.tip(data.msg);
        if (data.status == '1')
        {
            window.setTimeout(function() {
                window.location.href = data.url;
            }, 1500);
        }
    }
}
// 开启按钮禁用
function set_button_off()
{
    $('.ajax_link_button').each(function(i) {
        var herf = $(this).attr('href');
        $(this).attr('href', 'javascript:;');
        $(this).attr('data-href', herf);
    });
    $('input[type="button"]').attr('disabled', 'true');
    $('input[type="button"],.ajax_link_button').addClass('btnGray');
}
// 取消按钮禁用
function set_button_on()
{
    $('.ajax_link_button').each(function(i) {
        var herf = $(this).attr('data-href');
        $(this).attr('href', herf);
        $(this).removeAttr('data-href');
    });
    $('input[type="button"]').removeAttr("disabled");
    $('input[type="button"],.ajax_link_button').removeClass('btnGray');
}
function removeE(index, em)
{
    $(histyData[index]).parent().parent().show(300);
    $(em).remove();
    $(histyData[index]).attr("disabled", false);
}

/**
 * @desc		选择成员效果
 * @author 		Ren Long
 * @date		2013-07-12
 * @return             void
 */
var histyData = new Array();
$(document).ready(function() {
    $("#team_sub").click(function() {
        var main_team_num = $("[name=team_num]").val();
        if (main_team_num < 1)
        {
            $("#team_sub").next("span").text("请输入组别").show(300);
            return false;
        }
        else if (!($('tbody :checkbox').is(":checked")))
        {
            $("#team_sub").next("span").text("请选择成员").show(300);
            return false;
        }
        else
        {
            $("#team_sub").next("span").hide(300);
            $("#table").append("<tr ><th>" + '第' + main_team_num + '组' + "</th></tr>");
            $('tbody :checkbox:checked').each(function()
            {
                if (histyData.indexOf(this) === -1)
                    histyData.push(this);
                $(this).parent().parent().hide(300);
                $(this).removeAttr("checked");
                $(this).attr("disabled", true);
                var id = $(this).val();
                var html = '<input type="hidden" id="s_' + main_team_num + id + '" name="group[' + main_team_num + '][]" value="' + id + '" />';
                var temp = $(this).parent().attr("data-id", id);
                var tdobj = $(this).parent().next();
                $("#table").append('<td ondblclick="removeE(' + histyData.indexOf(this) + ',this)">' + tdobj.text() + html + '</td>');


            });
        }

        $("#table").find('tr').bind(
                {
                    dblclick: function()
                    {
                        $(this).remove();
                    },
                    mouseover: function()
                    {
                        $(this).css({"background-color": "#A7C942",
                            "cursor": "pointer"});
                    },
                    mouseout: function()
                    {
                        $(this).css("background-color", "#FFFFFF");
                    }
                });

        $("#table").find('td').bind({
            mouseover: function()
            {
                $(this).css({"background-color": "#A7C942",
                    "cursor": "pointer"});
            },
            mouseout: function()
            {
                $(this).css("background-color", "#FFFFFF");
            }
        });
    });
});

$(document).ready(function() {
    $("#table").submit(function() {
        var title = $("[name=team_title]").val();
        if (title == "")
        {
            if (confirm('确实不需要标题吗？'))
            {
                $(this).next("span").text('');
                return true;
            }
            else
            {
                return false;
            }
        }
    });
});

//图片旋转木马,CloudCarousel.1.0.5.js,jquery.mousewheel.js,
$(document).ready(function() {

    // 这初始化容器中指定的元素，在这种情况下，旋转木马.
//    $("#carousel1").CloudCarousel({
//        xPos: 450,
//        yPos: 110,
//        buttonLeft: $('#but1'),
//        buttonRight: $('#but2'),
//        altBox: $("#alt-text"),
//        titleBox: $("#title-text"),
//        FPS: 30,
//        reflHeight: 86,
//        reflGap: 2,
//        yRadius: 40,
//        autoRotateDelay: 1200,
//        speed: 0.2,
//        mouseWheel: true,
//        bringToFront: true
//    });

});


//Uniform插件设置上传文件样式 On load, style typical form elements
//$(function() {
//    $(":file").uniform();
//});

// This function is called from the pop-up menus to transfer to
// a different page. Ignore if the value returned is a null string:
function goPage(newURL) {

    // if url is empty, skip the menu dividers and reset the menu selection to default
    if (newURL != "") {

        // if url is "-", it is this page -- reset the menu:
        if (newURL == "-") {
            resetMenu();
        }
        // else, send page to designated URL            
        else {
            document.location.href = newURL;
        }
    }
}

// resets the menu selection upon entry to this page:
function resetMenu() {
    document.gomenu.selector.selectedIndex = 2;
}