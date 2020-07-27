<?php

namespace ReportPlayer;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;

class Report extends PluginBase {

	public $config;

	private $api;
	private $message;
	private $player;

	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		if (!file_exists($this->getDataFolder() . "Reports.yml")) {
			$this->saveResource("Reports.yml");
		}

		$this->config = new Config($this->getDataFolder() . 'Reports.yml', Config::YAML, array(
			"Reports" => array(),
		));

		$this->config->save();
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
		switch ($command->getName()) {
			case "report":
				$name = $issuer->username;
				$msg = implode(" ", $args);
				$this->config['Reports'][] = array($name, $msg);
				$output = "You have made a report";
				$this->api->plugin->writeYAML($this->api->plugin->configPath($this) ."Reports.yml", $this->config);
		}
		return $output;
	}

	public function __destruct() {

	}

}
