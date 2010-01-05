<?PHP

// Sleep for between 0.5 - 1.5 seconds.
sleep( mt_rand(5, 15) / 10 );

// Simulate random errors, to demonstrate jqmq's retry feature.
$success = mt_rand(0, 10) > 5;

// Display items in a meaningful way.
$items = implode( ',', $_GET['items'] );

// Create response object.
$data = array();
$data['success'] = $success;
$data['html'] = '<span class="' . ( $success ? 'success' : 'error' ) . '">' . $items . '</span>';

// Return response object, serialized as JSON.
header( 'Content-type: application/json' );
print json_encode( $data );

?>