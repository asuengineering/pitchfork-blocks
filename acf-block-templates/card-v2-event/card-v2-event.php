<?php
/**
 * PF Blocks - Card v2 - Card Event
 *
 * @package Pitchfork Blocks
 * @author Steve Ryan
 *
 * An inner block for creating the card-event wrapper and associated fields.
 */

$event_date = get_field('uds_card2_event_date');
$event_start = get_field('uds_card2_event_start');
$event_end = get_field('uds_card2_event_end');
$event_override = get_field('uds_card2_event_override');
$event_location = get_field('uds_card2_event_location');
$layout = get_field('uds_card2_event_layout');


/**
 * Build event details string for date and time.
 */

$datestring = '<div class="card-event-icons"><div><span class="fa-regular fa-calendar"></span></div><div>';
if ( $event_date ) {

	$datestring .= $event_date;

	if ( $event_start ) {

		// Add dots to am/pm. Replace the whole thing with noon/midnight if appropriate.
		if ( $event_start == '12:00 pm' ) {
			$start_dots = 'noon';
		} elseif ( $event_start == '12:00 am' ) {
			$start_dots = 'midnight';
		} else {
			$start_dots = str_replace(array('am','pm'),array('a.m.','p.m.'), $event_start);
		}

		$datestring .= ', ' . $start_dots;

		if ( $event_end ) {

			// Let's test to see if times span across noon or midnight.
			// Extracting hours from the time strings
			$start_hour = date('G', strtotime($event_start));
			$end_hour = date('G', strtotime($event_end));

			// Determine if start and end times span across different meridians
			$span_across_meridian = ($start_hour < 12 && $end_hour >= 12) || ($start_hour >= 12 && $end_hour < 12);

			// Check if start time is exactly 12:00am or 12:00pm
			$start_is_noon_or_midnight = (date('H:i', strtotime($event_start)) === '00:00' || date('H:i', strtotime($event_start)) === '12:00');

			// Shorten the existing string by 5 characters if we span across noon.
			if ( ! $span_across_meridian && ! $start_is_noon_or_midnight ) {
				$datestring = substr($datestring, 0, -5);
			}

			// Add back the missing dots to the time string.
			if ( $event_end == '12:00 pm' ) {
				$end_dots = 'noon';
			} elseif ( $event_end == '12:00 am' ) {
				$end_dots = 'midnight';
			} else {
				$end_dots = str_replace(array('am','pm'),array('a.m.','p.m.'), $event_end);
			}
			$datestring .= '&ndash;' . $end_dots;
		}
	}

	$datestring .= '</div></div>';
}

/**
 * Override the date string above if the data is present.
 */
if ( $event_override ) {
	$datestring = '<div class="card-event-icons"><div><span class="fa-regular fa-calendar"></span></div><div>';
	$datestring .= $event_override . '</div></div>';
}

/**
 * Create location string if data is present.
 */

$locationstring = '';
if ($event_location) {
	$locationstring = '<div class="card-event-icons"><div><span class="fa-solid fa-location-dot"></span></div><div>';
	$locationstring .= $event_location . '</div></div>';
}

/**
 * Output card-event-details card part based on layout indicated.
 * Possible returned values from $layout are "compact" and "newline".
 * Default option: "compact."
 */

if ( $layout == 'newline') {
	echo '<div class="card-event-details">' . $datestring . '</div><div class="card-event-details">' . $locationstring . '</div>';
} else {
	// Layout = "compact"
	echo '<div class="card-event-details">' . $datestring . $locationstring . '</div>';
}

