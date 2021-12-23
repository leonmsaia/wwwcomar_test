<div class="col-12">

   <div class="row" style="margin-top:10vh;">
     <div class="col-12">
       <div class="row" style="margin-bottom: 20px;">
         <div class="col-5"></div>
         <div class="col-2">
           <a href="<?php echo base_url() . 'user_controller/doLoginOut';?>" class="w-100 btn btn-lg btn-primary">Cerrar Sesion</a>
         </div>
         <div class="col-5"></div>
       </div>
     </div>
      <div class="col"></div>
      <div class="col-6">

        <?php foreach ($user_data->result() as $usr_dt): ?>
          <main class="row">
            <div class="col-12">
              <?php if($this->session->flashdata('login_grant')): ?>
                <div class="alert alert-success" role="alert">
                  <?php echo $this->session->flashdata('login_grant') ?>
                </div>
              <?php endif ?>
            </div>
            <div class="col-12">
              <div class="row">
                <?php echo form_open(base_url() . 'user_controller/uploadPicture', 'class="col-12" enctype="multipart/form-data"');?>
                <div class="card col-12">
                  <div class="row" style="margin-top:15px;">
                    <div class="col-4"></div>
                    <div class="col-4">
                      <input type="file" name="userfile" id="profile_pic" value="" style="display:none;">
                      <?php if ($usr_dt->user_picturepath == NULL): ?>
                        <img id="profile_pic_trigger" src="<?php echo base_url() . 'assets/images/profile.jpg';?>" alt="profile_pic" class="card-img-top" style="cursor:pointer;">
                      <?php else: ?>
                        <img id="profile_pic_trigger" src="<?php echo $usr_dt->user_picturepath;?>" alt="profile_pic" class="card-img-top" style="cursor:pointer;">
                      <?php endif; ?>
                    </div>
                    <div class="col-4"></div>
                    <div class="card-body col-12" style="text-align:center;">
                      <p class="card-text">Haga Click para cargar una foto de perfil</p>
                      <input class="w-100 btn btn-lg btn-primary" type="submit" name="" value="Guardar Fotografia">
                    </div>
                  </div>
                </div>
                <?php echo form_close();?>
              </div>
              <div class="row">
                <?php echo form_open("user_controller/update_user_information", 'class="col-12"');?>
                    <div class="form-floating">
                      <input type="text" class="form-control" name="user_name_val" id="user_name_val" value="<?php echo $usr_dt->user_firstname;?>">
                      <label for="user_name_val">Nombre</label>
                    </div>
                    <div class="form-floating">
                      <input type="text" class="form-control" name="user_lastname_val" id="user_lastname_val" value="<?php echo $usr_dt->user_lastname;?>">
                      <label for="user_lastname_val">Apellido</label>
                    </div>
                    <div class="form-floating">
                      <input type="text" class="form-control" name="user_dni_val" id="user_dni_val" value="<?php echo $usr_dt->user_dni;?>">
                      <label for="user_dni_val">DNI</label>
                    </div>
                    <div class="form-floating">
                      <input type="email" class="form-control" name="user_mail_val" id="user_mail_val" value="<?php echo $usr_dt->user_mail;?>">
                      <label for="user_mail_val">Mail (* Requiere reiniciar sesion)</label>
                    </div>
                  <button class="w-100 btn btn-lg btn-primary" type="submit">Guardar</button>
                <?php echo form_close();?>
              </div>

            </div>
          </main>
        <?php endforeach; ?>
      </div>
      <div class="col"></div>
   </div>
</div>

<script>
  // Profile Picture Trigger
  $('#profile_pic_trigger').click(function() {
    $('#profile_pic').trigger('click');
  });
</script>
