<?php

class m200727_201550_event_type_sort extends OEMigration
{
	public function up()
	{
		$this->addColumn('event_type', 'sort_order', 'int');
		$this->update('event_type', array('sort_order' => 99));
		$this->update('event_type', array('sort_order' => 1), "id=27");
		$this->update('event_type', array('sort_order' => 2), "id=40");
		$this->update('event_type', array('sort_order' => 3), "id=32");
		$this->update('event_type', array('sort_order' => 4), "id=4");
		$this->update('event_type', array('sort_order' => 5), "id=14");
		$this->update('event_type', array('sort_order' => 6), "id=37");
		$this->update('event_type', array('sort_order' => 6), "id=36");


	}

	public function down()
	{
		echo "m200727_201550_event_type_sort does not support migration down.\n";
		$this->dropColumn('event_type', 'sort_order');
		
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