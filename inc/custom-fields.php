<?php add_action( 'cmb2_init', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes() {
	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'main_page',
		'title'         => __( 'Edytor strony głównej', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$cmb->add_field( array(
		'name'       => __( 'Text główny', 'cmb2' ),
		//'desc'       => __( 'field description (optional)', 'cmb2' ),
		'id'         => 'text',
		'type'       => 'textarea_small',
	) );

	$cmb->add_field( array(
		'name'       => __( 'Główne zdjęcie', 'cmb2' ),
		//'desc'       => __( 'field description (optional)', 'cmb2' ),
		'id'         => 'main_image',
		'type'       => 'file',
	) );

	$cmb->add_field( array(
		'name' => __( 'O mnie', 'cmb2' ),
        'id'   => 'url',
		'type' => 'textarea_small',
	) );

	$cmb->add_field( array(
		'name'       => __( 'O mnie - zdjęcie', 'cmb2' ),
		//'desc'       => __( 'field description (optional)', 'cmb2' ),
		'id'         => 'about_image',
		'type'       => 'file',
	) );

	$cmb->add_field( array(
		'name' => __( 'Adres e-mail', 'cmb2' ),
		'id'   => 'email',
		'type' => 'text_email',
    ) );
    
    $cmb->add_field( array(
		'name' => __( 'numer telefonu', 'cmb2' ),
		'id'   => 'numer',
		'type' => 'text',
	) );

	$cmb_product = new_cmb2_box( array(
		'id'            => 'product',
		'title'         => __( 'Edytor produktu', 'cmb2' ),
		'object_types'  => array( 'product', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		'show_in_rest'  => true,
	) );

	$cmb_product->add_field( array(
		'name'       => __( 'Cena', 'cmb2' ),
		'desc'       => __( 'w złotówkach', 'cmb2' ),
		'id'         => 'price',
		'type'       => 'text_small',
	) );

	$cmb_product->add_field( array(
		'name'    => 'Zdjęcie produktu',
		'id'      => 'image',
		'type'    => 'file',
		'options' => array(
			'url' => false,
		),
		'preview_size' => 'large', // Image size to use when previewing in the admin.
	) );
}
?>