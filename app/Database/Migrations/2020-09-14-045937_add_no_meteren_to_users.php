<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNoMeterenToUsers extends Migration
{
	public function up()
	{
		$this->forge->addColumn(
			"users",
			[
				'no_meteran' => [
					'type' => 'int',
					'constraint' => 6
				]
			]
		);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropColumn("users", "no_meteran");
	}
}
