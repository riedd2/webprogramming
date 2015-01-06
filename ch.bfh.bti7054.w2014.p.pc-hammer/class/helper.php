<?php
class Helper {
    static function startsWith($searString, $target) {
    // search backwards starting from searchstring length characters from the end
    return $target === "" || strrpos($searString, $target, -strlen($searString)) !== FALSE;
	}
    
}
?>