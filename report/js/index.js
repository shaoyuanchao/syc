$(function () {

    //更新网站概要统计报表
    rpt_overview_refresh();
    //展示网站概要统计报表
    rpt_overview();
})

//更新网站概要统计报表
function rpt_overview_refresh() {
    var api_url = 'rpt_overview_refresh.php';
    CallApi(api_url, {}, function (response) {}, function (response) {});
}

// 展示网站概要统计报表
function rpt_overview(){
    var api_url = 'rpt_overview.php';
    CallApi(api_url, {}, function (response) {
    var rpt_title, rpt_unit, rpt_count, rpt_time;
    var url_list = response.rows;
    if (url_list.length > 0) {
        url_list.forEach(function(url_list, index, array) {
        rpt_title = url_list.rpt_title;
        rpt_count = url_list.rpt_count;
        rpt_unit  = url_list.rpt_unit;
        check = '\
        <label class="weui-cell weui-check__label" >\
          <div class="weui-cell__bd">' + rpt_title +'</div>\
          <div class="weui_cell_primary">' +rpt_count + rpt_unit +'</div>\
        </label>\
        ';
        $("#count_rows").append(check);
      });
    }
  }, function (response) {
  console.log(response.errmsg)
    });
}   

