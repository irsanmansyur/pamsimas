<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblTagihan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => "int",
				"constraint" => 5,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'user_id' => ['type' => 'int', 'constraint' => 5],
			"untuk_bulan_tahun datetime default current_timestamp",

			'mtr_lama' => [
				'type' => "int",
				"constraint" => 11,
			],
			'mtr_baru' => [
				'type' => "int",
				"constraint" => 11,
			],
			'volume' => [
				'type' => "int",
				"constraint" => 5,
			],
			'status' => ['type' => 'varchar', 'constraint' => 20],
			"created_at datetime default current_timestamp",
			"updated_at datetime default current_timestamp",
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
		$this->forge->createTable('tbl_tagihan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		if ($this->db->DBDriver != 'SQLite3') {
			$this->forge->dropForeignKey("tbl_tagihan", "tbl_tagihan_user_id_foreign");
		}
		$this->forge->dropTable("tbl_tagihan", true);
	}
}
