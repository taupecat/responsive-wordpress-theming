<?php

class Manning_Color {
	var $colorHex;

	public function __construct( $colorHex ) {
		$this->colorHex = $colorHex;
	}

	public function hexToHSL() {
		$red 	= (hexdec( substr( $this->colorHex, 1, 2 ))) / 255;
		$green 	= (hexdec( substr( $this->colorHex, 3, 2 ))) / 255;
		$blue 	= (hexdec( substr( $this->colorHex, 5, 2 ))) / 255;

		$min 		= min( $red, $green, $blue );
		$max		= max( $red, $green, $blue );
		$del_max	= $max - $min;

		$this->lightness	= ( $max + $min ) / 2;

		if ( $del_max == 0 ) {
			$this->hue 			= 0;
			$this->saturation	= 0;
		} else {
			if ( $this->lightness < 0.5 ) {
				$this->saturation = $del_max / ( $max + $min );
			} else {
				$this->saturation = $del_max / ( 2 - $max - $min );
			}

			$del_red	= ( ( ( $max - $red ) / 6 ) + ( $del_max / 2 ) ) / $del_max;
			$del_green	= ( ( ( $max - $green ) / 6 ) + ( $del_max / 2 ) ) / $del_max;
			$del_blue	= ( ( ( $max - $blue ) / 6 ) + ( $del_max / 2 ) ) / $del_max;

			if ( $red == $max ) {
				$this->hue = $del_blue - $del_green;
			} elseif ( $green == $max ) {
				$this->hue = ( 1 / 3 ) + $del_red - $del_blue;
			} elseif ( $blue == $max ) {
				$this->hue = ( 2 / 3 ) + $del_green - $del_red;
			}

			if ( $this->hue < 0 ) $this->hue += 1;
			if ( $this->hue > 1 ) $this->hue -= 1;
		}
	}

	public function HSLToHex() {
		if ( $this->saturation == 0 ) {
			$red = $green = $blue = $this->lightness * 255;
		} else {
			if ( $this->lightness < 0.5 ) {
				$var_2 = $this->lightness * ( 1 + $this->saturation );
			} else {
				$var_2 = ( $this->lightness + $this->saturation ) - ( $this->saturation * $this->lightness );
			}

			$var_1 = 2 * $this->lightness - $var_2;

			$red 	= (string) dechex( 255 * $this->hueToRGB( $var_1, $var_2, $this->hue + ( 1 / 3 ) ) );
			$green 	= (string) dechex( 255 * $this->hueToRGB( $var_1, $var_2, $this->hue ) );
			$blue 	= (string) dechex( 255 * $this->hueToRGB( $var_1, $var_2, $this->hue - ( 1 / 3 ) ) );

			if ( strlen( $red ) < 2 )	$red = '0' . $red;
			if ( strlen( $green ) < 2 )	$green = '0' . $green;
			if ( strlen( $blue ) < 2 )	$blue = '0' . $blue;

			// Convert to Hex
			$this->colorHex = '#' . $red . $green . $blue;
		}
	}

	public function darkenByRatio( $value ) {
		$this->hexToHSL();
		$this->lightness = min( 1, max( $this->lightness * ( 1 - $value ), 0 ) );
		$this->HSLToHex();
	}

	private function hueToRGB( $var_1, $var_2, $hue ) {
		if ( $hue < 0 ) $hue += 1;
		if ( $hue > 1 ) $hue -= 1;

		if ( ( 6 * $hue ) < 1 ) return $var_1 + ( $var_2 - $var_1 ) * 6 * $hue;
		if ( ( 2 * $hue ) < 1 ) return $var_2;
		if ( ( 3 * $hue ) < 2 ) return $var_1 + ( $var_2 - $var_1 ) * ( ( 2 / 3 ) - $hue ) * 6;

		return $var_1;
	}
}
