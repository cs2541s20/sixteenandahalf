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

<body onload="navbar();">

<html>
<table style="width:100%">
  <tr>
    <th>CRN</th>
    <th>Class</th>
    <th>Day<th>
    <th>Time<th>
    <th>Location<th>
    <th>Section<th>
  </tr>
  <tr>
    <td>444444</td>
    <td>Computer Architecture</td>
    <td>MW</td>
    <td>12:30<td>
    <td>3<td>
    
  </tr>
  <tr>
    <td>555555</td>
    <td>Software</td>
    <td>TR</td>
    <td>1:30<td>
    <td>1<td>
  </tr>
</table>
</html>





</body>
