<?php

use yii\db\Migration;

/**
 * Class m191103_183013_add_category_multilanguage
 */
class m191103_183013_add_category_multilanguage extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            '{{%shop_categories}}',
            'name_uk',
            $this->string()->notNull()->after('name'));
        $this->addColumn(
            '{{%shop_categories}}',
            'slug_uk',
            $this->string()->notNull()->after('slug'));
        $this->addColumn(
            '{{%shop_categories}}',
            'title_uk',
            $this->string()->after('title'));
        $this->addColumn(
            '{{%shop_categories}}',
            'description_uk',
            $this->text()->after('description'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_categories}}', 'description_uk');
        $this->dropColumn('{{%shop_categories}}', 'title_uk');
        $this->dropColumn('{{%shop_categories}}', 'slug_uk');
        $this->dropColumn('{{%shop_categories}}', 'name_uk');
    }
}
