<?php
	$filters = $_REQUEST;

	$filter_group = array();

	// Separate property and floor plan page.

	$current_page_id = get_the_ID();
	$used_post_type = get_post_meta($current_page_id, 'custom_post_type', true);

	if ($used_post_type == 'property') {
		$current_page = 'property';
	} elseif ($used_post_type == 'floor_plans') {
		$current_page = 'floor_plans';
	} else {
		$current_page = 'post';

		// When user choose 'Move in Ready' from property type, the price condition field should be showed.
		/*if ($filters['property_type'] == 'property') {
			$current_page = 'property';			
		}*/
	}


	if (isset($_REQUEST['price']) || $current_page == 'property') {
		$filter_group = array(
			'square_feet' => array(
				'any'     => 'Any',
				'1500'    => '1500+',
				'2000'    => '2000+',
				'2500'    => '2500+',
				'3000'    => '3000+',
				'3500'    => '3500+'
			),
			'bedrooms' => array(
				'any'  => 'Any',
				'1'    => '1+',
				'2'    => '2+',
				'3'    => '3+',
				'4'    => '4+',
				'5'    => '5+'
			),
			'bathrooms' => array(
				'any'  => 'Any',
				'1'    => '1+',
				'2'    => '2+',
				'3'    => '3+',
				'4'    => '4+',
				'5'    => '5+'
			),
			/*'property_type' => array(
				'any'           => 'Any',
				'floor_plans'     => 'Floorplan',
				'property' => 'Move-in Ready'
			),*/
			'price' => array(
				'any'  => 'Any',
				'450000'    => '450000+',
				'500000'    => '500000+',
				'550000'    => '550000+',
				'600000'    => '600000+',
				'650000'    => '650000+'
			),
			'garage' => array(
				'any'  => 'Any',
				'1'    => '1+',
				'2'    => '2+',
				'3'    => '3+',
				'4'    => '4+',
				'5'    => '5+'
			)
		);
	} else {
		$filter_group = array(
			'square_feet' => array(
				'any'     => 'Any',
				'1500'    => '1500+',
				'2000'    => '2000+',
				'2500'    => '2500+',
				'3000'    => '3000+',
				'3500'    => '3500+'
			),
			'bedrooms' => array(
				'any'  => 'Any',
				'1'    => '1+',
				'2'    => '2+',
				'3'    => '3+',
				'4'    => '4+',
				'5'    => '5+'
			),
			'bathrooms' => array(
				'any'  => 'Any',
				'1'    => '1+',
				'2'    => '2+',
				'3'    => '3+',
				'4'    => '4+',
				'5'    => '5+'
			),
			/*'property_type' => array(
				'any'           => 'Any',
				'floor_plans'     => 'Floorplan',
				'property' => 'Move-in Ready'
			),*/
			'garage' => array(
				'any'  => 'Any',
				'1'    => '1+',
				'2'    => '2+',
				'3'    => '3+',
				'4'    => '4+',
				'5'    => '5+'
			)

		);
	}

?>
<form method="get" id="advanced-searchform" class="text-center" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">

    <!-- PASSING THIS TO TRIGGER THE ADVANCED SEARCH RESULT PAGE FROM functions.php -->
    <input type="hidden" name="search" value="advanced">

    <?php
    foreach ($filter_group as $key => $filter) {
    	$column = count($filter_group);
    	switch ($key) {
    		case 'square_feet':
    			$filter_label = 'Square Feet';
    			break;
    		
    		case 'bedrooms':
    			$filter_label = 'Bedrooms';
    			break;

    		case 'bathrooms':
    			$filter_label = 'Bathrooms';
    			break;

    		case 'price':
    			$filter_label = 'Price';
    			break;

    		case 'garage':
    			$filter_label = 'Car Garage';
    			break;

    		case 'property_type':
    			$filter_label = 'Property Type';
    			break;

    		default:
    			$filter_label = '';
    			break;
    	}

	?>
	<div class="<?php echo $column == 5 ? 'col-20 col-xs-6' : 'col-md-3 col-xs-6'; ?>">
		<label for="<?php echo $key; ?>" class=""><?php echo $filter_label; ?></label><br>
		<select name="<?php echo $key; ?>" id="<?php echo $key; ?>" class="form-control">
    	<?php
	    	foreach ($filter as $filter_key => $option) {
	    		echo '<option value="' . $filter_key . '"' . ($filters[$key] == $filter_key ? "selected" : "") . '>' . $option . '</option>';
	    	}
    	?>
		</select>
	</div>
	<?php
    }
    ?>
    <input type="submit" id="searchsubmit" value="Search" />

</form>