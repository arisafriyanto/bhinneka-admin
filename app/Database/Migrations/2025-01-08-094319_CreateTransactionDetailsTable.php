<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionDetailsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'transaction_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'product_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'quantity' => [
                'type' => 'INT',
            ],
            'price' => [
                'type' => 'INT',
            ],
            'subtotal_price' => [
                'type' => 'INT',
            ],
        ]);

        $this->forge->addKey(['transaction_id', 'product_id'], true);

        $this->forge->addForeignKey('transaction_id', 'transactions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'RESTRICT');

        $this->forge->createTable('transaction_details');
    }

    public function down()
    {
        $this->forge->dropForeignKey('transaction_details', 'transaction_details_product_id_foreign');
        $this->forge->dropForeignKey('transaction_details', 'transaction_details_transaction_id_foreign');

        $this->forge->dropTable('transaction_details');
    }
}
