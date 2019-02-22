<?php add_action( 'cmb2_admin_init', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_yourprefix_';

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
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	$cmb->add_field( array(
		'name'       => __( 'Text główny', 'cmb2' ),
		//'desc'       => __( 'field description (optional)', 'cmb2' ),
		'id'         => 'text',
		'type'       => 'textarea_small',
	) );

	$cmb->add_field( array(
		'name' => __( 'O mnie', 'cmb2' ),
        'id'   => 'url',
		'type' => 'textarea_small',
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

}
?>