<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use PHPUnit\Framework\Constraint\Constraint;

class TblTransaksi extends Migration
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
			'bayar' => [
				'type' => "int",
				"constraint" => 7,
			],
			'kembalian' => [
				'type' => "int",
				"constraint" => 7,
			],
			'tagihan_id' => ['type' => 'int', 'constraint' => 5, 'unsigned' => true,],
			"created_at datetime default current_timestamp",
			"updated_at datetime default current_timestamp",
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('tagihan_id', 'tbl_tagihan', 'id', 'CASCADE', 'CASCADE');
		$this->forge->createTable('tbl_transaksi');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		if ($this->db->DBDriver != 'SQLite3') {
			$this->forge->dropForeignKey("tbl_transaksi", "tbl_transaksi_tagihan_id_foreign");
		}
		$this->forge->dropTable("tbl_transaksi", true);
	}
}
