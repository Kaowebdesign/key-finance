<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "income".
 *
 * @property int $sum
 * @property string $data
 * @property int $user_id
 * @property string $title
 * @property int $category_id_inc
 *
 * @property User $user
 * @property CategoryIncome $categoryIdInc
 */
class Income extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $allIncomeSum = 0;
    public $sumCategory;

    public static function tableName()
    {
        return 'income';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sum', 'data', 'user_id', 'title', 'category_id_inc'], 'required'],
            [['sum', 'user_id', 'category_id_inc'], 'integer'],
            [['data'], 'safe'],
            [['title'], 'string', 'max' => 250],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['category_id_inc'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryIncome::className(), 'targetAttribute' => ['category_id_inc' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sum' => 'Sum',
            'data' => 'Data',
            'user_id' => 'User ID',
            'title' => 'Title',
            'category_id_inc' => 'Category Id Inc',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[CategoryIdInc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryIncome()
    {
        return $this->hasOne(CategoryIncome::className(), ['id' => 'category_id_inc']);
    }

    public function getSumOfCategory()
    {
        return Income::find()
                ->select(['SUM(sum)','category_id_inc','name'])
                ->leftJoin('category_income','`category_income`.`id` = `income`.`category_id_inc`')
                ->with('categoryIncome')->groupBy('category_id_inc')
                ->asArray()
                ->all();
    }

    public function saveIncome()
    {
        $this->user_id=Yii::$app->user->id;
        return $this->save();
    }

    public function getAllIncomeSum()
    {
       return $this->allIncomeSum = Income::find()->sum('sum');
    }
}
