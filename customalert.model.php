<?php
class customalertModel extends customalert
{
	function init()
	{
	}

	/**
	 * @return Object config object
	 * @notice this function saves config object to private value $config.
	 */
	function getConfig()
	{
		$oModuleModel = getModel('module');
		$config = $oModuleModel->getModuleConfig('customalert');

		return $config;
	}

	function getCustomalertGetColorsetList()
	{
		$skin = Context::get('skin');
		$oModuleModel = getModel('module');
		$skin_info = $oModuleModel->loadSkinInfo($this->module_path, $skin);
		for($i=0;$i<count($skin_info->colorset);$i++)
		{
			$colorset = sprintf('%s|@|%s', $skin_info->colorset[$i]->name, $skin_info->colorset[$i]->title);
			$colorset_list[] = $colorset;
		}
		if(count($colorset_list)) $colorsets = implode("\n", $colorset_list);

		
		if(count($skin_info->author) == 0) {
			$author = "Unknown";
		} else {
			for($i=0;$i<count($skin_info->author);$i++)
			{
				if(isset($skin_info->author[$i]->homepage) && $skin_info->author[$i]->homepage != "") {
					$author[] = sprintf('<a href="%s">%s</a>', $skin_info->author[$i]->homepage, $skin_info->author[$i]->name);
				} else {
					$author[] = sprintf('%s', $skin_info->author[$i]->name);
				}
				
				$author = implode(", ",$author);
			}
		}
		
		$this->add('colorset_list', $colorsets);
		$this->add('skin_info',$skin_info->title . "<br />제작자 : " . $author);
	}
}
