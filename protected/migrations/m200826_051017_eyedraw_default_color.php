<?php

class m200826_051017_eyedraw_default_color extends CDbMigration
{
	public function up()
	{
		$this->update('eyedraw_doodle', array('init_doodle_json' => '{"scaleLevel": 1,"version":1.1,"subclass":"AntSeg","pupilSize":"Large","apexY":-260,"rotation":0,"pxe":false,"colour":"Brown","coloboma":false,"ectropion":false,"cornealSize":"Not Checked","cells":"Not Checked","flare":"Not Checked","order":1}'), "eyedraw_class_mnemonic='AntSeg'");
		
	}

	public function down()
	{
		echo "m200826_051017_eyedraw_default_color does not support migration down.\n";
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