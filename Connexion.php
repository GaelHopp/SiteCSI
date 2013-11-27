 <?php

echo 'This text is placed through <b>PHP</b>!';
echo '<p>';
echo '</p>';

$conn = odbc_connect('Base CSI', 'M1_circuituser_02', 'M1_circuituser_02') or die('Could not connect !');
echo 'Connected successfully';

odbc_close($conn);

?>
