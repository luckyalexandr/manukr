<?php

use yii\db\Migration;

/**
 * Class m191103_193336_add_blog_category_multilanguage
 */
class m191103_193336_add_blog_category_multilanguage extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            '{{%blog_categories}}',
            'name_uk',
            $this->string()->notNull()->after('name'));
        $this->addColumn(
            '{{%blog_categories}}',
            'slug_uk',
            $this->string()->notNull()->after('slug'));
        $this->addColumn(
            '{{%blog_categories}}',
            'title_uk',
            $this->string()->after('title'));
        $this->addColumn(
            '{{%blog_categories}}',
            'description_uk',
            $this->text()->after('description'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%blog_categories}}', 'description_uk');
        $this->dropColumn('{{%blog_categories}}', 'title_uk');
        $this->dropColumn('{{%blog_categories}}', 'slug_uk');
        $this->dropColumn('{{%blog_categories}}', 'name_uk');
    }
}
