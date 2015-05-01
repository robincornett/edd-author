<?php

if ( function_exists( 'register_field_group' ) ) {

	register_field_group( array(
		'key'    => 'group_5543827f1c6ac',
		'title'  => 'Publications Links',
		'fields' => array(
			array(
				'key'               => 'field_554382904bbda',
				'label'             => 'Amazon US',
				'name'              => '_rabia_amazon_us',
				'prefix'            => '',
				'type'              => 'url',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value' => '',
				'placeholder'   => '',
			),
			array(
				'key'               => 'field_554383094bbdb',
				'label'             => 'Amazon UK',
				'name'              => '_rabia_amazon_uk',
				'prefix'            => '',
				'type'              => 'url',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value' => '',
				'placeholder'   => '',
			),
			array(
				'key'               => 'field_554383374bbdc',
				'label'             => 'Barnes & Noble',
				'name'              => '_rabia_barnesnoble',
				'prefix'            => '',
				'type'              => 'url',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value' => '',
				'placeholder'   => '',
			),
			array(
				'key'               => 'field_554383474bbdd',
				'label'             => 'Kobo',
				'name'              => '_rabia_kobo',
				'prefix'            => '',
				'type'              => 'url',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value' => '',
				'placeholder'   => '',
			),
			array(
				'key'               => 'field_5543835a4bbde',
				'label'             => 'Smashwords',
				'name'              => '_rabia_smashwords',
				'prefix'            => '',
				'type'              => 'url',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'placeholder'       => '',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'download',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
	));

}
