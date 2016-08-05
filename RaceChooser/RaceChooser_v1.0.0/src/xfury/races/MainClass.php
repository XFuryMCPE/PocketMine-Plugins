<?php

namespace xfury\races;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;

class MainClass extends PluginBase{

	public $cmd;
	public $race = [];

	public function onEnable(){
		@mkdir($this->getDataFolder());
		$this->cmd = new Commands($this);
		$this->db = new \SQLite3($this->getDataFolder() . "Races.db");
		$this->db->exec("CREATE TABLE IF NOT EXISTS m (p TEXT PRIMARY KEY COLLATE NOCASE, r INT);");
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new RaceTask($this), 600);
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new EffectTask($this), 1);
	}
	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		$this->cmd->onCommand($sender, $command, $label, $args);
	}

	public function hasRace($playername){
		$p = strtolower($playername);
		$check = $this->db->query("SELECT * FROM m WHERE p='$p';");
		$array = $check->fetchArray(SQLITE3_ASSOC);
		if(empty($array)){
			return false;
		}
		return true;
	}

	public function getRace($playername){
		$p = strtolower($playername);
		$check = $this->db->query("SELECT * FROM m WHERE p='$p';");
		$array = $check->fetchArray(SQLITE3_ASSOC);
		return $array["r"];
	}

	public function setRace($playername, $type){
		$p = strtolower($playername);
		$prepare = $this->db->prepare("INSERT OR REPLACE INTO m (p, r) VALUES (:p, :r);");
		$prepare->bindValue(":p", $p);
		$prepare->bindValue(":r", $type);
		$prepare->execute();
	}
}