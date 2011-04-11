<?php
require_once dirname(__FILE__).'/../../../../../test/phpunit/bootstrap/unit.php';

require_once dirname(__FILE__).'/../../../vendor/Majax/Installer/Configuration.php';
require_once dirname(__FILE__).'/../../../vendor/Majax/Installer/Configuration/File.php';
require_once dirname(__FILE__).'/../../../vendor/Majax/Installer/Configuration/File/Tag.php';

class unit_Majax_Installer_ConfigurationTest extends sfPHPUnitBaseTestCase
{
  /**
   * @var Majax_Installer_Configuration
   */
  private $config = null;

  public function setUp()
  {
    $this->config = new Majax_Installer_Configuration();
  }

  public function testConfigurationLoadingFromXMLString()
  {
    $xml = <<<FILE
<Installer>
  <Files>
    <File source="assets/databases.yml" destination="config/databases.yml">
      <Tags>
        <Tag type="string" hash="##USERNAME##" prompt="Database Username" default="db_user" required="true" />
      </Tags>
    </File>
  </Files>
</Installer>
FILE;

    $conf = array(
      new Majax_Installer_Configuration_File('assets/databases.yml', 'config/databases.yml', array(
          new Majax_Installer_Configuration_File_Tag('string', '##USERNAME##', 'Database Username', 'db_user', true)
        )
      )
    );
    $this->config->loadXMLString($xml);
    $this->assertEquals($this->config->getFiles(), $conf);
  }
}
