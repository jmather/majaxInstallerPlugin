<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/11/11
 * Time: 2:07 AM
 * To change this template use File | Settings | File Templates.
 */
 
class majaxInstallerConfigurationYAML extends MajaxInstaller_Configuration
{
  public function loadYAMLFile($file)
  {
    $contents = file_get_contents($file);
    $this->loadYAMLString($contents);
  }

  public function loadYAMLString($string)
  {
    $yaml_parser = new sfYaml();
    $array = $yaml_parser->load($string);
    $xmlArray = $this->yamlArrayToXMLArray($array);
    $this->xmlArrayToConfiguration($xmlArray);
  }

  private function yamlArrayToXMLArray($array)
  {
    $ret = array();
    $ret['name'] = 'Installer';
    $ret['children'] = array();
    $ret['children'][0] = array('name' => 'Files', 'children' => array());
    foreach($array['files'] as $file_arr)
    {
      $f = array();
      $f['name'] = 'File';
      $f['attributes'] = array(
        'source' => $file_arr['source'],
        'destination' => $file_arr['destination'],
      );
      $f['children'] = array();
      $f['children'][0] = array('name' => 'Tags', 'children' => array());

      foreach($file_arr['tags'] as $tag_arr)
      {
        $t = array_merge($this->getDefaultTagArray(), $tag_arr);
        $tag = array('name' => 'Tag', 'attributes' => $t, 'children' => '');
        $f['children'][0]['children'][] = $tag;
      }
      $ret['children'][0]['children'][] = $f;
    }

    return $ret;
  }
}
