<div class="inner_con bg_grey">
	<div class="wraper fc_black">
	<h2 class="fw600 mart15 marb15 titel">Edit Your Profile</h2>
    	<div class="row">
          <div class="col-md-3 tac">
            	<div class="marb15"><img class="pro_img" src="img/alb1.jpg"></div>
                <h5 class="fw400 marb15">Account status:  <br>Active<br>(some information needed)</h5>
                <div><a class="btn_big bg_black" href="#">Edit Profile</a></div>
            </div>
            <div class="col-md-9">
            <?php
              $form = $this->beginWidget('CActiveForm', array(
                      'id'=>'users-form',
                      'enableClientValidation'=>true,
                      'enableAjaxValidation'=> true,
                      'clientOptions'=>array(
                          'validateOnChange'=>true,
                          'validateOnSubmit'=>true,
                      )
                  ));
            ?>
            <table cellspacing="0" cellpadding="0" border="1" width="100%" class="table">
              <tbody>
                <tr>
                  <td width="28%">Name:</td>
                  <td width="72%"><input type="text" value="Pavel Fomitchov" class="t_box"></td>
                </tr>
                <tr>
                  <td>Phone::</td>
                  <td><input type="text" value="408-555-1212" class="t_box"></td>
                </tr>
                <tr>
                  <td>Email:  </td>
                  <td><input type="text" value="pavel.fomitchov@gmail.com" class="t_box"></td>
                </tr>
                <tr>
                          <td>Sex: </td>
                          <td>                
                            <select class="chosen-select" style="display: none;">
                            <option>Male</option>
                            <option>Female</option>
                            </select><div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 64px;" title=""><a tabindex="-1" class="chosen-single"><span>Male</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div><ul class="chosen-results"></ul></div></div>
                		</td>
                        </tr>
                        <tr>
                          <td>Age: </td>
                          <td><input type="text" value="26" class="t_box"></td>
                        </tr>
                        <tr>
                          <td>Profile Access: </td>
                          <td>
                            <div class="row">
                            <div class="col-md-6">        
                                <label><input type="radio" name="status" class="r-box"> Public</label>
                            </div>
                            <div class="col-md-6">  
                                <label><input type="radio" name="status" class="r-box"> Private</label> 
                             </div>
                             </div>                          
                          </td>
                        </tr>
                        <tr>
                          <td>Link account:</td>
                          <td>
                            <div class="social"> <a class="bg_dblue" href="#"><i class="fa fa-facebook"></i></a> <a class="bg_sblue" href="#"><i class="fa fa-twitter"></i></a> <a class="bg_rblue" href="#"><i class="fa fa-linkedin"></i></a></div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
            </div> 
        </div>      
    </div>
</div>