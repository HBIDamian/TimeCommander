<?php
namespace HBIDamian\TimeCommander;
use pocketmine\scheduler\Task;

class runCommand extends Task {
    
    private Main $plugin;

    public function __construct(Main $plugin, $command){
        //parent::__construct($plugin);
        $this->plugin = $plugin;
        $this->command = $command;
        $this->cmdStart = 0;
    }

    public function onRun(): void{
        if($this->cmdStart === 1){
            $this->getPlugin()->executeCommand($this->command);
        } else {
            $this->cmdStart = 1;
        }
    }

    public function getPlugin(){
        return $this->plugin;
    }
}
