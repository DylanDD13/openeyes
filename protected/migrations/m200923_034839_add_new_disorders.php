<?php

class m200923_034839_add_new_disorders extends CDbMigration
{
	public function up()
	{

		$this->insert('disorder', array(
			'fully_specified_name'=> 'Mild Non-Proliferative Diabetic Retinopathy',
			'term' => 'Mild Non-Proliferative Diabetic Retinopathy',
			'specialty_id' => 109
		)

		);

		$this->insert('disorder', array(
			'fully_specified_name'=> 'Moderate Non-Proliferative Diabetic Retinopathy',
			'term' => 'Moderate Non-Proliferative Diabetic Retinopathy',
			'specialty_id' => 109
		)

		);

		$this->insert('disorder', array(
			'fully_specified_name'=> 'Severe Non-Proliferative Diabetic Retinopathy',
			'term' => 'Severe Non-Proliferative Diabetic Retinopathy',
			'specialty_id' => 109
		)

		);




		$this->insert('common_ophthalmic_disorders', array(
			'disorder_id'=> 162290004,
			'subspecialty_id' => 12,
			'display_order' => 8
		)

		);

		$this->insert('common_ophthalmic_disorders', array(
			'disorder_id'=> 77489003,
			'subspecialty_id' => 12,
			'display_order' => 8
		)

		);

		$this->insert('common_ophthalmic_disorders', array(
			'disorder_id'=> 103,
			'subspecialty_id' => 12,
			'display_order' => 8
		)

		);
	}

	public function down()
	{
		echo "m200923_034839_add_new_disorders does not support migration down.\n";
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