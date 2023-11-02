<?php
/**
 * 工具 - 查看接口参数规则
 */

$root = dirname(__FILE__);

require_once $root . '/../init.php';

//装载你的接口
DI()->loader->addDirs('Appapi');

$apiDesc = new PhalApi_Helper_ApiDesc();
$apiDesc->render();

