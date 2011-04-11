<?php
require_once dirname(__FILE__).'/../../../../../test/phpunit/bootstrap/unit.php';

require_once dirname(__FILE__).'/../../../vendor/Majax/Installer/Configuration/Validator.php';

class unit_Majax_Installer_Configuration_ValidatorTest extends sfPHPUnitBaseTestCase
{
  /**
   * @var Majax_Installer_Configuration
   */
  private $config = null;

  public function setUp()
  {
    $this->validator = new Majax_Installer_Configuration_Validator();
  }

  public function testValidConfiguration()
  {
    $config = array(
      'Files' =>
      array(
        'File' =>
        array(
          'Path' => 'assets/databases.yml',
          'Destination' => 'config/databases.yml',
          'Tags' =>
          array(
            'Tag' =>
            array(
              'Hash' => '##USERNAME##',
              'Prompt' => 'Database Username',
              'Default' => 'db_user',
              'Required' =>
              array(
              ),
            ),
          ),
        ),
      ),
    );
    $this->assertEquals($this->validator->validate($config), true);
  }
}
