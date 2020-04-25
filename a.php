<?php
$conn = oci_connect('as406346', 'Wisielec3719', 'LABS');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
} else {
   print("Hello World");
}
 ?>
