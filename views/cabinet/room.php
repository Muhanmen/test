<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];

?>

<div class="col-lg-8">
    <h2><?= $model->name ?> </h2>
    <canvas id ='canvas' class="view"></canvas>
</div>

<script>
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var painting = false;
    canvas.width = 500;
    canvas.height = 500;

    var socket = new WebSocket('ws://localhost:8080/chat');
    var x,y;
    var data ={x,y};

    socket.onopen = ()=>{
        console.log('Connected');
    };

    socket.onerror = ()=>{
        console.log('Error');
    };

    socket.onmessage = (e)=>{

        data = JSON.parse(e.data);

        context.fillStyle = 'green';
        context.beginPath();
        context.arc(data.x,data.y,5,0,5);
        context.fill();
    };

    canvas.onmousedown = (e)=>{
        painting = true;
    };

    canvas.onmouseup = (e)=>{
        painting = false;
    };

    canvas.onmousemove = (e)=>{
        if(painting){
            x = e.layerX;
            y = e.layerY;

            console.log(x+', '+y);
            data.x = x;
            data.y = y;

            console.log(JSON.stringify(data));
            socket.send(JSON.stringify(data));

            context.fillStyle = 'green';
            context.beginPath();
            context.arc(x,y,5,0,5);
            context.fill();
        }

        // if (canvas.width === x)
        //     painting=false;
        // console.log(x);

    };


</script>
