<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <img alt="ABASTRA" src="...">
      </a>
      
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Faktury <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/invoice_controller/invoice_show_view"; ?>">Lista faktur</a></li>
            <li><a href="<?php echo base_url()."index.php/invoice_controller/invoice_add_view"; ?>">Dodaj fakturę</a></li>
          </ul>   
        </li>
      </ul>
      
       <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Klienci <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/customer_controller/customer_show_view"; ?>">Lista klientów</a></li>
            <li><a href="<?php echo base_url()."index.php/customer_controller/customer_add_view"; ?>">Dodaj klienta</a></li>
          </ul>          
        </li>
      </ul>
    </div>
  </div>
</nav>