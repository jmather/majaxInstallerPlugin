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

    $base_path = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..').DIRECTORY_SEPARATOR.'vendor';

    $tFunc = function($class_name) use ($base_path)
    {
      $rel_path = str_replace('_', DIRECTORY_SEPARATOR, $class_name).'.php';
      $full_path = $base_path.DIRECTORY_SEPARATOR.$rel_path;
      if (file_exists($full_path))
      {
        require_once $full_path;
      }
    };

    spl_autoload_register($tFunc);
  }
}
