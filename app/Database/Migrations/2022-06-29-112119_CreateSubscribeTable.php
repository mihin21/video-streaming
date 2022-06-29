<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubscribeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'subscribe_id' => [
                'type'            => 'INT',
                'constraint'      => '5',
                'unsigned'        => true,
                'auto_increment'  => true
            ],
            'post_id' =>[
                'type'            => 'INT',
            ],
            'user_id' =>[
                'type'            => 'INT',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('subscribe_id',true);
        $this->forge->createTable('subscribes');
    }

    public function down()
    {
        $this->forge->dropTable('subscribes');
    }
}
