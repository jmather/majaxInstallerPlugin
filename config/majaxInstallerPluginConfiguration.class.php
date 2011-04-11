<?php

/**
 * majaxInstallerPlugin configuration.
 *
 * @package     majaxInstallerPlugin
 * @subpackage  config
 * @author      Jacob Mather
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class majaxInstallerPluginConfiguration extends sfPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    parent::initialize();

    $base_path = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..').DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'MajaxInstaller';

    require_once($base_path.DIRECTORY_SEPARATOR.'MajaxInstaller.php');
    MajaxInstaller::autoload();
  }
}
