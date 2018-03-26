<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AttendanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Attendances');
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    #notice-tpl {
        display: none;
    }
    #notice-container {
        position: absolute;
        height: 300px;
        background: gray;
        width: 80%;
        opacity: 0.5;
        filter: alpha(opacity=40);
        overflow: hidden;
        z-index: 2;
    }
    #notice-container:hover {
        opacity: 1;
        filter: alpha(opacity=100);
    }

</style>
<div id="notice-tpl" >
    <div class="col-lg-3 col-xs-6 attendance-tpl">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>53<sup style="font-size: 20px">%</sup></h3>
          <p>Bounce Rate</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6 guests-tpl">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>44</h3>
          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
</div>
<!-- notice container -->
<div id='notice-container' class="row" style="display: none;" enable='1'>
</div>

<div class="attendance-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('common', 'Create Attendance'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'aid',
            'uid',
            'type',
            'date',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<script>
$(document).ready(function(){
    var stime = 0;
    var aid = 0;
    var gid = 0;

    //监听鼠标
    $("#notice-container").bind('mouseenter', function(event) {
        // console.log('over');
        $(this).attr({
            enable: 0,
        });
    });
    $("#notice-container").bind('mouseleave', function(event) {
        console.log('out');
        $(this).attr({
            enable: 1,
        });
    });
    //定时访问
    setInterval(function(){
        if ($("#notice-container").attr('enable') == 1) {
             getNotice();
        }
    }, 5000);

    function getNotice() {
        console.log(stime);
        $.ajax({
            url: '/attendance/notice',
            type: 'GET',
            dataType: 'json',
            data: {
                time: stime,
                aid: aid,
                gid: gid,
            },
        })
        .done(function(res) {
            console.log(res.guests.length, "success");
            if (res.code == 200) {
                $("#notice-container").html('');
                $("#notice-container").show();
                if (res.data != undefined && res.data.length > 0) {
                    noticeAttendance(res.data);
                }

                if (res.guests != undefined && res.guests.length > 0) {
                    noticeGuests(res.guests);
                }
                setTimeout(function(){ 
                    if($("#notice-container").attr('enable') == 1){
                        $("#notice-container").hide();
                    }
                },3000);
            } else {
                console.log('isEmpty');
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }

    //签掉提示
    function noticeAttendance(data) {
            // console.log(1111);

        var template = $("#notice-tpl").find('.attendance-tpl').clone();
        var container = $("#notice-container");
        for (var i = data.length - 1; i >= 0; i--) {
            console.log(i);
            container.append(template.clone());
        }
        
    }

    //访客提示
    function noticeGuests(data) {
            // console.log(222);
        var template = $("#notice-tpl").find('.guests-tpl').clone();
        var container = $("#notice-container");
        for (var i = data.length - 1; i >= 0; i--) {
            container.append(template.clone());
        }
    }

});

    
</script>
