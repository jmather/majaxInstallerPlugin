<?php
require_once dirname(__FILE__).'/../../../../../test/phpunit/bootstrap/unit.php';

require_once dirname(__FILE__).'/../bootstrap/MajaxInstaller.php';

class unit_MajaxInstaller_ConfigurationTest extends sfPHPUnitBaseTestCase
{
  /**
   * @var MajaxInstaller_Configuration
   */
  private $config = null;

  public function setUp()
  {
    $this->config = new MajaxInstaller_Configuration();
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
      new MajaxInstaller_Configuration_File('assets/databases.yml', 'config/databases.yml', array(
          new MajaxInstaller_Configuration_Tag('string', '##USERNAME##', 'Database Username', 'db_user', true)
        )
      )
    );
    $this->config->loadXMLString($xml);
    $this->assertEquals($this->config->getFiles(), $conf);
  }
}
