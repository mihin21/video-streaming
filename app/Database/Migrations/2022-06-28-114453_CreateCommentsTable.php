<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'comment_id' =>[
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' =>[
                'type'           => 'INT',
            ],
            'post_id' =>[
                'type'           => 'INT',
            ],
            'comment' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('comment_id', true);
        // $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->createTable('comments');
    }

    public function down()
    {
        $this->forge->dropTable('comments');
    }
}
