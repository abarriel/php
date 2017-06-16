<?php
function auth($login, $passwd)
{
	$file = "private/passwd";
	$passwdhashed = hash('sha224', $passwd);
	$user = unserialize(file_get_contents($file));
		foreach ($user as $key => $value) {
			switch ($value['login']) {
				case $login;
					{
						if ($passwdhashed != $value['passwd'])
							return (FALSE);
						else
							return (TRUE);
					}
					break;
			}
		}
	return(FALSE);
}
function search_type($login)
{
	$file = "private/passwd";
   $user = unserialize(file_get_contents($file));
    foreach ($user as $key => $value) {
      switch ($value['login']) {
        case $login;
          	 return ($value['type']);
         break;
        }
    }
  }   
function search_passwd($login)
{
	$file = "private/passwd";
   $user = unserialize(file_get_contents($file));
    foreach ($user as $key => $value) {
      switch ($value['login']) {
        case $login;
          	 return ($value['passwd']);
         break;
        }
    }
  }       
?>