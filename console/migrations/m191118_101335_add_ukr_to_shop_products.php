<?php

use yii\db\Migration;

/**
 * Class m191118_101335_add_ukr_to_shop_products
 */
class m191118_101335_add_ukr_to_shop_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            '{{%shop_products}}',
            'name_uk',
            $this->string()->notNull()->after('name'));
        $this->addColumn(
            '{{%shop_products}}',
            'slug_uk',
            $this->string()->after('slug'));
        $this->addColumn(
            '{{%shop_products}}',
            'description_uk',
            $this->string()->notNull()->after('description'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_products}}', 'description_uk');
        $this->dropColumn('{{%shop_products}}', 'slug_uk');
        $this->dropColumn('{{%shop_products}}', 'title_uk');
    }
}
