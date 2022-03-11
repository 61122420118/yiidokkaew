<?php
use backend\assets\DashboardAsset;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use scotthuangzl\googlechart\GoogleChart;
use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;

use deyraka\materialdashboard\widgets\CardStats;
use deyraka\materialdashboard\widgets\CardProduct;
use deyraka\materialdashboard\widgets\CardChart;
use deyraka\materialdashboard\widgets\Card;
use deyraka\materialdashboard\widgets\Progress;
use yii\helpers\Url;
/* @var $this yii\web\View */
$url = Yii::getAlias("@web") . '/img/';
$this->title = 'Dok Kaew Garden';
DashboardAsset::register($this);
?>


<div class="row">

    <div class="panel panel-primary" style="text-align:center;">
  <div class="panel-body">
      
  <h2>Dok Kaew Garden</h2>
  </div>
  <div class="panel-footer"><h4>บ้านดอกแก้ว</h4></div>
</div>
<div class="row">
<div class="col-lg-3 col-md-4 col-sm-4" style="text-align:center;">
                <?=


                CardStats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,

                        "headerIcon" =>  '<span class="fa fa-hotel" style="font-size:28px"></span>',
                        "title" => "Total Admit",
                        "subtitle" => $modelprofile->total ." people",
                        'color' => Progress::COLOR_SUCCESS,
                        "footerIcon" => '',
                        //"footerText" => '<button type="button" class="btn btn-default btn-sm">
                        //<span class="glyphicon glyphicon-folder-open"></span> Folder
                        //</button>',
                        "footerUrl" => Url::to(['profile/index']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-4" style="text-align:center;">
                <?=

                
                CardStats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,

                        "headerIcon" =>  '<span class="fa fa-calendar-times-o" style="font-size:28px"></span>',
                        "title" => "Total Discharge",
                        "subtitle" => $modelprofile->totalDis ." people",
                        'color' => Progress::COLOR_WARNING,
                        "footerIcon" => '',
                        //"footerText" => '<button type="button" class="btn btn-default btn-sm">
                        //<span class="glyphicon glyphicon-folder-open"></span> Folder
                        //</button>',
                        "footerUrl" => Url::to(['profile/index']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4" style="text-align:center;">
                <?=


                CardStats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,

                        "headerIcon" =>  '<span class="fa fa-user-md" style="font-size:28px"></span>',
                        "title" => "Admit this mount",
                        "subtitle" => $modelprofile->totalAdmit ." people",
                        "footerIcon" => '',
                        "footerText" => '',
                        'color' => Progress::COLOR_INFO,
                        "footerUrl" => Url::to(['profile/index']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4" style="text-align:center;">
                <?=
                /* =======================================================
                    Example of using CardStats Widget
                    'title', and 'subtitle' MUST BE INITIALIZE Parameter.
                    'color', 'headerIcon', 'footerIcon', 'footerText', 'footerUrl', and 'footerTextType' are optional.
                    'headerIcon' has default value 'weekend'. 'footerIcon' has default value 'send'. See https://material.io/resources/icons/?style=baseline for further reference.
                    'color' has a const value. Default is COLOR::INFO (another options are COLOR::ROSE, DANGER, WARNING, PRIMARY, SUCCESS).
                    'footerUrl' has default value '#'. Use Yii::to([]) to route the link. 
                    'footerTextType' has a const value. Default is TYPE::INFO (another option are TYPE::MUTED, SUCCESS, DANGER, PRIMARY, and WARNING).
                ==========================================================
                */

                CardStats::widget(
                    [
                        "color" => Cardstats::COLOR_PRIMARY,
                        
                        "headerIcon" =>  '<span class="glyphicon glyphicon-minus" style="font-size:28px"></span>',
                        "title" => "Discharge this mount",
                        "subtitle" => $modelprofile->totalDischarge ." people",
                        'color' => Progress::COLOR_DANGER,
                        "footerIcon" => '',
                        //"footerText" => '<button type="button" class="btn btn-default btn-sm">
                        //<span class="glyphicon glyphicon-folder-open"></span> Folder
                        //</button>',
                        "footerUrl" => Url::to(['admit/index']),
                        "footerTextType" => Cardstats::TYPE_INFO,
                    ]
                )
                ?>
            </div>

            
            </div>

<?= ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 100,
        'width' => 400
    ],
    'data' => [
        'labels' => ["January","February", "March", "April", "May","June", "July", "August ", "September", "October", "November", "December"],
        'datasets' => [
            [
                'label' => "Admit / mount",
                'backgroundColor' => "rgba(217,237,246,0.2)",
                'borderColor' => "rgba(217,237,246,200)",
                'pointBackgroundColor' => "rgba(217,237,246,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(217,237,246,1)",
                'data' => [$modelprofile->jan,$modelprofile->feb,$modelprofile->mar,$modelprofile->apr
                ,$modelprofile->may,$modelprofile->june,$modelprofile->july,$modelprofile->aug,$modelprofile->sep,$modelprofile->oct
                ,$modelprofile->nov,$modelprofile->dec]
            ],
            [
                'label' => "Discharge / mount",
                'backgroundColor' => "rgba(255,99,132,0.2)",
                'borderColor' => "rgba(255,99,132,1)",
                'pointBackgroundColor' => "rgba(242,222,223,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(242,222,223,1)",
                'data' => [$modelprofile->DisJan,$modelprofile->DisFeb,$modelprofile->DisMar,$modelprofile->DisApr
                ,$modelprofile->DisMay,$modelprofile->DisJune,$modelprofile->DisJuly,$modelprofile->DisAug,$modelprofile->DisSep,$modelprofile->DisOct
                ,$modelprofile->DisNov,$modelprofile->DisDec]
            ],
            

        ]
    ]
]);
?>


</div>


</div>


