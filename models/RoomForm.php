<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RoomForm extends Model
{
    public $name;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }
}
