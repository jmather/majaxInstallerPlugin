<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/10/11
 * Time: 10:11 AM
 * To change this template use File | Settings | File Templates.
 */
 
class Majax_Installer {
  /**
   * @var \Majax_Installer_Configuration
   */
  private $configuration;


  private $output;

  public function __construct(Majax_Installer_Configuration $configuration = null, Majax_Installer_Output $output = null)
  {
    if ($configuration !== null)
    {
      $this->configuration = $configuration;
    } else {
      $this->configuration = new Majax_Installer_Configuration();
    }

    if ($output !== null)
    {
      $this->output = $output;
    } else {
      $this->output = new Majax_Installer_Output();
    }
  }

  public function loadXML($file)
  {
    $this->configuration->loadXMLFile($file);
  }

  public function loadXMLString($string)
  {
    $this->configuration->loadXMLString($string);
  }

  public function execute()
  {
    foreach ($this->configuration->getFiles() as $file)
    {
      /**
       * @var Majax_Installer_Configuration_File $file
       */
      $this->output->printLine($file->getSource());
    }
  }
}
