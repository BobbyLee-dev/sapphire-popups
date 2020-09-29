<?php 

class Sapphire_Popups_VerifyTest extends WP_UnitTestCase
{
		public function setUp() {
				parent::setUp();

				$this->class_instance = new Sapphire_Popups();
		}


		public function test_get_plugin_name()
		{
				$plugin_name = $this->class_instance->get_plugin_name();
				$expected = 'sapphire-popups';

				$this->assertEquals($expected, $plugin_name);
		}
}