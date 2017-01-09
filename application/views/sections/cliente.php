<div class="modal animated bounce" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" style="font-weight:bold;"></h4>
          </div>
          <div class="modal-body">
              <p>...</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
              <button type="button" id="save" class="btn btn-success">GUARDAR</button>
          </div>
        </div>
    </div>
</div>

<div class="modal animated bounce" id="myModal2">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" style="font-weight:bold;"></h4>
          </div>
          <div class="modal-body">
              <p>...</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>             
          </div>
        </div>
    </div>
</div>

<div class="modal animated bounce" id="myModal3">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" style="font-weight:bold;"></h4>
          </div>
          <div class="modal-body">
              <p>...</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>             
          </div>
        </div>
    </div>
</div>

<div class="modal animated bounce" id="myModal4">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" style="font-weight:bold;"></h4>
          </div>
          <div class="modal-body">
              <p>...</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
              <button type="button" id="save_file" class="btn btn-success">GUARDAR</button>
          </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-default navbar-fixed-top shadow">
   <div class="container-fluid">
      <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
      <span class="sr-only">Toggle navigation</span>
         <i class="fa fa-bars" aria-hidden="true"></i>
      </button>
      <a class="navbar-brand" href="#"><b class="text-primary"><?php echo $this->site?></b><b>CRM</b></a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
         <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url()?>"> <i class="fa fa-home"></i> INICIO </a></li>
            <li><a href="<?php echo site_url('account/detalle')?>"> DETALLES </a></li>
            <li><a href="<?php echo site_url('account/rates')?>"> TARIFAS </a></li>
            <li><a href="<?php echo site_url('account/services')?>"> SERVICIOS </a></li>
            <li><a href="<?php echo site_url('account/places')?>"> LUGARES ATENCIÓN </a></li>
            <li><a href="<?php echo site_url('account/schedule')?>"> HORARIOS </a></li>
         </ul>

         <ul class="nav navbar-nav navbar-right">       
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
               <i class="fa fa-user"></i> <?php echo strtoupper($this->session->userdata("usuario"))?>, <?php echo $this->session->userdata("rol")?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
               <li>                 
                  <a href="#" data-url="<?php echo site_url('profiles/editar')?>" data-toggle="modal" data-target="#myModal" data-title="Perfiles" > MI PERFIL </a>
               </li>
               <li>
                  <a href="<?php echo site_url('logout')?>"> CERRAR SESIÓN</a>
               </li>
            </ul>
         </li>
         </ul>
      </div>
   </div>
</nav>
