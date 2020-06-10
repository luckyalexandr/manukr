<?php

use yii\db\Migration;

/**
 * Class m191113_132653_add_ukr_fields_to_pages
 */
class m191113_132653_add_ukr_fields_to_pages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            '{{%pages}}',
            'title_uk',
            $this->string()->notNull()->after('title'));
        $this->addColumn(
            '{{%pages}}',
            'slug_uk',
            $this->string()->notNull()->after('slug'));
        $this->addColumn(
            '{{%pages}}',
            'content_uk',
            $this->string()->after('content'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%pages}}', 'content_uk');
        $this->dropColumn('{{%pages}}', 'slug_uk');
        $this->dropColumn('{{%pages}}', 'title_uk');
    }
}
