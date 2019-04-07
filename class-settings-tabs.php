<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

if( ! class_exists( 'settings_tabs_field' ) ) {
class settings_tabs_field{


    function field_template(){

        ob_start();

        ?>
        <div class="setting-field">
            <div class="field-lable">%s</div>
            <div class="field-input">%s
                <p class="description">%s</p>
            </div>
        </div>
        <?php

        return ob_get_clean();

    }


    function generate_field($option){

        $id 		= isset( $option['id'] ) ? $option['id'] : "";
        $type 		= isset( $option['type'] ) ? $option['type'] : "";
        $details 	= isset( $option['details'] ) ? $option['details'] : "";






        if( empty( $id ) ) return;

        if( isset($option['type']) && $option['type'] === 'select' ) 		    $this->field_select( $option );
        elseif( isset($option['type']) && $option['type'] === 'select2')	    $this->field_select2( $option );
        elseif( isset($option['type']) && $option['type'] === 'checkbox')	    $this->field_checkbox( $option );
        elseif( isset($option['type']) && $option['type'] === 'radio')		    $this->field_radio( $option );
        elseif( isset($option['type']) && $option['type'] === 'radio_image')	$this->field_radio_image( $option );
        elseif( isset($option['type']) && $option['type'] === 'textarea')	    $this->field_textarea( $option );
        elseif( isset($option['type']) && $option['type'] === 'scripts_js')	    $this->field_scripts_js( $option );
        elseif( isset($option['type']) && $option['type'] === 'scripts_css')	$this->field_scripts_css( $option );
        elseif( isset($option['type']) && $option['type'] === 'number' ) 	    $this->field_number( $option );
        elseif( isset($option['type']) && $option['type'] === 'text' ) 		    $this->field_text( $option );
        elseif( isset($option['type']) && $option['type'] === 'text_icon' )     $this->field_text_icon( $option );
        elseif( isset($option['type']) && $option['type'] === 'text_multi' ) 	$this->field_text_multi( $option );
        elseif( isset($option['type']) && $option['type'] === 'range' ) 		$this->field_range( $option );
        elseif( isset($option['type']) && $option['type'] === 'colorpicker')    $this->field_colorpicker( $option );
        elseif( isset($option['type']) && $option['type'] === 'datepicker')	    $this->field_datepicker( $option );
        elseif( isset($option['type']) && $option['type'] === 'repeater')	    $this->field_repeater( $option );
        elseif( isset($option['type']) && $option['type'] === 'faq')	        $this->field_faq( $option );
        elseif( isset($option['type']) && $option['type'] === 'addons_grid')	$this->field_addons_grid( $option );
        elseif( isset($option['type']) && $option['type'] === 'custom_html')	$this->field_custom_html( $option );




        elseif( isset($option['type']) && $option['type'] === $type ) 	do_action( "settings_tabs_field_$type", $option );


        //if( !empty( $details ) ) echo "<p class='description'>$details</p>";





    }


    public function field_select( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $args 	= isset( $option['args'] ) ? $option['args'] : array();
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $multiple 	= isset( $option['multiple'] ) ? $option['multiple'] : false;
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();




        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        if($multiple){
            $value 	= isset( $option['value'] ) ? $option['value'] : array();
            $field_name = !empty($parent) ? $parent.'['.$id.'][]' : $id.'[]';
            $default 	= isset( $option['default'] ) ? $option['default'] : array();
        }else{
            $value 	= isset( $option['value'] ) ? $option['value'] : '';
            $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;
            $default 	= isset( $option['default'] ) ? $option['default'] : '';
        }


        $value = !empty($value) ? $value : $default;




        ob_start();
        ?>
        <select <?php if($multiple) echo 'multiple'; ?> name='<?php echo $field_name; ?>' id='<?php echo $id; ?>'>
            <?php
            foreach( $args as $key => $name ):
                if($multiple){
                    $selected = in_array($key, $value) ? "selected" : "";
                }else{
                    $selected = $value == $key ? "selected" : "";
                }


                ?>
                <option <?php echo $selected; ?> value='<?php echo $key; ?>'><?php echo $name; ?></option>
            <?php
            endforeach;
            ?>
        </select>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);


    }

    public function field_select2( $option ){

        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : "";
        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $args 	= isset( $option['args'] ) ? $option['args'] : array();
        $multiple 	= isset( $option['multiple'] ) ? $option['multiple'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();

        if($multiple){
            $value 	= isset( $option['value'] ) ? $option['value'] : array();
            $field_name = !empty($parent) ? $parent.'['.$id.'][]' : $id.'[]';
            $default 	= isset( $option['default'] ) ? $option['default'] : array();
        }else{
            $value 	= isset( $option['value'] ) ? $option['value'] : '';
            $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;
            $default 	= isset( $option['default'] ) ? $option['default'] : '';
        }

        $value = !empty($value) ? $value : $default;

        //$value	= get_post_meta( $post_id, $id, true );
        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        ob_start();
        ?>
        <select class="select2" <?php if($multiple) echo 'multiple'; ?>  name='<?php echo $field_name; ?>' id='<?php echo $css_id; ?>'>
            <?php
            foreach( $args as $key => $name ):

                if($multiple){
                    $selected = in_array($key, $value) ? "selected" : "";
                }else{
                    $selected = ($key == $value) ? "selected" : "";
                }

                ?>
                <option <?php echo $selected; ?> value='<?php echo $key; ?>'><?php echo $name; ?></option>
            <?php
            endforeach;
            ?>
        </select>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);





    }










    public function field_text( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();


        $value = !empty($value) ? $value : $default;

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;


        ob_start();
        ?>
        <input type='text' class='' name='<?php echo $field_name; ?>' id='<?php echo $id; ?>' placeholder='<?php echo $placeholder; ?>' value='<?php echo $value; ?>' />
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);

    }




    public function field_text_icon( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $option_value = empty($value) ? $default : $value;

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;




        ob_start();
        ?>
        <div class="text-icon">
            <span class="icon"><i class="<?php echo $option_value; ?>"></i></span><input type='text' class='' name='<?php echo $field_name; ?>' id='<?php echo $id; ?>' placeholder='<?php echo $placeholder; ?>' value='<?php echo $option_value; ?>' />
        </div>
        <style type="text/css">
            .text-icon{}
            .text-icon .icon{
                /* width: 30px; */
                background: #ddd;
                /* height: 28px; */
                display: inline-block;
                vertical-align: top;
                text-align: center;
                font-size: 14px;
                padding: 5px 10px;
                line-height: normal;
            }
        </style>
        <script>
            jQuery(document).ready(function($){
                $(document).on('keyup', '.text-icon input', function () {
                    val = $(this).val();
                    if(val){
                        $(this).parent().children('.icon').html('<i class="'+val+'"></i>');
                    }
                })
            })
        </script>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);

    }



    public function field_range( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();

        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $value = !empty($value) ? $value : $default;

        $args 	= isset( $option['args'] ) ? $option['args'] : "";

        $min = isset($args['min']) ? $args['min'] : '';
        $max = isset($args['max']) ? $args['max'] : '';
        $step = isset($args['step']) ? $args['step'] : '';

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;


        ob_start();
        ?>
        <div class="range-input">
            <span class="range-value"><?php echo $value; ?></span><input type="range" min="<?php if($min) echo $min; ?>" max="<?php if($max) echo $max; ?>" step="<?php if($step) echo $step; ?>" class='' name='<?php echo $field_name; ?>' id='<?php echo $id; ?>' value='<?php echo $value; ?>' />
        </div>

        <script>
            jQuery(document).ready(function($){
                $(document).on('change', '#<?php echo $id; ?>', function () {
                    val = $(this).val();
                    if(val){
                        $(this).parent().children('.range-value').html(val);
                    }
                })
            })
        </script>

        <style type="text/css">
            .range-input{}
            .range-input .range-value{
                display: inline-block;
                vertical-align: top;
                margin: 0 0;
                padding: 4px 10px;
                background: #eee;
            }
        </style>
        <?php

        $input_html = ob_get_clean();
        echo sprintf($field_template, $title, $input_html, $details);
    }



    public function field_textarea( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $value = !empty($value) ? $value : $default;

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;


        ob_start();
        ?>
        <textarea name='<?php echo $field_name; ?>' id='<?php echo $id; ?>' cols='40' rows='5' placeholder='<?php echo $placeholder; ?>'><?php echo $value; ?></textarea>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);






    }



    public function field_scripts_js( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $value = !empty($value) ? $value : $default;


        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;


        ob_start();
        ?>
        <textarea name='<?php echo $field_name; ?>' id='<?php echo $id; ?>' cols='40' rows='5' placeholder='<?php echo $placeholder; ?>'><?php echo $value; ?></textarea>

        <script>
            var editor = CodeMirror.fromTextArea(document.getElementById("<?php echo $id; ?>"), {
                lineNumbers: true,
            });

        </script>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);




    }


    public function field_scripts_css( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $value = !empty($value) ? $value : $default;

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 		= isset( $option['details'] ) ? $option['details'] : "";



        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;
        ?>
        <div class="setting-field">
            <div class="field-lable"><?php if(!empty($title)) echo $title;  ?></div>
            <div class="field-input">

                <p class="description"><?php if(!empty($details)) echo $details;  ?></p>
            </div>
        </div>





        <?php

        ob_start();
        ?>
        <textarea name='<?php echo $field_name; ?>' id='<?php echo $id; ?>' cols='40' rows='5' placeholder='<?php echo $placeholder; ?>'><?php echo $value; ?></textarea>
        <script>

            var editor = CodeMirror.fromTextArea(document.getElementById("<?php echo $id; ?>"), {
                lineNumbers: true,
                value: "",
                //scrollbarStyle: "simple"
            });

        </script>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);

    }







    public function field_radio( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 		= isset( $option['details'] ) ? $option['details'] : "";
        $for 		= isset( $option['for'] ) ? $option['for'] : "";
        $args			= isset( $option['args'] ) ? $option['args'] : array();

        $option_value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $option_value = !empty($option_value) ? $option_value : $default;

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;


        ob_start();

        if(!empty($args))
            foreach( $args as $key => $value ):
                $checked = ( $key == $option_value ) ? "checked" : "";
                $for = !empty($for) ? $for.'-'.$id."-".$key : $id."-".$key;
                ?>
                <label for='<?php echo $for;?>'><input name='<?php echo $field_name; ?>' type='radio' id='<?php echo $for; ?>' value='<?php echo $key;?>'  <?php echo $checked;?>><span><?php echo $value;?></span></label>

                <?php
            endforeach;

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);


    }



    public function field_radio_image( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $args			= isset( $option['args'] ) ? $option['args'] : array();
        //$args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
        $option_value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;

        //var_dump($option_value);

        $option_value = empty($option_value) ? $default : $option_value;



        ob_start();
        ?>
        <div class="radio-img">
            <?php
            foreach( $args as $key => $value ):

                $name = $value['name'];
                $thumb = $value['thumb'];


                $checked = ($key == $option_value) ? "checked" : "";

                //var_dump($checked);

                ?>
                <label title="<?php echo $name; ?>" class="<?php if($checked =='checked') echo 'active';?>">
                    <input name='<?php echo $field_name; ?>' type='radio' id='<?php echo $id; ?>-<?php echo $key; ?>' value='<?php echo $key; ?>'  <?php echo $checked; ?>>
                    <?php // echo $name; ?>
                    <img src="<?php echo $thumb; ?>">
                </label>
            <?php

            endforeach;
            ?>
        </div>
        <script>
            jQuery(document).ready(function($){
                $(document).on('click', '.radio-img label', function () {
                    $(this).parent().children('label').removeClass('active');
                    $(this).addClass('active');
                })
            })
        </script>

        <style type="text/css">
            .radio-img{}
            .radio-img label{
                display: inline-block;
                vertical-align: top;
                margin: 0 0;
                padding: 2px;
                background: #eee;
            }

            .radio-img label.active{
                background: #fd730d;
            }

            .radio-img input[type=radio]{
                display: none;
            }
            .radio-img img{
                width: 150px;
                vertical-align: top;
            }

        </style>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);


    }





    public function field_colorpicker( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";

        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $value = !empty($value) ? $value : $default;

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;




        ob_start();
        ?>
        <input name='<?php echo $field_name; ?>' id='<?php echo $id; ?>' placeholder='<?php echo $placeholder; ?>' value="<?php echo $value; ?>" />
        <script>jQuery(document).ready(function($) { $('#<?php echo $id; ?>').wpColorPicker();});</script>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);
    }



    public function field_custom_html( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $html 	= isset( $option['html'] ) ? $option['html'] : "";


        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";


        echo sprintf($field_template, $title, $html, $details);







    }



}}