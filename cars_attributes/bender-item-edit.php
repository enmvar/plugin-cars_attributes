<script type="text/javascript">
    $(document).ready(function(){
        $("#make").change(function(){
            var make_id = $(this).val();
            var url = '<?php echo osc_ajax_plugin_url('cars_attributes/ajax.php') . '&makeId='; ?>' + make_id;
            var result = '';
            if(make_id != '') {
                $("#model").attr('disabled',false);
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'json',
                    success: function(data){
                        var length = data.length;
                        if(length > 0) {
                            result += '<option value="" selected><?php _e('Select a model', 'cars_attributes'); ?></option>';
                            for(key in data) {
                                result += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
                            }
                        } else {
                            result += '<option value=""><?php _e('No results', 'cars_attributes'); ?></option>';
                        }
                        $("#model").html(result);
                    }
                 });
             } else {
                result += '<option value="" selected><?php _e('Select a model', 'cars_attributes'); ?></option>';
                $("#model").attr('disabled',true);
                $("#model").html(result);
             }
        });
    });
</script>

<?php
 echo '<script type="text/javascript" src="'.osc_base_url().'oc-content/plugins/cars_attributes/bender-cars-attributes.js"></script>';
?>
<h2><?php _e('Car details', 'cars_attributes') ; ?></h2>
 
<div>
     <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_make') != '' ) {
                $detail['fk_i_make_id'] = Session::newInstance()->_getForm('pc_make');
            }
        ?>
        <label class="control-label"><?php _e('Make', 'cars_attributes'); ?></label>
     <div class="controls">
       <div class="select-box undefined">
        <select name="make" id="make" style="opacity: 0">
            <option value="" class="mmcs1"><?php _e('Select a make', 'cars_attributes'); ?></option>
            <?php foreach($makes as $a){ ?>
            <option value="<?php echo $a['pk_i_id']; ?>" <?php if(@$detail['fk_i_make_id'] == $a['pk_i_id']) { echo 'selected'; } ?>><?php echo $a['s_name']; ?></option>                            
            <?php } ?>
        </select>
         <a class="select-box-trigger" href="#"><span class="select-box-label" id="mmcs2"></span>
                    <span class="select-box-icon"><div class="ico ico-20 ico-drop-down">0</div></span></a>
       </div>
      </div>
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_model') != '' ) {
                $detail['fk_i_model_id'] = Session::newInstance()->_getForm('pc_model');
            }
        ?>
        <label class="control-label"><?php _e('Model', 'cars_attributes'); ?></label>
     <div class="controls">
       <div class="select-box undefined">
        <select name="model" id="model" style="opacity: 0">
            <option value="" selected><?php _e('Select a model', 'cars_attributes'); ?></option>
            <?php foreach($models as $a) { ?>
            <option value="<?php echo $a['pk_i_id']; ?>" <?php if(@$detail['fk_i_model_id'] == $a['pk_i_id']) { echo 'selected'; } ?>><?php echo $a['s_name']; ?></option>
            <?php } ?>
        </select>
          <a class="select-box-trigger" href="#"><span class="select-box-label" id="mmcs3"></span>
                    <span class="select-box-icon"><div class="ico ico-20 ico-drop-down">0</div></span></a>
        </div>
      </div>      
    </div>
    <div class="control-group">
        <?php $locales = osc_get_locales();
        if( Session::newInstance()->_getForm('pc_car_type') != '' ) {
            $detail['fk_vehicle_type_id'] = Session::newInstance()->_getForm('pc_car_type');
        }
        if(count($locales)==1) {
            $locale = $locales[0]; ?>
            <p>
                <label class="control-label"><?php _e('Car type', 'cars_attributes'); ?></label>
             <div class="controls">
              <div class="select-box undefined">
                <select name="car_type" id="car_type" style="opacity: 0">
                    <option value="" selected><?php _e('Select a car type', 'cars_attributes'); ?></option>
                    <?php foreach($car_types[$locale['pk_c_code']] as $k => $v) { ?>
                    <option value="<?php echo  $k; ?>" <?php if(@$detail['fk_vehicle_type_id'] == $k) { echo 'selected'; } ?>><?php echo @$v; ?></option>
                    <?php } ?>
                </select>
                  <a class="select-box-trigger" href="#"><span class="select-box-label" id="mmcs4"></span>
                        <span class="select-box-icon"><div class="ico ico-20 ico-drop-down">0</div></span></a>
               </div>
              </div>
            </p>
        <?php } else { ?>
             <div class="control-group">
            <?php foreach($locales as $locale) {?>
                <div class="tabbertab">
                    <h2><?php echo $locale['s_name']; ?></h2>
                    <p>
                        <label class="control-label"><?php _e('Car type', 'cars_attributes'); ?></label>
                    <div class="controls">
                      <div class="select-box undefined">
                        <select name="car_type" id="car_type" style="opacity: 0">
                            <option value="" selected><?php _e('Select a car type', 'cars_attributes'); ?></option>
                            <?php foreach($car_types[$locale['pk_c_code']] as $k => $v) { ?>
                            <option value="<?php echo  $k; ?>" <?php if(@$detail['fk_vehicle_type_id'] == $k) { echo 'selected'; } ?>><?php echo @$v; ?></option>
                            <?php } ?>
                        </select>
                    </p>
                </div>
            <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_year') != '' ) {
                $detail['i_year'] = Session::newInstance()->_getForm('pc_year');
            }
        ?>
        <label class="control-label"><?php _e('Year', 'cars_attributes'); ?></label>
      <div class="controls">
        <input type="text" name="year" id="year" value="<?php echo @$detail['i_year']; ?>" size=4 />
      </div>
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_extColr') != '' ) {
                $detail['s_extColr'] = Session::newInstance()->_getForm('pc_extColr');
            }
        ?>
        <label class="control-label"><?php _e('Exterior Color', 'cars_attributes'); ?></label>
      <div class="controls">
        <input type="text" name="extColr" id="extColr" value="<?php echo @$detail['s_extColr']; ?>" size=10 />
      </div>
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_intColr') != '' ) {
                $detail['s_intColr'] = Session::newInstance()->_getForm('pc_intColr');
            }
        ?>
        <label class="control-label"><?php _e('Interior Color', 'cars_attributes'); ?></label>
      <div class="controls">
        <input type="text" name="intColr" id="intColr" value="<?php echo @$detail['s_intColr']; ?>" size=10 />
      </div>
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_doors') != '' ) {
                $detail['i_doors'] = Session::newInstance()->_getForm('pc_doors');
            }
        ?>
        <label class="control-label"><?php _e('Doors', 'cars_attributes'); ?></label>
      <div class="controls">
       <div class="select-box undefined">
        <select name="doors" id="doors" style="opacity: 0">
		<option value=""><?php _e('Select num. of doors', 'cars_attributes'); ?></option>
        <?php foreach(range(3, 5) as $n) { ?>
            <option value="<?php echo $n; ?>" <?php if(@$detail['i_doors'] == $n) { echo 'selected'; } ?>><?php echo $n; ?></option>
        <?php } ?>
        </select>
         <a class="select-box-trigger" href="#"><span class="select-box-label" id="mmcs5"></span>
                        <span class="select-box-icon"><div class="ico ico-20 ico-drop-down">0</div></span></a>
       </div>
      </div>
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_seats') != '' ) {
                $detail['i_seats'] = Session::newInstance()->_getForm('pc_seats');
            }
        ?>
        <label class="control-label"><?php _e('Seats', 'cars_attributes'); ?></label>
      <div class="controls">
       <div class="select-box undefined">
        <select name="seats" id="seats" style="opacity: 0">
		<option value=""><?php _e('Select num. of seats', 'cars_attributes'); ?></option>
            <?php foreach(range(1, 17) as $n) { ?>
            <option value="<?php echo $n; ?>" <?php if(@$detail['i_seats'] == $n) { echo 'selected'; } ?>><?php echo $n; ?></option>
            <?php } ?>
        </select>
          <a class="select-box-trigger" href="#"><span class="select-box-label" id="mmcs6"></span>
                        <span class="select-box-icon"><div class="ico ico-20 ico-drop-down">0</div></span></a>
       </div>
      </div>
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_mileage') != '' ) {
                $detail['i_mileage'] = Session::newInstance()->_getForm('pc_mileage');
            }
        ?>
        <label class="control-label"><?php _e('Mileage', 'cars_attributes'); ?></label>
       <div class="controls">
        <input type="text" name="mileage" id="mileage" value="<?php echo @$detail['i_mileage']; ?>" />
       </div>
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_engine_size') != '' ) {
                $detail['i_engine_size'] = Session::newInstance()->_getForm('pc_engine_size');
            }
        ?>
        <label class="control-label"><?php _e('Engine size (cc)', 'cars_attributes'); ?></label>
       <div class="controls">
        <input type="text" name="engine_size" id="engine_size" value="<?php echo @$detail['i_engine_size']; ?>" />
       </div>
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_num_airbags') != '' ) {
                $detail['i_num_airbags'] = Session::newInstance()->_getForm('pc_num_airbags');
            }
        ?>
        <label class="control-label"><?php _e('Num. Airbags', 'cars_attributes'); ?></label>
      <div class="controls">
       <div class="select-box undefined">
        <select name="num_airbags" id="num_airbags" style="opacity: 0">
			<option value=""><?php _e('Select num. of airbags', 'cars_attributes'); ?></option>
            <?php foreach(range(1, 8) as $n) { ?>
            <option value="<?php echo $n; ?>" <?php if(@$detail['i_num_airbags'] == $n) { echo 'selected'; } ?>><?php echo $n; ?></option>
            <?php } ?>
        </select>
         <a class="select-box-trigger" href="#"><span class="select-box-label" id="mmcs7"></span>
                        <span class="select-box-icon"><div class="ico ico-20 ico-drop-down">0</div></span></a>
       </div>
      </div>
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_transmission') != '' ) {
                $detail['e_transmission'] = Session::newInstance()->_getForm('pc_transmission');
            }
        ?>
        <label class="control-label"><?php _e('Transmission', 'cars_attributes'); ?></label>
      <div class="controls">
       <div class="select-box undefined">
        <select name="transmission" id="transmission" style="opacity: 0">
            <option value="MANUAL" <?php if(@$detail['e_transmission'] == 'MANUAL') { echo 'selected'; } ?>><?php _e('Manual', 'cars_attributes'); ?></option>
            <option value="AUTO" <?php if(@$detail['e_transmission'] == 'AUTO') { echo 'selected'; } ?>><?php _e('Auto', 'cars_attributes'); ?></option>
        </select>
         <a class="select-box-trigger" href="#"><span class="select-box-label" id="mmcs8"></span>
                        <span class="select-box-icon"><div class="ico ico-20 ico-drop-down">0</div></span></a>
       </div>
      </div>
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_fuel') != '' ) {
                $detail['e_fuel'] = Session::newInstance()->_getForm('pc_fuel');
            }
        ?>
        <label class="control-label"><?php _e('Fuel', 'cars_attributes'); ?></label>
      <div class="controls">
       <div class="select-box undefined">
        <select name="fuel" id="fuel" style="opacity: 0">
            <option value="DIESEL" <?php if(@$detail['e_fuel'] == 'DIESEL') { echo 'selected'; } ?>><?php _e('Diesel', 'cars_attributes'); ?></option>
            <option value="GASOLINE" <?php if(@$detail['e_fuel'] == 'GASOLINE') { echo 'selected'; } ?>><?php _e('Gasoline', 'cars_attributes'); ?></option>
            <option value="ELECTRIC-HIBRID" <?php if(@$detail['e_fuel'] == 'ELECTRIC-HIBRID') { echo 'selected'; } ?>><?php _e('Electric-hibrid', 'cars_attributes'); ?></option>
            <option value="OTHER" <?php if(@$detail['e_fuel'] == 'OTHER') { echo 'selected'; } ?>><?php _e('Other', 'cars_attributes'); ?></option>
        </select>
          <a class="select-box-trigger" href="#"><span class="select-box-label" id="mmcs9"></span>
                        <span class="select-box-icon"><div class="ico ico-20 ico-drop-down">0</div></span></a>
       </div>
      </div>
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_seller') != '' ) {
                $detail['e_seller'] = Session::newInstance()->_getForm('pc_seller');
            }
        ?>
        <label class="control-label"><?php _e('Seller', 'cars_attributes'); ?></label>
     <div class="controls">
       <div class="select-box undefined">
        <select name="seller" id="seller" style="opacity: 0">
            <option value="DEALER" <?php if(@$detail['e_seller'] == 'DEALER') { echo 'selected'; } ?>><?php _e('Dealer', 'cars_attributes'); ?></option>
            <option value="OWNER" <?php if(@$detail['e_seller'] == 'OWNER') { echo 'selected'; } ?>><?php _e('Owner', 'cars_attributes'); ?></option>
        </select>
           <a class="select-box-trigger" href="#"><span class="select-box-label" id="mmcs10"></span>
                        <span class="select-box-icon"><div class="ico ico-20 ico-drop-down">0</div></span></a>
       </div>
      </div>
    </div>
    <div class="controls checkbox">
        <?php
            if( Session::newInstance()->_getForm('pc_warranty') != '' ) {
                $detail['b_warranty'] = Session::newInstance()->_getForm('pc_warranty');
            }
        ?>
       
          <input type="checkbox" name="warranty" id="warranty" value="1" <?php if(@$detail['b_warranty'] == 1) { echo 'checked="yes"'; } ?> />
        
           <label class="control-label"><?php _e('Warranty','cars_attributes'); ?></label>
        
    </div>
    <div class="controls checkbox">
        <?php
            if( Session::newInstance()->_getForm('pc_new') != '' ) {
                $detail['b_new'] = Session::newInstance()->_getForm('pc_new');
            }
        ?>
        <input type="checkbox" name="new" id="new" value="1" <?php if(@$detail['b_new'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('New', 'cars_attributes'); ?></label class="control-label">
    </div>
    <div class="control-group">
        <?php
            if( Session::newInstance()->_getForm('pc_power_unit') != '' ) {
                $detail['e_power_unit'] = Session::newInstance()->_getForm('pc_power_unit');
            }
            if( Session::newInstance()->_getForm('pc_power') != '' ) {
                $detail['i_power'] = Session::newInstance()->_getForm('pc_power');
            }
        ?>
        <label class="control-label"><?php _e('Power', 'cars_attributes'); ?></label>
      <div class="controls">
        <input type="text" name="power" id="power" value="<?php echo @$detail['i_power']; ?>" />
      </div>
     <div class="controls">
       <div class="select-box undefined">
        <select name="power_unit" id="power_unit" style="opacity: 0">
            <option value="KW" <?php if(@$detail['e_power_unit'] == 'KW') { echo 'selected'; } ?>><?php _e('Kw', 'cars_attributes'); ?></option>
            <option value="CV" <?php if(@$detail['e_power_unit'] == 'CV') { echo 'selected'; } ?>><?php _e('Cv', 'cars_attributes'); ?></option>
            <option value="CH" <?php if(@$detail['e_power_unit'] == 'CH') { echo 'selected'; } ?>><?php _e('Ch', 'cars_attributes'); ?></option>
            <option value="KM" <?php if(@$detail['e_power_unit'] == 'KM') { echo 'selected'; } ?>><?php _e('Km', 'cars_attributes'); ?></option>
            <option value="HP" <?php if(@$detail['e_power_unit'] == 'HP') { echo 'selected'; } ?>><?php _e('Hp', 'cars_attributes'); ?></option>
            <option value="PS" <?php if(@$detail['e_power_unit'] == 'PS') { echo 'selected'; } ?>><?php _e('Ps', 'cars_attributes'); ?></option>
            <option value="PK" <?php if(@$detail['e_power_unit'] == 'PK') { echo 'selected'; } ?>><?php _e('Pk', 'cars_attributes'); ?></option>
            <option value="CP" <?php if(@$detail['e_power_unit'] == 'CP') { echo 'selected'; } ?>><?php _e('Cp', 'cars_attributes'); ?></option>
        </select>
           <a class="select-box-trigger" href="#"><span class="select-box-label" id="mmcs11"></span>
                        <span class="select-box-icon"><div class="ico ico-20 ico-drop-down">0</div></span></a>
       </div>
      </div>
    </div>
    <div class="control-group">
        <?php if( Session::newInstance()->_getForm('pc_gears') != '' ) {
                $detail['i_gears'] = Session::newInstance()->_getForm('pc_gears');
            }
        ?>
        <label class="control-label"><?php _e('Gears', 'cars_attributes'); ?></label>
      <div class="controls">
       <div class="select-box undefined">
        <select name="gears" id="gears" style="opacity: 0">
		<option value=""><?php _e('Select num. of gears', 'cars_attributes'); ?></option>
        <?php foreach(range(1, 8) as $n) { ?>
            <option value="<?php echo $n; ?>" <?php if(@$detail['i_gears'] == $n) { echo 'selected'; } ?>><?php echo $n; ?></option>
        <?php } ?>
        </select>
           <a class="select-box-trigger" href="#"><span class="select-box-label" id="mmcs12"></span>
                        <span class="select-box-icon"><div class="ico ico-20 ico-drop-down">0</div></span></a>
        </div>
       </div>
    </div>
</div>

<script type="text/javascript">
    tabberAutomatic();
</script>
