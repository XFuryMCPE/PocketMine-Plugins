<?php

namespace KitCore\commands;

use KitCore\MainClass;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;

use pocketmine\utils\TextFormat;

class TestCmd extends Command implements PluginIdentifiableCommand{

	public function __construct(MainClass $plugin,$name,$description){
		$this->plugin = $plugin;
		parent::__construct($name,$description);
		$this->setPermission("kc.default");
	}

	public function execute(CommandSender $sender, $label, array $args){
		if(!$this->testPermission($sender)){
			return false;
		}
		$sender->sendMessage("Worked");
	}

	public function getPlugin(){
		return $this->plugin;
	}
}