<html>
	<body>
		<?php
		  echo form_open("invoice_controller/invoice_pdf_download/".$fromController[__DB_INVOICES_INVOICEID__]);
		  echo form_submit( "Pobierz PDF");
		  echo form_close();
		?>	
	</body>
</html>