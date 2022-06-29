<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLikesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'like_id' => [
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
        $this->forge->addKey('like_id',true);
        $this->forge->createTable('likes');
    }

    public function down()
    {
        $this->forge->dropTable('likes');
    }
}
