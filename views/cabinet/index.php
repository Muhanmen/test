<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.05.2019
 * Time: 16:49
 */

use yii\helpers\Html;

?>

<?php if (Yii::$app->session->hasFlash('Denied')): ?>

    <div class="alert alert-danger">
        Access denied
    </div>
<?php endif; ?>

<div class="col-lg-8">
    <div class="list-group-horizontal">
        <?php if($rooms)
            foreach ($rooms as $room)
            {
                echo '<a href="/cabinet/room/?name=' . Html::encode($room->name) . '" class="list-group-item">' . $room->name . '</a>';
            }
            ?>
    </div>
</div>




<div class="col-lg-4">
    <div style="background: rebeccapurple">
        <div class="list-group">
            <a href="/cabinet/profile" class="list-group-item">Профиль</a>
            <?php
             if (\Yii::$app->user->can('viewRoom')) {
                echo '<a href="/cabinet/create-room" class="list-group-item">Создать Рум</a>';
             }
            ?>

        </div>
    </div>
</div>


