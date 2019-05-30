<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30.05.2019
 * Time: 10:58
 */

namespace app\models;


use yii\db\ActiveRecord;

/**
 * @property string name
 * @property int|string user_id
 */
class Room extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rooms';
    }

    public static function create($name)
    {
        $room = new Room();
        $room->name = $name;
        $room->user_id = \Yii::$app->user->id;
        $room->save();
    }

    public static function rooms()
    {
        $rooms = Room::find()->all();

        if ($rooms)
            return $rooms;

        return null;
    }

    public static function room($name)
    {
        $room = Room::findOne(['name'=>$name]);

        if ($room)
            return $room;

        return null;
    }
}