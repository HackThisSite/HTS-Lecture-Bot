
return function ($message) {
	global $accessArray;
	global $initiated;
	global $nick;
	
	$parameters = $message->getParameters();
	$where = $parameters[0];
    
    if ($where != $nick) return;
    
    $hostmask = $message->getNick() . "!" . $message->getName() . "@" . $message->getHost();
    if (!searchAccess($hostmask, $accessArray)) return;
    
    if ($level = $accessArray[$search]['level'] != 2) return;
	
    list($msg) = explode(" ", $parameters[1]);
	if ($msg != 'reload_access') return;

	$config = parse_ini_file("config.ini", true);
				
	global $accessArray;
	
	$accessArray = $config['access'];
	
	say ("The access list has been refreshed!");
};
?>
