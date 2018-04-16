$(function () {
var limit = 10;
var offset = 0;
//更新网站概要统计报表
rpt_overview_refresh();
//展示网站概要统计报表
rpt_overview();

//更新网站概要统计报表
function rpt_overview_refresh() {
  var api_url = 'rpt_overview_refresh.php';
  var post_data = {"limit": limit, "offset": offset};
  CallApi(api_url,post_data, function (response) {
  }, function (response) {
    AlertDialog(response.errmsg);
    });
}

// 展示网站概要统计报表
function rpt_overview() {
  var api_url = 'rpt_overview.php';
  var post_data = {"limit": limit, "offset": offset};
  CallApi(api_url,post_data,function (response) {
  var rpt_title, rpt_unit, rpt_count, rpt_time;
  var clist = response.rows;
  if (clist.length > 0) {
    clist.forEach(function(value, index, array) {
      rpt_title = value.rpt_title;
      rpt_count = value.rpt_count;
      rpt_unit  = value.rpt_unit;
      rpt_time = value.rpt_time;
      check = '\
      <label class="weui-cell weui-check__label" >\
        <div class="weui-cell__bd">' + rpt_unit +'</div>\
        <div class="weui-cell__bd">' + rpt_unit +'</div>\
        <div class="weui-cell__bd">' + rpt_count + '</div>\
        <div class="weui-cell__ft">' + rpt_time.substr(5, 11) + '</div>\
      </label>\
      ';
      $("#count_rows").append(check);
    });
  }
}, function (response) {
console.log(response.errmsg)
  });
}   

})


 