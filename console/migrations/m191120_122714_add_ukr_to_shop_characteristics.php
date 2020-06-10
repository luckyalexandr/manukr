<?php

use yii\db\Migration;

/**
 * Class m191120_122714_add_ukr_to_shop_characteristics
 */
class m191120_122714_add_ukr_to_shop_characteristics extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            '{{%shop_characteristics}}',
            'name_uk',
            $this->string()->notNull()->after('name'));
        $this->addColumn(
            '{{%shop_characteristics}}',
            'default_uk',
            $this->string()->after('default'));
        $this->addColumn(
            '{{%shop_characteristics}}',
            'variants_uk_json',
            $this->string()->notNull()->after('variants_json'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_characteristics}}', 'variants_uk_json');
        $this->dropColumn('{{%shop_characteristics}}', 'default_uk');
        $this->dropColumn('{{%shop_characteristics}}', 'name_uk');
    }
}
