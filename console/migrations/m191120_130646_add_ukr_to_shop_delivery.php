<?php

use yii\db\Migration;

/**
 * Class m191120_130646_add_ukr_to_shop_delivery
 */
class m191120_130646_add_ukr_to_shop_delivery extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_delivery_methods}}', 'name_uk', $this->string()->after('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_delivery_methods}}', 'name_uk');
    }
}
