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
					$author[] = sprintf('<a href="%s">%s</a>', htmlspecialchars($skin_info->author[$i]->homepage, ENT_COMPAT | ENT_HTML401, 'UTF-8', false), htmlspecialchars($skin_info->author[$i]->name, ENT_COMPAT | ENT_HTML401, 'UTF-8', false));
				} else {
					$author[] = sprintf('%s', htmlspecialchars($skin_info->author[$i]->name, ENT_COMPAT | ENT_HTML401, 'UTF-8', false));
				}
				
				$author = implode(", ",$author);
			}
		}
		
		$this->add('colorset_list', $colorsets);
		$this->add('skin_info',htmlspecialchars($skin_info->description, ENT_COMPAT | ENT_HTML401, 'UTF-8', false) . "<br />By  " . $author);
	}
}
