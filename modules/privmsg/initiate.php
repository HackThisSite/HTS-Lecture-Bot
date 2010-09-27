
return function($message) {
	global $accessArray;
	global $initiated;
	global $nick;
	
	$parameters = $message->getParameters();
	$where = $parameters[0];

	$raw = $message->getRaw();
	$hostmask = substr($raw, 1, strpos($raw, " ") - 1);
	
	$search = searchAccess($hostmask, $accessArray);
	
	$text = trim($parameters[1]);		
				
	if ($where == $nick && $search !== FALSE && $text == "i") {

		if ($initiated == FALSE) {
			global $mode;
			global $position;
			global $channel;
			global $intro;
			global $rules;
			
			$initiated = TRUE;
			$mode = "l";
			$position = 0;
			
			cmd_send("MODE " . $channel . " +m");
			talk($channel, $intro . "\n" . $rules);
			say("The lecture has been initiated.");
		} else {
			say("The lecture has already been initiated.");
		}
	}
}
?>