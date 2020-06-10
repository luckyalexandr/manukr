<?php

use yii\db\Migration;

/**
 * Class m191206_094146_ukr_for_slideshow
 */
class m191206_094146_ukr_for_slideshow extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_main_banner}}', 'title_uk', $this->string()->after('title'));
        $this->addColumn('{{%shop_main_banner}}', 'text_uk', $this->string()->after('text'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_main_banner}}', 'text_uk');
        $this->dropColumn('{{%shop_main_banner}}', 'title_uk');
    }
}
