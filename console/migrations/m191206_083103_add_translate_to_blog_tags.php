<?php

use yii\db\Migration;

/**
 * Class m191206_083103_add_translate_to_blog_tags
 */
class m191206_083103_add_translate_to_blog_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%blog_tags}}', 'name_uk', $this->string()->after('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%blog_tags}}', 'name_uk');
    }
}
