<?php

class m200901_030913_iol_type extends CDbMigration
{
	public function up()
	{
		$this->insert('ophinbiometry_lenstype_lens', array(
			'name'=> 'Rumex AquaFree Preloaded',
			'display_name' => 'Rumex AquaFree Preloaded'
		)

		);
	}

	public function down()
	{
		echo "m200901_030913_iol_type does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}