<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>萬年曆</title>
    <style>
    .allbg{
        height:100vh;
        margin:auto;
        background-attachment:fixed;
        background: linear-gradient(#5599FF,#FFB7DD,#99FF99);
        background-size:400% 400%;
        
        animation-name:bg;
        animation-duration:5s;
        animation-iteration-count:infinite;
        animation-direction:alternate;
    }
    @keyframes bg {
            0%{
                background-position:0% 0% ;
            }
             25%{
                background-position:0% 50%;
             }
            50%{
                
            }
            100%{
                background-position:0% 100% ;
            }
    }
    table{
        border:5px;
        border-radius:30px;
        width:650px;
        height:580px;
        background-color:white;
        font-size:30px;
        margin:auto;
        box-sizing:border-box;
        position:relative;top:70px;left:5px;
    }
    .square{
        width:700px;
        height:720px;
        background-color:white;
        border-color:black;
        border-style:outset; 
        margin:auto;
        position:relative;top:100px;left:20px;
        border-radius:10%;
        box-shadow:2px 5px  7px 5px black; 
        background:#CCEEFF;
     
     
    }
    table tr:not(:first-child) td:nth-child(6n+1){
        opacity:0.5;  
        color:orange; 
    }
    td{
        width:80px;
        height:80px;
        box-sizing:border-box;
    }

    body{
        font-family: arial;
        text-align:center;
        font-weight:bolder;
        margin:0;
    }
    .a1{
        font-size:70px;
        margin:10px;
        position:absolute;top:30px;left:50px;
        color:	#191970;
        filter:drop-shadow(3px 0px 10px #F0F8FF);
       
    }
    .a2{
        width:300px;
        height:100px;
        font-size:50px;
        margin:auto;
        position:absolute;top:30px;left:70px;
        color:red;
        z-index:1;
        border-radius:80%;
        display: inline-block;
        
        
    }
    .a2::after {
            content: "";
            width: 0%;
            height: 3px;
            background: blue;
            display: block;
            transition: width 0.2s;
            position: absolute;
            right: 0;
        }

        .a2:hover::after {
            width: 100%;
        }
    .b1{
        
        display:block;
        font-size:20px;
        margin:auto;  
        position:relative;top:50px;left:180px;
        z-index:1;
        width: 280px;
            height: 40px;
            background:#87CEFA;
            color: white;
            text-align: center;
            line-height: 40px;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
    }
    .b1::after {
            content: "";
            position: absolute;
            width: 30px;
            height: 60px;
            background: white;
            filter: blur(2px);
            opacity: 0.25;
            /* 透明度 */
            top: -10px;
            left: -35px;
            transition: left 0.5s;
            transform: rotate(15deg);
        }

        .b1:hover::after {
            left: 150px;
        }

        .b1:active {
            background:#B0E0E6;
        }
    .box{
        background-color:red;
        border-radius:50%;
        color:white;
    }
    .A{
        color:#4169E1;
        font-size:30px;
      
    }
    .B{
        filter:drop-shadow(0px 0px px #F0F8FF);
        position:absolute;top:500px;left:500px;
        z-index:1;
    }
    </style>
</head>
<body>

<?php

if(!empty($_GET['month'])){
    $month=$_GET['month'];
}else{
    $month=date("m",time());     
}
if(!empty($_GET['year'])){
    $year=$_GET['year'];
}else{
    $year=date("Y",time());         
}
if(!empty($_GET['day'])){
    $day=$_GET['day'];
}else{
    $day=date("d",time());         
}



$today=date("Y-m-d");
$todayDays=date("d");
$start="$year-$month-01";
$startDay=date("w",strtotime($start));
$days=date("t",strtotime($start));
$endDay=date("w",strtotime("$year-$month-$days"));

if(($month-1)>0){
    $premonth=($month-1);
    $preyear=($year);
}else{
    $premonth=12;
    $preyear=($year-1);
}
if(($month+1)<=12){
    $nextmonth=($month+1);
    $nextyear=($year);
}else{
    $nextmonth=1;
    $nextyear=($year+1);
    
}
?>
<div class="allbg">
<?php echo "<div class='a1'>".date("Y-F",strtotime($start))."</div>";?>
<div class="square">
<div class="b1">
<a href="?month=<?=($premonth)?>&year=<?=($preyear)?>"style="text-decoration:none;">Last month</a>&nbsp;&nbsp;
<a href="?month=<?=($nextmonth)?>&year=<?=($nextyear)?>"style="text-decoration:none;">Next month</a>
</div>
<div>
<table>
    <tr class="A">
        <td>Sun</td>
        <td>Mon</td>
        <td>Tue</td>
        <td>Wed</td>
        <td>Thu</td>
        <td>Fri</td>
        <td>Sat</td>   
    </tr>
</div>
<?php
date_default_timezone_set("Asia/Taipei");
for($i=0;$i<6;$i++){
    echo "<tr>";
    for($j=0;$j<7;$j++){
        if(!empty($sd[$i*7+$j+1-$startDay])){ 
        $str=$sd[$i*7+$j+1-$startDay];
        }else{
            $str="";
        }
        if($i==0){
            if($j<$startDay){
                echo "<td></td>";
            }else{
                $d=date("Y-m-d",mktime(0,0,0,$month,($i*7+$j+1-$startDay),$year));
                if($d==$today){
                    echo "    <td class='box'>".($i*7+$j+1-$startDay).$str."</td>";
                }else{
                    echo "       <td>".($i*7+$j+1-$startDay).$str."</td>";
                }
            }
        }else{
            if(($i*7+$j+1-$startDay)<=$days){
                $d=date("Y-m-d",mktime(0,0,0,$month,($i*7+$j+1-$startDay),$year));
                if($d==$today){
                    echo " <td class='box'>".($i*7+$j+1-$startDay).$str."</td>"; 
                }else{
                echo "    <td>".($i*7+$j+1-$startDay).$str."</td>";
            }
        }else{
            echo " <td></td>";
            }
        }
    }
    echo "</tr>";
}
echo "<div class='a2'>".date("l-d",strtotime($today))."</div>";
?>
</div>
</div>
<img src="sticker.png" alt="" class="B">

</body>
</html>