<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/11/11
 * Time: 2:51 AM
 * To change this template use File | Settings | File Templates.
 */
 
class majaxInstallerOutput extends Majax_Installer_Output
{
  /**
   * @var sfEventDispatcher
   */
  private $dispatcher;

  public function __construct(sfEventDispatcher $dispatcher)
  {
    $this->dispatcher = $dispatcher;
  }

  public function printLine($output)
  {
    $this->dispatcher->notify(new sfEvent($this, 'command.log', array($output)));
  }
}
