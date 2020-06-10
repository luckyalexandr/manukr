<?php

use yii\db\Migration;

/**
 * Class m191206_070605_add_translate_to_shop_tags
 */
class m191206_070605_add_translate_to_shop_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_tags}}', 'name_uk', $this->string()->after('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_tags}}', 'name_uk');
    }
}
