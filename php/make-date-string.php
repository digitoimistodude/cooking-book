<?php

/**
 * @Author: Timi Wahalahti
 * @Date:   2018-10-13 14:47:10
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2018-11-17 17:08:10
 */

$day_str = '';
if ( empty( $end_day ) || $start_day === $end_day ) {
  $day_str = date( 'j.n.Y', $start_day );
} else {
  $start_month = date( 'm', $start_day );
  $end_month = date( 'm', $end_day );

  if ( $start_month !== $end_month ) {
    $day_str = date( 'j.n.', $start_day );
  } else {
    $day_str = date( 'j.', $start_day );
  }

  $day_str .= ' - ' . date( 'j.n.Y', $end_day );
}
