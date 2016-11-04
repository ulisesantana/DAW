<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'hosting';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case object
// parameter names
$columns = array(
	array( 'db' => 'nif', 'dt' => 'nif' ),
	array( 'db' => 'name',  'dt' => 'name' ),
	array( 'db' => 'surname',   'dt' => 'surname' ),
	array( 'db' => 'email',     'dt' => 'email' ),
	array( 'db' => 'state',     'dt' => 'state' ),
	array( 'db' => 'town', 'dt' => 'town' ),
	array( 'db' => 'address',  'dt' => 'address' ),
	array( 'db' => 'phone',   'dt' => 'phone' )
);

// SQL server connection information
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'datatables',
	'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
