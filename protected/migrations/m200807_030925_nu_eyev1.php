<?php

class m200807_030925_nu_eyev1 extends CDbMigration
{
	public function up()
	{

		$this->update('institution', array('active' => 0));
		$this->update('institution', array('remote_id' => "DEM1"), "id=1");
		$this->update('institution', array('remote_id' => "NEW","active"=>1), "id=181");
		$this->update('site', array("active"=>0));
		$this->update('site', array('name' => "NU Eye Clinic","active"=>1), "id=22794");

		$this->update('element_type', array('default' => 1), "id=449"); //Allergies	
		$this->update('element_type', array('default' => 0), "id=312"); //Rfraction
		$this->update('element_type', array('default' => 1), "id=355"); //Optics
		$this->update('element_type', array('default' => 1, 'required' => 0), "id=427"); //Location in Op Notes



	}

	public function down()
	{
		echo "m200807_030925_nu_eyev1 does not support migration down.\n";
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