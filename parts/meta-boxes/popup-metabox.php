<?php
/*
Title: Popup Settings
Post Type: popup
*/
piklist('field', array(
	'type'  => 'checkbox',
	'field' => 'popupcreator_active',
	'label' => __('Active', 'popupcreator'),
	'value' => 0,
	'choices' => array(
		1 => __('Active', 'popupcreator')
	)
));

//display different popup

piklist('field', array(
	'type'    => 'radio',
	'field'   => 'popupcreator_display',
	'label'   => __('PopUp Display', 'popupcreator'),
	'value'   => 1,
	'choices' => array(
		0 => __('Display Only Image', 'popupcreator'),
		1 => __('Display with the MetaData Popup', 'popupcreator')
	)
));


// piklist('field', array(
// 	'type' => 'radio'
// 	,'field' => 'colorpicker_choice'
// 	,'label' => 'Would you like to give the Color?'
// 	,'attributes' => array(
// 	'class' => 'text'
// 	)
// 	,'choices' => array(
// 	  'yes' => 'Yes'
// 	  ,'no' => 'No'
// 	)
// 	,'value' => 'no'
//    ));

piklist('field', array(
	'type' => 'colorpicker',
	'field' => 'popupcreator_background_color',
	'label' => 'Color Picker',
	'conditions' => array(
		array(
		 'field' => 'popupcreator_display',
		 'value' => 1,
		)
		),
));

// piklist('field', array(
// 	'type' => 'radio'
// 	,'field' => 'promot_text_select'
// 	,'label' => 'Would you like to give the Promo Text?'
// 	,'attributes' => array(
// 	'class' => 'text'
// 	)
// 	,'choices' => array(
// 	  'yes' => 'Yes'
// 	  ,'no' => 'No'
// 	)
// 	,'value' => 'no'
//    ));

piklist('field', array(
	'type'  => 'text',
	'field' => 'popupcreator_promo_text',
	'label' => __('Promo Text', 'popupcreator'),
	'conditions' => array(
		array(
		 'field' => 'popupcreator_display',
		 'value' => 1,
		)
		),
));

piklist('field', array(
	'type'  => 'text',
	'field' => 'popupcreator_display_after',
	'label' => __('Display Popup After', 'popupcreator'),
	'help'  => __('in seconds', 'popupcreator'),
));

// piklist('field', array(
// 	'type' => 'radio'
// 	,'field' => 'discount_text_select'
// 	,'label' => 'Would you like to give the Discount Text?'
// 	,'attributes' => array(
// 	'class' => 'text'
// 	)
// 	,'choices' => array(
// 	  'yes' => 'Yes'
// 	  ,'no' => 'No'
// 	)
// 	,'value' => 'no'
//    ));

piklist('field', array(
	'type'  => 'text',
	'field' => 'popupcreator_discount_text',
	'label' => __('Discount Text', 'popupcreator'),
	'conditions' => array(
		array(
			'field' => 'popupcreator_display',
			'value' => 1,
		   )
		),
));

// piklist('field', array(
// 	'type' => 'radio'
// 	,'field' => 'discount_color_select'
// 	,'label' => 'Would you like to give the Discount Color?'
// 	,'attributes' => array(
// 	'class' => 'text'
// 	)
// 	,'choices' => array(
// 	  'yes' => 'Yes'
// 	  ,'no' => 'No'
// 	)
// 	,'value' => 'no'
//    ));

piklist('field', array(
	'type' => 'colorpicker',
	'field' => 'popupcreator_discount_color',
	'label' => 'Discount Color',
	'conditions' => array(
		array(
			'field' => 'popupcreator_display',
			'value' => 1,
		   )
		),
));

// piklist('field', array(
// 	'type' => 'radio'
// 	,'field' => 'discount_background_select'
// 	,'label' => 'Would you like to give the Discount Background Color?'
// 	,'attributes' => array(
// 	'class' => 'text'
// 	)
// 	,'choices' => array(
// 	  'yes' => 'Yes'
// 	  ,'no' => 'No'
// 	)
// 	,'value' => 'no'
//    ));

piklist('field', array(
	'type' => 'colorpicker',
	'field' => 'popupcreator_discount_background',
	'label' => 'Discount Background Color',
	'conditions' => array(
		array(
			'field' => 'popupcreator_display',
			'value' => 1,
		   )
		),
));

// piklist('field', array(
// 	'type' => 'radio'
// 	,'field' => 'image_upload_select'
// 	,'label' => 'Would you like to give the Image Upload Field?'
// 	,'attributes' => array(
// 	'class' => 'text'
// 	)
// 	,'choices' => array(
// 	  'yes' => 'Yes'
// 	  ,'no' => 'No'
// 	)
// 	,'value' => 'no'
//    ));


piklist('field', array(
	'type' => 'file', 'field' => 'popupcreator_image_upload_field', 'scope' => 'post_meta', 'label' => 'Media Uploader', 'options' => array(
		'modal_title' => 'Upload Image(s)', 'button' => 'Upload', 'conditions' => array(
			array(
				'field' => 'popupcreator_display',
				'value' => 1,
			   )
			),
	)
));

piklist('field', array(
	'type'    => 'radio',
	'field'   => 'close_button_field',
	'label'   => __('PopUp Close Button Height', 'popupcreator'),
	'conditions' => array(
		array(
			'field' => 'popupcreator_display',
			'value' => 0,
		   )
		),
	'choices' => array(
		33 => __('Top Side of Popup', 'popupcreator'),
		46 => __('Center Right Side of Popup', 'popupcreator')
	),
	'value' => 46,
));

piklist('field', array(
	'type'  => 'url',
	'field' => 'popupcreator_url',
	'label' => __('URL', 'popupcreator'),
));

// piklist('field', array(
// 	'type' => 'radio'
// 	,'field' => 'deadline_background_select'
// 	,'label' => 'Would you like to give the Deadline Background Field?'
// 	,'attributes' => array(
// 	'class' => 'text'
// 	)
// 	,'choices' => array(
// 	  'yes' => 'Yes'
// 	  ,'no' => 'No'
// 	)
// 	,'value' => 'no'
//    ));

piklist('field', array(
	'type' => 'colorpicker',
	'field' => 'popupcreator_deadline_background',
	'label' => 'Deadline Background Color',
	'conditions' => array(
		array(
			'field' => 'popupcreator_display',
			'value' => 1,
		   )
		),
));

// piklist('field', array(
// 	'type' => 'radio'
// 	,'field' => 'button_text_select'
// 	,'label' => 'Would you like to give the Button Text Field?'
// 	,'attributes' => array(
// 	'class' => 'text'
// 	)
// 	,'choices' => array(
// 	  'yes' => 'Yes'
// 	  ,'no' => 'No'
// 	)
// 	,'value' => 'no'
//    ));


piklist('field', array(
	'type'  => 'text',
	'field' => 'popupcreator_button_text',
	'label' => __('Button Text', 'popupcreator'),
	'conditions' => array(
		array(
			'field' => 'popupcreator_display',
			'value' => 1,
		   )
		),
));


piklist('field', array(
	'type'  => 'checkbox',
	'field' => 'popupcreator_auto_hide',
	'label' => __('Auto Hide', 'popupcreator'),
	'value' => 1,
	'choices' => array(
		1 => __('Don\'t Hide', 'popupcreator')
	)
));
piklist('field', array(
	'type'    => 'radio',
	'field'   => 'popupcreator_on_exit',
	'label'   => __('Display On Exit', 'popupcreator'),
	'value'   => 1,
	'choices' => array(
		0 => __('Display On Exit', 'popupcreator'),
		1 => __('Display On Page Load', 'popupcreator')
	)
));

piklist('field', array(
	'type' => 'datepicker',
	'field' => 'popupcreator_date_field',
	'label' => 'Date',
	'value' => date('M d, Y'), // set default value
	'options' => array(
		'dateFormat' => 'd'),
	'conditions' => array(
		array(
			'field' => 'popupcreator_display',
			'value' => 1,
		   )
		),
));

piklist('field', array(
	'type'    => 'select',
	'field'   => 'popupcreator_popup_size',
	'label'   => __('Popup Size', 'popupcreator'),
	'value'   => 'landscape',
	'choices' => array(
		'popup-landscape' => __('Landscape', 'popupcreator'),
		'popup-square' => __('Square', 'popupcreator'),
		'full' => __('Original', 'popupcreator'),
	)
));
