
return function($message) {
	global $accessArray;
	global $initiated;
	global $nick;
	
	$parameters = $message->getParameters();
	$where = $parameters[0];
    
    if ($where != $nick) return;
    
    $hostmask = $message->getNick() . "!" . $message->getName() . "@" . $message->getHost();
    if (!searchAccess($hostmask, $accessArray)) return;
	
	if ($parameters[1][0] != 'n') return;
    
    if (!$initiated) 
        return say("Please initiate a lecture to show slides.");
	
	global $channel;
	global $position;
	global $lecture;
			
	if (!empty($lecture[$position])) {
		talk($channel, $lecture[$position]);
		say("Played slide " . $position . ".");
		$position++;
	} else {
		say("Out of slides.");
	}
};
?>
