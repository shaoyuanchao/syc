$(function () {
staff_infoview();
})
var limit = 10;
var offset = 0;
//获取当前用户的staff_name
var name = $('#name').text();
var i = 0;
var j = 0;
var date = new Date();
var year = date.getFullYear();
// 展示员工信息
function staff_infoview() {
    var api_url = 'staff_main_all.php';
    var post_data = {"limit": limit, "offset": offset};
    var pre = "<div class='swiper-container'><div class='container swiper-wrapper' id='staff_info'>";  
    CallApi(api_url, post_data, function (response) {
    var staff_id, staff_cd, staff_name, staff_sex, birth_year, birth_day, join_date,staff_mbti,staff_age,staff_price;
    var rows = response.rows;

    var checks = '';
    if (rows.length > 0) {
        rows.forEach(function(row, index, array) {
            staff_id = row.staff_id;
            staff_price = row.price;
            staff_cd = row.staff_cd;
            staff_name = row.staff_name;
            staff_constel = row.constel;
            staff_age = row.age;
            //得到当前员工位置
            if(staff_name != name){
                i++;
            }else{
                j = i;
            }
            //判断性别
            staff_sex = row.staff_sex;
            if(staff_sex == 1){
              staff_sex = "img/man.png";
            }else{
              staff_sex = "img/woman.png";
            }
            join_date = row.join_date;
            staff_avata = row.staff_avata;
            staff_mbti  = row.staff_mbti;
            check = '\
            <div class="swiper-slide">\
                <div class="weui-cell">\
                    <div class="upload">\
                        <form  id="uploadForm" enctype="multipart/form-data" method="post" action="">\
                            <img src="'+ staff_avata +'" id="image"  class="avata" name="image" />\
                        </form>\
                        <div class="page__hd upload" >\
                            <h1 class="page__title staff-name">'+ staff_name +'</h1>\
                            <p class="page__desc staff-number">工号'+ ' ' + staff_cd+'</p>\
                        </div>\
                    </div>\
                </div>\
                <div class="weui-cells__title">个人简介</div>\
                <textarea class="weui-textarea staff-desc" rows="2"></textarea>\
                <div class="weui-cells__title">个人信息</div>\
                <div class="weui-cell">\
                    <div class="weui-cell__hd bt"><label class="weui-label">性别：</label></div>\
                    <div class="weui-cell__bd bc"><img src="'+staff_sex+'" class = "sex"></div>\
                </div>\
                <div class="weui-cell">\
                    <div class="weui-cell__hd bt"><label class="weui-label">年龄：</label></div>\
                    <div class="weui-cell__bd bc">'+staff_age +'</p></div>\
                </div>\
                <div class="weui-cell">\
                    <div class="weui-cell__hd bt"><label class="weui-label">星座：</label></div>\
                    <div class="weui-cell__bd bc"><p>'+ staff_constel +'</p></div>\
                </div>\
                <div class="weui-cell">\
                    <div class="weui-cell__hd bt"><label class="weui-label">手机：</label></div>\
                    <div class="weui-cell__bd bc"><p>'+ "" +'</p></div>\
                </div>\
                <div class="weui-cell">\
                    <div class="weui-cell__hd bt"><label class="weui-label">性格：</label></div>\
                    <div class="weui-cell__bd bc"><p>'+ staff_mbti +'</p></div>\
                </div>\
                <div class="weui-cell">\
                    <div class="weui-cell__hd bt"><label class="weui-label">加入日期：</label></div>\
                    <div class="weui-cell__bd bc"><p>'+ join_date.substring(0,10) +'</p></div>\
                </div>\
                <div class="weui-cell">\
                    <div class="weui-cell__hd bt"><label class="weui-label">本周补贴：</label></div>\
                    <div class="weui-cell__bd bc"><p class="price">'+ staff_price +'</p></div>\
                </div>\
                <div class="weui-cell">\
                    <div class="weui-cell__hd bt"><label class="weui-label">经费余额：</label></div>\
                    <div class="weui-cell__bd bc"><p class="money">'+'</p></div>\
                </div>\
            </div>\
                  ';
            //字符串拼接
            checks += check;
     
        });
  
    }
    var end = "</div><div class='swiper-pagination'></div></div>";  

    var all = pre + checks + end;
    $(".info").append(all);

    var swiper = new Swiper('.swiper-container', {
    initialSlide : j,          //轮播起始位置，当前员工
    slidesPerView : 1,        //设置slider容器能够同时显示的slides数量，默认为1
    loop: true,              //设置为true 则开启loop模式。loop模式：会在原本slide前后复制若干个slide(默认一个)并在合适的时候切换，让Swiper看起来是循环的
    observer:true,          //修改swiper自己或子元素时，自动初始化swiper
    observeParents:true    //修改swiper的父元素时，自动初始化swiper
});

}, function (response) {
console.log(response.errmsg)
  });
}   
 