//start the index page
<?php

/*testing variables: TODO delete later
 *
 */
$_SESSION['viewtype'] = 'admin';
$_SESSION['viewas'] = '1234';
$_SESSION['uid'] = '1234';

require_once("navbar.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Aliens Abducted Me - Report an Abduction</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Aliens Abducted Me - Report an Abduction</h2>

  <p>Share your story of alien abduction:</p>
  <form method="post" action="report.php">
    <label for="firstname">First name:</label>
    <input type="text" name="firstname" /><br />
    <label for="lastname">Last name:</label>
    <input type="text" name="lastname" /><br />
    <label for="email">What is your email address?</label>
    <input type="text" name="email" /><br />
    <label for="whenithappened">When did it happen?</label>
    <input type="text" name="whenithappened" /><br />
    <label for="howlong">How long were you gone?</label>
    <input type="text" name="howlong" /><br />
    <label for="howmany">How many did you see?</label>
    <input type="text" name="howmany" /><br />
    <label for="aliendescription">Describe them:</label>
    <input type="text" name="aliendescription" size="32" /><br />
    <label for="whattheydid">What did they do to you?</label>
    <input type="text" name="whattheydid" size="32" /><br />
    <label for="fangspotted">Have you seen my dog Fang?</label>
    Yes <input name="fangspotted" type="radio" value="yes" />
    No <input name="fangspotted" type="radio" value="no" /><br />
    <img src="fang.jpg" width="100" height="175"
      alt="My abducted dog Fang." /><br />
    <label for="other">Anything else you want to add?</label>
    <textarea name="other"></textarea><br />
    <input type="submit" value="Report Abduction" name="submit" /><br/><br/>
    <input type="submit" value="Who has seen Fang?" formaction="seen_fang.php"/>
  </form>
</body>
</html>

<body onload="navbar();">

</body>
