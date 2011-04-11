<?php

class majaxInstallTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'majax';
    $this->name             = 'install';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [majax:install|INFO] task does things.
Call it with:

  [php symfony majax:install|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
    $config = new majaxInstallerConfigurationYAML();

    $default_config = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'installer.yml';
    if (!file_exists($default_config))
    {
      $this->log('No configuration found at config/installer.yml');
      return;
    }
    $config->loadYAMLFile($default_config);

    $output = new majaxInstallerOutput($this->dispatcher);

    $installer = new Majax_Installer($config, $output);
    $installer->execute();
  }
}
