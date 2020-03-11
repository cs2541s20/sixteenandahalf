
<?php

/*testing variables: TODO delete later
 *
 */
$_SESSION['viewtype'] = 'admin';
$_SESSION['viewas'] = '1234';
$_SESSION['uid'] = '1234';

require_once("navbar.php");
?>
<html>
<H4>My Grades</H4>
<table style="width:50%">
  <tr>
    <th>CRN</th>
    <th>Class</th>
    <th>Grade</th>
  </tr>
  <tr>
    <td>345789</td>
    <td>Chemistry</td>
    <td>50</td>
  </tr>
  <tr>
    <td>237891</td>
    <td>Biology</td>
    <td>76</td>
  </tr>
    <tr>
    <td>452111</td>
    <td>University Writingn</td>
    <td>94</td>
  </tr>
      <tr>
    <td>278692</td>
    <td>Calculus</td>
    <td>82</td>
  </tr>

</table>
</html>


<body onload="navbar();">

</body>
