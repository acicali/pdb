<?php

$connection = pg_connect("host=localhost user=postgres password=okcomp")
    or die('Could not connect: ' . pg_last_error());

$results = pg_query($connection, 'SELECT datname FROM pg_database
WHERE datistemplate = false');

while($row = pg_fetch_row($results)){
    var_dump($row);
}
