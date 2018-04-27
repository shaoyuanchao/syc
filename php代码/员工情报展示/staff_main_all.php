<?php
require_once '../inc/common.php';

header("cache-control:no-cache,must-revalidate");
header("Content-Type:application/json;charset=utf-8");
/*
========================== 员工基本信息一览表 ==========================
返回
  total      员工总人数
  rows       记录数组
  staff_id   员工id 
  staff_cd   员工工号
  staff_name 员工姓名
  staff_sex  员工性别
  age        员工年龄
  join_date  加入时间
  constel    员工星座
说明
  风赢科技员工基本信息一览表
*/

php_begin();
// 提交参数整理
$limit = get_arg_str('GET', 'limit');
$offset = get_arg_str('GET', 'offset');

//获取所有员工信息
$rows = get_staff_info();
//获取信息总条数
$total = get_staff_info_total();


//获取员工基本信息
//======================================
// 函数: get_staff_info()
// 功能: 获取所有员工的基本信息
// 参数：limit     （记录条数，可选）默认10 最大100
// 参数：offset    （记录偏移量，可选）默认0 与limit参数一起分页使用。如设置 offset=20&limit=10 取第21-30条记录
// 返回: 员工基本信息
//======================================
function get_staff_info(){
    $weekBegin = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
    $commonTime = date("Y-m-d H:i:s" , $weekBegin);
    $year = substr($commonTime,0,4);
    $num = substr($commonTime,5,2);
    $dta = substr($commonTime,8,2);
    $db = new DB_WWW();
    $sql = "SELECT * FROM staff_main WHERE 1";
    $db->query($sql);
    $rows = $db->fetchAll();
    $array = array();
    foreach($rows as $row){
        $staff_id = $row['staff_id'];
        $birth_day = $row['birth_day'];
        $birth_year = $row['birth_year'];
        $age = $year - $birth_year;
        $m = substr($birth_day,0,2);
        $d = substr($birth_day,3,2);
        $constel =get_star_sign_12($m,$d);
        $price =  get_staff_sign($staff_id);
        $row['price'] = $price;
        $row['constel'] = $constel;
        $row['age'] = $age;
        array_push($array,$row);
    } 
    return $array;
}

//获取员工签到信息
//======================================
// 函数: get_staff_sign($staff_id)
// 功能: 根据staff_id获取员工本周签到记录
// 参数: $staff_id      员工id
// 返回: 员工本周补贴金额（本周到查询当天的补贴）
//======================================
function get_staff_sign($staff_id){
  
    $i = 0;
    $price = 0;
    $all_day = 0;
    $utime1 = 0;
    $utime2 = 0;
    $subsidy_noon1 =0;
    $subsidy_noon2 =0;
    $subsidy_dinner1 =0;
    $subsidy_dinner2 =0;
    $weekBegin = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
    $commonTime = date("Y-m-d H:i:s" , $weekBegin);
    $year = substr($commonTime,0,4);
    $num = substr($commonTime,5,2);
    $dta = substr($commonTime,8,2);
 
    $db = new DB_WWW();
 
    $sql = "SELECT * FROM staff_office_sign WHERE staff_id = '{$staff_id}' AND utime > '{$weekBegin}'";
    $db->query($sql);
    $rows = $db->fetchAll();
        foreach($rows as $key){
            $utime = $key['utime'];
            $ctime = $key['ctime'];
            $sign_type = $key['sign_type'];
            if($num == 1 || $num==3 || $num==5 || $num == 7 || $num == 8 || $num == 10 || $num == 12){
                $all_day = 31;
            }else if($num == 4 || $num == 6 || $num == 9 || $num == 11){
                $all_day = 30;
            }else if($num==2){
                $all_day=28+($year % 4 == 0 && $year % 100 || $year % 400 == 0);
            }
        if(substr($ctime,8,2) == ($dta)){
            if(substr($ctime,0,4) == $year && substr($ctime,5,2) == $num && substr($ctime,8,2) == ($dta)){
                    if($sign_type == "白金湾339签出"){
                        if($utime2 != 0){
                            $utime1 = $utime;
                            if($utime1 < $utime2){
                                $utime1 = 0;
                                continue;
                            }
                        }
                        if(substr($ctime,11,2) >= 18){
                            if(substr($ctime,11,2) > 20){
                                $subsidy_dinner2 += 1;
                                $subsidy_noon2 += 1;
                            }else if(substr($ctime,11,2) == 20 && substr($ctime,14,2) < 30){
                                $subsidy_noon2 += 1;
                            }else if(substr($ctime,11,2) == 20 && substr($ctime,14,2) >= 30){
                                $subsidy_dinner2 += 1;
                                $subsidy_noon2 += 1;
                            
                            }else if(substr($ctime,11,2) < 20){
                                $subsidy_noon2 += 1;
                            }
                            
                        }
                        else{
                            $subsidy_dinner2 = 0;
                            $subsidy_noon2 = 0;
                        }
                    }

            if($utime2 == 0){
                if($sign_type == "白金湾339签入"){
                    $utime2 = $utime;
                    if(substr($ctime,11,2) <= 12){
                        if(substr($ctime,11,2) < 10){
                            $subsidy_noon1 +=1;
                            $subsidy_dinner1 +=1;
                        }else if(substr($ctime,11,2) == 10 && substr($ctime,14,2) <= 30){
                            $subsidy_noon1 +=1;
                            $subsidy_dinner1 +=1;
                        }else if(substr($ctime,11,2) == 10 && substr($ctime,14,2) > 30){
                            $subsidy_dinner1 +=1;
                          
                        }else if(substr($ctime,11,2) > 10){
                            $subsidy_dinner1 +=1;
                        }
                    }
                    else{
                        $subsidy_noon1 =0;
                        $subsidy_dinner1 =0;
                    }
                }
            }
            if($utime1 != 0 && $utime2 != 0){
                $xtime = $utime1 - $utime2;
                $dta++;
                if($dta > $all_day){
                    $num++;
                    if($num > 12){
                        $num = 1;
                        $year++;
                    }
                    if($num == 1 || $num==3 || $num==5 || $num == 7 || $num == 8 || $num == 10 || $num == 12){
                        $all_day = 31;
                    }else if($num == 4 || $num == 6 || $num == 9 || $num == 11){
                        $all_day = 30;
                    }else if($num==2){
                        $all_day=28+($year % 4 == 0 && $year % 100 || $year % 400 == 0);
                    }
                    $dta = 1;
                }
                if($subsidy_noon1 !=0 && $subsidy_noon2 !=0){
                    $price +=15;
                    $subsidy_noon1 = 0;
                    $subsidy_noon2 = 0;                            
                }
                if($subsidy_dinner1 !=0 && $subsidy_dinner2 != 0){
                    $price += 15;
                    $subsidy_dinner1 = 0;
                    $subsidy_dinner2 = 0;
                }
                if($xtime >= (60*60*4)){
                    $price += 10;
                    $utime1 = 0;
                    $utime2 = 0;
                }
                $i +=$price;
            }
            $price = 0;
            continue;
        }
    }

    if(substr($ctime,8,2) != ($dta)){
        $dta++;
        if(substr($ctime,0,4) == $year && substr($ctime,5,2) == $num && substr($ctime,8,2) == ($dta)){
            if($utime1 == 0){
            if($sign_type == "白金湾339签出"){
                $utime1 = $utime;
                if(substr($ctime,11,2) >= 18){
                    if(substr($ctime,11,2) > 20){
                        $subsidy_dinner2 += 1;
                        $subsidy_noon2 += 1;
                    }else if(substr($ctime,11,2) == 20 && substr($ctime,14,2) < 30){
                        $subsidy_noon2 += 1;
                    }else if(substr($ctime,11,2) == 20 && substr($ctime,14,2) >= 30){
                        $subsidy_dinner2 += 1;
                        $subsidy_noon2 += 1;
                       
                    }else if(substr($ctime,11,2) < 20){
                        $subsidy_noon2 += 1;
                    }
                    
                }
                else{
                    $subsidy_dinner2 = 0;
                    $subsidy_noon2 = 0;
                }
            }
        }

        if($utime2 == 0){
            if($sign_type == "白金湾339签入"){
                $utime2 = $utime;
                if(substr($ctime,11,2) <= 12){
                    if(substr($ctime,11,2) < 10){
                        $subsidy_noon1 +=1;
                        $subsidy_dinner1 +=1;
                    }else if(substr($ctime,11,2) == 10 && substr($ctime,14,2) <= 30){
                        $subsidy_noon1 +=1;
                        $subsidy_dinner1 +=1;
                    }else if(substr($ctime,11,2) == 10 && substr($ctime,14,2) > 30){
                        $subsidy_dinner1 +=1;
                      
                    }else if(substr($ctime,11,2) > 10){
                        $subsidy_dinner1 +=1;
                    }
                }
                else{
                    $subsidy_noon1 =0;
                    $subsidy_dinner1 =0;
                }
            }
        }
        if($utime1 != 0 && $utime2 != 0){
            $xtime = $utime1 - $utime2;
            $dta++;
            if($dta > $all_day){
                $num++;
                if($num > 12){
                    $num = 1;
                    $year++;
                }
                if($num == 1 || $num==3 || $num==5 || $num == 7 || $num == 8 || $num == 10 || $num == 12){
                    $all_day = 31;
                }else if($num == 4 || $num == 6 || $num == 9 || $num == 11){
                    $all_day = 30;
                }else if($num==2){
                    $all_day=28+($year % 4 == 0 && $year % 100 || $year % 400 == 0);
                }
                $dta = 1;
            }
            if($subsidy_noon1 !=0 && $subsidy_noon2 !=0){
                $price +=15;
                $subsidy_noon1 = 0;
                $subsidy_noon2 = 0;                            
            }
            if($subsidy_dinner1 !=0 && $subsidy_dinner2 != 0){
                $price += 15;
                $subsidy_dinner1 = 0;
                $subsidy_dinner2 = 0;
            }
            if($xtime >= (60*60*4)){
                $price += 10;
                $utime1 = 0;
                $utime2 = 0;
            }
            $i +=$price;
        }
        $price = 0;
        continue;
    }
}
  
    } 
    
    return $i;
}

       
//获取信息条数函数
//======================================
// 函数: get_staff_info_total()
// 功能: 查询员工人数
// 参数: $staff_id            =''代表所有人
// 返回: 员工人数
//======================================
function get_staff_info_total($staff_id = ''){
    $db = new DB_WWW();

    $sql = "SELECT COUNT(staff_id) AS staff_total FROM staff_main";
    $sql .= " WHERE 1";
    if ($staff_id != '')
        $sql .= " AND staff_id = '{$staff_id}'";
    
    $total = $db->getField($sql, 'staff_total');
    if ($total)
        return $total;
    return 0;
}
//获取员工星座
//======================================
// 函数: get_star_sign_12($m, $d)
// 功能: 根据月，日取得12星座
// 参数: $m             月（2位数字，不足2位第一位补0）
// 参数: $d             日（2位数字，不足2位第一位补0）
// 返回: 对应的星座
// 返回: 错误的日月返回不明
//======================================
function get_star_sign_12($m, $d)
{
    $signs = array();
    $signs[] = array("01.20","02.18","水瓶座");
    $signs[] = array("02.19","03.20","双鱼座");
    $signs[] = array("03.21","04.19","白羊座");
    $signs[] = array("04.20","05.20","金牛座");
    $signs[] = array("05.21","06.21","双子座");
    $signs[] = array("06.22","07.22","巨蟹座");
    $signs[] = array("07.23","08.22","狮子座");
    $signs[] = array("08.23","09.22","处女座");
    $signs[] = array("09.23","10.23","天秤座");
    $signs[] = array("10.24","11.22","天蝎座");
    $signs[] = array("11.23","12.21","射手座");
    $signs[] = array("12.22","12.31","摩羯座");
    $signs[] = array("01.01","01.19","摩羯座");

    $md = "{$m}.{$d}";
    foreach ($signs as $sign) {
        if($md >= $sign[0] && $md <= $sign[1])
        return $sign[2];
    }
    
    return '不明';
}

//返回数据做成
$rtn_ary = array();
$rtn_ary['errcode'] = '0';
$rtn_ary['errmsg'] = '';
$rtn_ary['total']  = $total;
$rtn_ary['rows'] = $rows;
$rtn_str = json_encode($rtn_ary);
php_end($rtn_str);
?>