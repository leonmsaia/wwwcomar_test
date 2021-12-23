<div class="col-12">
   <div class="row">
      <div class="col"></div>
      <div class="col-6">
         <main class="form-signin" style="margin-top:10vh;">
            <?php if($this->session->flashdata('login_error')): ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('login_error') ?>
              </div>
            <?php endif ?>
            <?php echo form_open("user_controller/doLogin");?>
               <div class="card">
                  <div class="card-body" style="text-align:center;">
                     <p class="h1 card-title" >WWWCOMAR - Testing System</p>
                     <div class="card-body">
                       <h1 class="h3 mb-3 fw-normal">Iniciar Sesión</h1>
                     </div>
                  </div>
               </div>
               <div class="form-floating">
                  <input type="email" class="form-control" name="user_val" id="user_val">
                  <label for="user_val">Usuario</label>
               </div>
               <div class="form-floating">
                  <input type="password" class="form-control" name="user_pass" id="user_pass">
                  <label for="user_pass">Contraseña</label>
               </div>
               <input type="hidden" name="_noval_ue" value="" readonly>
               <button class="w-100 btn btn-lg btn-primary" type="submit">Acceder</button>
            <?php echo form_close();?>
         </main>
      </div>
      <div class="col"></div>
   </div>
</div>
