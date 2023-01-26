<?php
/**
 * UDS Profile (Manual)
 * - All fields are represented in the block, except individual social media icons.
 * - The rendered profile size is controled by block style panel.
 *
 * @package Pitchfork_Blocks
 */

/**
 * Get fields.
 */
$displayname = get_field( 'uds_profilemanual_name' );
$title       = get_field( 'uds_profilemanual_title' );
$dept        = get_field( 'uds_profilemanual_department' );
$searchURL   = get_field( 'uds_profilemanual_url' );
$image       = get_field( 'uds_profilemanual_image' );
$email       = get_field( 'uds_profilemanual_email' );
$phone       = get_field( 'uds_profilemanual_phone' );
$address     = get_field( 'uds_profilemanual_address' );
$description = get_field( 'uds_profilemanual_description' );
$social      = get_field( 'uds_profilemanual_social' );

/**
 * Retrieve spacing settings from editor.
 */
$spacing = pitchfork_blocks_acf_calculate_spacing( $block );

/**
 * Retrieve additional classes from the 'advanced' field in the editor for inline styles.
 * Explode given string into an array so we can search it later.
 */
$block_class_string = 'uds-person-profile';
if ( ! empty( $block['className'] ) ) {
	$block_class_string .= ' ' . $block['className'];
}
$block_classes = explode( ' ', $block_class_string );

/**
 * Parse the appropriate size from $block['className'].
 * Store the size value in a separate variable to make render script easier.
 * Setting default size to small in case the control is empty. (Initial state?)
 */

$display_size = 'small';
if ( in_array( 'is-style-large', $block_classes ) ) {
	$display_size = 'large';
}
if ( in_array( 'is-style-small', $block_classes ) ) {
	$display_size = 'small';
}
if ( in_array( 'is-style-micro', $block_classes ) ) {
	$display_size = 'micro';
}

/**
 * Check to see if there is a background color selected.
 * Block requires a "fill" class as the only possible modification to the bg.
 */
if ( ! empty( $block['backgroundColor'] ) ) {
	$block_classes[] = $block['backgroundColor'];
}

/**
 * Get contact details, check for blanks. Wrap with <li> elements initially.
 * Check to see if at least one of these is rendered. Then wrap in the <ul> element.
 * If not, return an empty string for the whole thing.
 */

if ( ! empty( $email ) ) {
	$email = '<li><a href="mailto:' . $email . '" aria-label="Email user" data-ga-event="link" data-ga-action="click" data-ga-name="onclick" data-ga-type="internal link" data-ga-region="main content" data-ga-section="' . $displayname . '" data-ga="' . $email . '">' . $email . '</a></li>';
}


if ( ! empty( $phone ) ) {
	$phone = '<li><a href="tel:' . $phone . '" aria-label="Call user" data-ga-event="link" data-ga-action="click" data-ga-name="onclick" data-ga-type="internal link" data-ga-region="main content" data-ga-section="' . $displayname . '" data-ga="' . $phone . '">' . $phone . '</a></li>';
}

// Address field: No way to validate what kind of information will happen within this text box.
// Therefore, this won't be linked at all. Can be an address or a room/building number.
if ( ! empty( $address ) ) {
	$address = '<li>' . $address . '</li>';
}

$contactlist = '';
$contactlist = $email . $phone . $address;
if ( ! empty( $contactlist ) ) {
	$contactlist = '<ul class="person-contact-info">' . $contactlist . '</ul>';
}

/**
 * Gather social media icons and links from ACF.
 */
$social_list = '';
if ( have_rows( 'uds_profilemanual_social' ) ) :
	while ( have_rows( 'uds_profilemanual_social' ) ) :
		the_row();
		$social_icon = get_sub_field( 'icon' );
		$social_url  = get_sub_field( 'link' );

		$social_list .= '<li><a href="' . esc_url( $social_url ) . '" aria-label="Go to user social media accouunt: ' . $social_icon->id . '" data-ga-event="link" data-ga-action="click" data-ga-name="onclick" data-ga-type="external link" data-ga-region="main content" data-ga-section="' . $displayname . '" data-ga="' . $social_icon->id . '">' . $social_icon->element . '</a></li>';

	endwhile;
	$social_list = '<ul class="person-social-medias">' . $social_list . '</ul>';
else :
	// no rows found
endif;

/**
 * Manipulate displayname, title and department to include wrapper <h#> elements and check for blanks.
 */
if ( ( 'small' !== $display_size ) && ( ! empty( $searchURL ) ) ) {
	// Is this a large profile, and is there a URL present?
	$displayname = '<h3 class="person-name"><a href="' . $searchURL . '">' . $displayname . '</a></h3>';
} else {
	// If there's no link or if it's a display size other than large.
	$displayname = '<h3 class="person-name">' . $displayname . '</h3>';
}

if ( ! empty( $title ) ) {
	$title = '<h4><span>' . $title . '</span></h4>';
}

// Set the department to the typed in value.
// Override this value if the block style is "micro"
$department = '';
if ( ! empty( $dept ) ) {
	$department = '<h4><span>' . $dept . '</span></h4>';
}

$micro_contact = '';
if ( 'micro' === $display_size ) {
	// If there is an email address, grab it. Overwrite department string with address.
	if ( ! empty( $email ) ) {
		$micro_contact = strip_tags( $email, '<a>' );
		$department    = '<h4>' . $micro_contact . '</h4>';
	}
}

/**
 * Check if there's a description and wrap it.
*/
if ( ! empty( $description ) ) {
	$description = '<div><p class="person-description">' . $description . '</p></div>';
}

/**
 * Check if there's a profile image and create the markup for it.
*/
$profileimg = '';
do_action( 'qm/debug', $image );
if ( ( ! empty( $image ) ) || ( in_array( 'has-default-img', $block_classes ) ) ) {
		$profileimg .= '<div class="profile-img-container"><div class="profile-img-placeholder">';
		$profileimg .= wp_get_attachment_image( $image['ID'], 'thumbnail', false, array( 'class' => 'profile-img' ) );
		$profileimg .= '</div></div>';
}

/**
 * Render the block
 */
$profile  = '<div class="' . implode( ' ', $block_classes ) . '" style="' . $spacing . '">';
$profile .= $profileimg;
$profile .= '<div class="person"><div class="person-name">' . $displayname . '</div>';
$profile .= '<div class="person-profession">' . $title . $department . '</div>';

if ( 'micro' !== $display_size ) {
	$profile .= $contactlist;
}

if ( 'large' === $display_size ) {
	$profile .= $description . $social_list;
} elseif ( ( 'small' === $display_size ) && ( ! empty( $searchURL ) ) ) {
	$profile .= '<a href="' . $searchURL . '" class="btn btn-maroon btn-md">View profile</a>';
}

$profile .= '</div></div>';

echo $profile;
