<?php
namespace HBIDamian\TimeCommander;

use pocketmine\console\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {


    public function onEnable(): void{
        @mkdir($this->getDataFolder());
        $this->saveResource("commands.yml");
        $this->getCommandsConfig = new Config($this->getDataFolder() . "commands.yml", Config::YAML);
        $commandsConfig = $this->getCommandsConfig()->getAll();
        foreach ($commandsConfig["Commands"] as $var){
            $this->getScheduler()->scheduleRepeatingTask(new runCommand($this, $var["Command"]), $var["Time"]);
            # $var as I do not know what to call it...
            # $var["Command"] calls the user inputted commands, and  $var["Time"] is the user inputted times.
        }
    }

    public function executeCommand($command){
        $this->getServer()->dispatchCommand(new ConsoleCommandSender($this->getServer()::getInstance(), $this->getServer()::getInstance()->getLanguage()), $command);
    }

    public function getCommandsConfig(){
        return $this->getCommandsConfig;
    }
}