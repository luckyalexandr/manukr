<?php

use yii\db\Migration;

/**
 * Class m190131_001827_add_shop_product_status_field
 */
class m190131_001827_add_shop_product_status_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'status', $this->smallInteger()->notNull());
        $this->update('{{%shop_products}}', ['status' => 1]);
    }

    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'status');
    }
}
