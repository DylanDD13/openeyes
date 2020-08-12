<?php

class m200811_181232_nu_examination extends CDbMigration
{
	public function up()
	{
		$this->insert('ophciexamination_element_set_item', array(
			'set_id' => 1,
			'element_type_id' => 449			
		));
		$this->insert('ophciexamination_element_set_item', array(
			'set_id' => 1,
			'element_type_id' => 355			
		));
		$this->delete('ophciexamination_element_set_item', 'element_type_id = 312');
	}

	public function down()
	{
		echo "m200811_181232_nu_examination does not support migration down.\n";
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