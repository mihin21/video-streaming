<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUploadTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'upload_id' =>[
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' =>[
                'type'           => 'INT',
            ],
            'video' => [
                'type'           => 'VARCHAR',
                'constraint'     => '225',
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('upload_id', true);
        
        $this->forge->createTable('uploads');
    }

    public function down()
    {
        $this->forge->dropTable('uploads');
    }
}
