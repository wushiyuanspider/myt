<!DOCTYPE HTML public>
<?php
require('../include.php');
$sql = "select * from em_slide";
$res = getAll($sql);
// p($res);
// die;
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" rel="stylesheet" href="css/as.css" />
<script src="./js/jquery"></script>
<style type="text/css">
.action-span {
    float: right;
    padding-left: 10px;
}
.action-span a {
    color: #666;
    font-size: 12px;
    font-weight: 400;
    text-decoration: none;
    display: block;
    padding: 2px 5px 2px 23px;
    border-width: 1px 2px 2px 1px;
    border-style: solid;
    border-color: #278296;
    -moz-border-top-colors: none;
    -moz-border-right-colors: none;
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    border-image: none;
    background: url("images/icon_add.gif") no-repeat scroll 3px center #DDEEF2;
}
</style>
</head>
<body>
<div class="main">
    <table cellpadding="0" cellspacing="0" class="ti">
        <tr>
            <th class="title" colspan="8">
                <form method="get" action="main.php">
                    用户名：
                    <input type="text" name="u_name" value="" style="width:120px;" />
                    所属代理商：
                    <input type="text" name="a_name" value="" style="width:120px;" />
                    <input type="hidden" name="exp" id="exp" value="0" />
                    <input type="hidden" name="act" id="act" value="user_list" />
                    <input type="submit" value="查询" onclick="document.getElementById('exp').value='0';" />
                    <input type="submit" value="导出" onclick="document.getElementById('exp').value='1';" />
                </form>
                <span class="action-span"><a href="edite_ppt.php">添加幻灯片</a></span>
            </th>
            
           <!--  <th colspan="1" style="color:#fff;border-bottom:none;"><a href="{:U('Admin/Index/Add_User')}" style="color:#fff;margin-left:25px;">添加用户</a></th> -->
        </tr>
        <tr>
            <th>幻灯片ID</th>
            <th>幻灯片名称</th>
            <th>幻灯片分类</th>
            <th>幻灯片图片</th>
            <th>是否显示</th>
            <th>幻灯片简介</th>
            <th>幻灯片内容</th>
            <th>操作</th>
    </tr>
    <?php if(!empty($res)) {?>
        <?php foreach($res as $val) {?>
                  <tr>
                 <td><?php echo $val['sd_id']?></td>
                 <td><?php echo $val['sd_name']?></td>
                 <td><?php echo $val['sd_cate']?></td>
                 <td><img style="width: 50px; height: 50px" src="<?php echo 'upload/'.$val['sd_img']?>"></td>
                <!--是否显示-->
                 <?php if($val['sd_show'] == 1) {?>
                    <td class="sd_show"><img src="images/no.gif"/></td>
                <?php }?>
                <?php if($val['sd_show'] == 0) {?>
                    <td class="sd_show"><img src="images/yes.gif"/></td>
                <?php }?>   
                 <td><?php echo $val['sd_description']?></td>
                 <td><?php echo $val['sd_content']?></td>
                     <td height="30px" align="center" valign="middle">
                     <a href="">分配权限</a>　
                 <span style="margin-left:10px;"><a href="edite_ppt.php?sdid=<?php echo $val['sd_id']?>" id="mod">修改</a></span>
                 <span style="margin-left:20px;"><a href="action.php?act=delPpt&sdid=<?php echo $val['sd_id']?>">删除</a></span>
                     </td>
             </tr>
          <?php }?>
    <?php }?>
    <script>
        $(function() {
            $("#mod").click(function() {
                alert('sucess');
            })
        })
    </script>
        <tr><td  colspan="9" align="center">暂无查询结果</td></tr>
        <!-- {v:/if} -->

        <tr><td  colspan="2" class="left"></td>
        <td  colspan="7" class="right">
        <span class="technorati" style="height:21px;">      
        </span>
        </td></tr>
    </table>
</div>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jeditable.js"></script>
<script type="text/javascript" src="js/jquery.ld.js"></script>
<script type="text/javascript">
//是否显示
$(".art_open").click(function(){
    var v = ($("img", $(this)).attr("src").match(/yes.gif/i))? 1 : 0;
     if(v==0){
        $("img", $(this)).attr("src", "./images/yes.gif");
    }else{
         $("img", $(this)).attr("src", "./images/no.gif");
    }
    var artid = $.trim($(this).parent().children().eq(0).text()); 
    $.getJSON("action.php?act=art_show",{num:v,id:artid},function(json){
         //alert(json);return false;
                if(json==1){
                    //alert("修改成功！"); 
                }else{
                    alert("修改失败！"); 
                    return;  
                }       
            });
});
$(document).ready(function(){

    $("#search_form").submit(function(){
            if (Date.parse($('#s_time').val().replace("-","/"))>Date.parse($('#e_time').val().replace("-","/")))
            {
                alert("开始日期应小于结束日期！");
                return false;
            }
    });
    
    $(".ti tr").mouseover(function(){ //如果鼠标移到class为ti的表格的tr上时，执行函数
        $(this).addClass("over");}).mouseout(function(){ //给这行添加class值为over，并且当鼠标一出该行时执行函数
        $(this).removeClass("over");}) //移除该行的class
    $(".ti  tr:odd").addClass("alt"); //给class为ti的表格的奇数行添加class值为alt
});
</script>
</body>
</html>
