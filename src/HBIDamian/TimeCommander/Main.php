<?php

namespace HBIDamian\TimeCommander;

use pocketmine\console\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {
	protected Config $getCommandsConfig;

	public function onEnable(): void {
		$this->saveResource("commands.yml");
		$this->getCommandsConfig = new Config($this->getDataFolder() . "commands.yml", Config::YAML);
		$commandsConfig = $this->getCommandsConfig->getAll();
		foreach ($commandsConfig["Commands"] as $eachCMD) {
			$this->getScheduler()->scheduleRepeatingTask(new runCommand($this, $eachCMD["Command"]), $eachCMD["Time"]);
			// $eachCMD["Command"] calls the user inputted commands, and $eachCMD["Time"] is the user inputted times.
		}
	}

	public function executeCommand($command) {
		$this->getServer()->dispatchCommand(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), $command);
	}
}
