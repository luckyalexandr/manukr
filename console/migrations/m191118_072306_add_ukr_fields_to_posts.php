<?php

use yii\db\Migration;

/**
 * Class m191118_072306_add_ukr_fields_to_posts
 */
class m191118_072306_add_ukr_fields_to_posts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            '{{%blog_posts}}',
            'title_uk',
            $this->string()->notNull()->after('title'));
        $this->addColumn(
            '{{%blog_posts}}',
            'description_uk',
            $this->string()->notNull()->after('description'));
        $this->addColumn(
            '{{%blog_posts}}',
            'content_uk',
            $this->string()->after('content'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%blog_posts}}', 'content_uk');
        $this->dropColumn('{{%blog_posts}}', 'description_uk');
        $this->dropColumn('{{%blog_posts}}', 'title_uk');
    }
}
