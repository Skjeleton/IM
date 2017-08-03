<div class="container">
		<?php 
		  /*echo "<pre>";
		  var_dump($fromController); 
		  echo "</pre>";/**/
		?>
	<ul class="nav nav-pills">
		<li><a href="preVal" data-toggle="tab">Wartości predefiniowane</a></li>
		<li><a href="cycleInv" data-toggle="tab">Faktury cykliczne</a></li>
	</ul>
	<div id="preVal">
		<?php
		  $inputStart = "<div>";
		  $inputEnd = "</div>";
		  echo form_open("config_controller/update_config");
		  
		  // Default payment method
		  echo $inputStart;
		  echo form_label("Domyślny sposób płatności:");
		  $title = __CONFKEY_DEFAULT_PAYMENTMETHOD__;
		  $data = array(
		      "id" => $title,
		      "value" => $fromController[$title]
		  );
		  echo form_input($data);
		  $data = array(
		      "type" => "button",
		      "onclick" => "updateConfig('".$data["id"]."')"
		  );
		  echo form_button($data, "Zatwierdź zmiany");
		  echo $inputEnd;
		  
		  // Default payment delay
		  echo $inputStart;
		  echo form_label("Domyślny okres zapłaty za fakturę:");
		  $title = __CONFKEY_DEFAULT_PAYMENTDELAY__;
		  $data = array(
		      "id" => $title,
		      "value" => $fromController[$title]
		  );
		  echo form_input($data);
		  echo "dni";
		  $data = array(
		      "type" => "button",
		      "onclick" => "updateConfig('".$data["id"]."')"
		  );
		  echo form_button($data, "Zatwierdź zmiany");
		  echo $inputEnd;
		  
		  // Default language
		  echo $inputStart;
		  echo form_label("Domyślny język faktur:");
		  $title = __CONFKEY_DEFAULT_LANGUAGE__;
		  $data = array(
		      "id" => $title,
		      "value" => $fromController[$title]
		  );
		  echo form_input($data);
		  $data = array(
		      "type" => "button",
		      "onclick" => "updateConfig('".$data["id"]."')"
		  );
		  echo form_button($data, "Zatwierdź zmiany");
		  echo $inputEnd;
		  
		  // Default currency
		  echo $inputStart;
		  echo form_label("Domyślna waluta faktur:");
		  $title = __CONFKEY_DEFAULT_CURRENCY__;
		  $data = array(
		      "id" => $title,
		      "value" => $fromController[$title]
		  );
		  echo form_input($data);
		  $data = array(
		      "type" => "button",
		      "onclick" => "updateConfig('".$data["id"]."')"
		  );
		  echo form_button($data, "Zatwierdź zmiany");
		  echo $inputEnd;
		  
		  // Default countries
		  echo $inputStart;
		  echo form_label("Lista państw domyślnych:");
		  $title = __CONFKEY_DEFAULT_COUNTRIES__;
		  $data = array(
		      "id" => $title,
		      "value" => implode(', ', $fromController[$title])
		  );
		  echo form_textarea($data);
		  $data = array(
		      "type" => "button",
		      "onclick" => "updateConfig('".$data["id"]."', true)"
		  );
		  echo form_button($data, "Zatwierdź zmiany");
		  echo $inputEnd;
		  
		  echo form_close();
		?>	
	</div>
	<div id="cycleInv">
	
	</div>
</div>
<script>
	var userId = "<?php echo $fromController[__DB_CONFIG_USER__]; ?>";
	var rootLocation = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url()."/js/configUpdater.js"; ?>"></script>