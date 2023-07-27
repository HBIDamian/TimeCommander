<?php
namespace HBIDamian\TimeCommander;
use pocketmine\scheduler\Task;

class runCommand extends Task {
    private string $command;
    private int $cmdStart;
    private Main $plugin;
    
    public function __construct(Main $plugin, $command){
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
