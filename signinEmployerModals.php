<!--HTML code for sign in page-->

<?php ?>

<!-- Modal -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-------------------------------------------------------------------LOG IN PAGE--------------------------------------------------------------------------->
<div class="modal fade" id="myEmployerModal" tabindex="-1" role="dialog" aria-labelledby="myEmployerModalLabel" style="background-image:url('img/back3.png'); background-size: cover; background-repeat: no-repeat;">
<div class="modal-dialog" role="document" >
<div class="modal-content" style="background-image: url(img/back1.png); box-shadow: 10px 10px 20px #1e1e1e;">
<div class="modal-header">
<button id="empSignInCloseBtn" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="myEmployerModalLabel" style="font-family:Arial Black; color:black"><center><strong>Sign In</center></strong></h3>
</div>
<div class="modal-body"> 					
<div id="cd-login">
<form class="cd-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">					           

<p class="fieldset">
<label class="cd-email" for="eemail" style="color: black; font-size:15px; font-family:Arial Black">E-mail</label>
<input class="full-width has-padding has-border" id="email" name="email" type="email" placeholder="E-mail">
<span class="cd-error-message">Error message here!</span>
</p>

<p class="fieldset">
<label class="cd-password" for="epass" style="color: black; font-size:15px; font-family:Arial Black">Password</label>
<input class="full-width has-padding has-border" id="password" name="password" type="password"  placeholder="Password">
<a href="#0" class="hide-password">Show</a>
<div id="loginresult" style="display:none">Error message here!</div>
</p>

<input type="hidden" id="currentPage" name="currentPage" value="<?php echo $_SERVER['PHP_SELF']; ?>"
<p class="fieldset">
<input id="loginsubmit" class="full-width" type="submit" name="loginsubmit" id="login" value="Login">
</p>
</form>
				
<p class="cd-form-bottom-message">
<button id="regNowBtn" class="btn btn-default"  data-toggle="modal" data-target="#empsignup"  style="color: brown;" > Register Now</button></p>
<button id="regEmpModalBtn" style="display:none;"  data-toggle="modal" data-target="#empsignup" >
</button>                             
</div></div>
<div class="modal-footer"></div>
</div></div></div> 

<!------------------------------------------------------------------REGISTRRATION FORM------------------------------------------------------------------------>
<div class="modal fade" id="empsignup" tabindex="-1" role="dialog" aria-labelledby="myEmployerModalLabel">
<div class="modal-dialog" >
<div class="modal-content" style="background-image: url(img/back1.png); box-shadow: 10px 10px 20px #1e1e1e;">
<div class="modal-header">
<button id="signUpCloseBtn" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="myEmployerModalLabel" style="font-family:Arial Black; color:black "><center><strong>New Account</strong></center></h3>
</div>
<div class="modal-body">
<div id="cd-empsignup">
<div id="result" style="display:none;"></div>
<div class="container">

<ul class="nav nav-tabs" style="width: 36%; margin-left:5%">
<li class="active"><a data-toggle="tab" href="#home" style="color:black" ><strong>Organization Registeration</strong></a></li>
<li><a data-toggle="tab" href="#menu1" style="color:black"><strong>Candidate Registeration</strong></a></li> 
</ul>

<div class="tab-content">

<div id="home" class="tab-pane fade in active" style="width: 50%;">
<form class="cd-form col-md-12" method="post" action="registerEmployer.php" enctype="multipart/form-data">
<p class="fieldset">
<label class="cd-username" for="empsignup-username" style="color: black; font-size:15px; font-family:Arial Black">Organization Name</label>
<input class="full-width has-padding has-border" id="name" name="name" type="text" placeholder="Organization Name" required>
</p>
<p class="fieldset">
<label class="cd-email" for="empsignup-email" style="color: black; font-size:15px; font-family:Arial Black">E-mail</label>
<input class="full-width has-padding has-border" id="email" name="email" type="email" placeholder="E-mail" required>
</p>

<p class="fieldset">
<label class="cd-password" for="empsignup-password" style="color: black; font-size:15px; font-family:Arial Black">Password</label>
<input class="full-width has-padding has-border" id="password" name="password" type="password"  placeholder="Password" 
title="Password must contain at least 7 characters, including at least one numeric digit and a special character" 
required pattern="(?=.*[0-9])(?=.*[!@#$%^&*_])[a-zA-Z0-9!@#$%^&*_]{7,15}"  onchange=" this.setCustomValidity(this.validity.patternMismatch ? this.title : '');">
<a href="#0" class="hide-password">Show</a>
</p>

<p class="fieldset">
<label class=" cd-password" for="logo" style="color: black; font-size:15px; font-family:Arial Black">Logo</label>
<input class="full-width has-padding has-border" id="logo" name="logo" type="file">												
</p>
<p class="form-group">
<button id="regsubmit" class="full-width has-padding btn-success"  style="padding:10px; box-shadow: 0px 0px 20px #156785;">Create account</button>
</p>
</form>
</div>
<!-----------------------------------------------------------------CANDIDATE REGISTRRATION------------------------------------------------------------------>
<div id="menu1" class="tab-pane fade"  style="width: 50%;">
<form class="cd-form" method="post" action="registerJobseeker.php" enctype="multipart/form-data">
<p class="fieldset">
<label class="cd-username" for="empsignup-username" style="color: black; font-size:15px; font-family:Arial Black">Candidate Name</label>
<input class="full-width has-padding has-border" id="name" name="name" type="text" placeholder="Candidate Name" required>						
</p>

<p class="fieldset">
<label class="cd-email" for="empsignup-email" style="color: black; font-size:15px; font-family:Arial Black">E-mail</label>
<input class="full-width has-padding has-border" id="email" name="email" type="email" placeholder="E-mail" required>						
</p>

<p class="fieldset">
<label class="cd-password" for="empsignup-password" style="color: black; font-size:15px; font-family:Arial Black">Password</label>
<input class="full-width has-padding has-border" id="password" name="password" type="password"  placeholder="Password" 
title="Password must contain at least 7 characters, including at least one numeric digit and a special character" 
required pattern="(?=.*[0-9])(?=.*[!@#$%^&*_])[a-zA-Z0-9!@#$%^&*_]{7,15}"  onchange=" this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" required>
<a href="#0" class="hide-password">Show</a>					
</p>

<p class="fieldset">
<label class="cd-username" for="empsignup-username" style="color: black; font-size:15px; font-family:Arial Black">Organization Name</label>
<?php include "orgOptions.php";?>
</p>

<p class="fieldset">
<label class="cd-username" for="empsignup-username" style="color: black; font-size:15px; font-family:Arial Black">USN</label>
<input class="full-width has-padding has-border" id="usn" name="usn" type="text" placeholder="USN" required>
</p>

<p class="fieldset">
<label class="cd-username" for="empsignup-username" style="color: black; font-size:15px; font-family:Arial Black">Branch</label>
<?php include "branchOptions.php";?>
</p>

<p class="fieldset">
<label class="cd-username" for="empsignup-username" style="color: black; font-size:15px; font-family:Arial Black">Phone Number</label>
<input class="full-width has-padding has-border" id="tel" name="tel" type="text" placeholder="Phone Number" required pattern="[0-9]{10}"  required>
</p>

<p class="fieldset">
<label class="cd-username" for="empsignup-username" style="color: black; font-size:15px; font-family:Arial Black">Date of Birth</label>
<input class="full-width has-padding has-border" id="dob" name="dob" type="date" placeholder="Date of Birth"  required>
</p>

<p class="form-group">
<button id="regsubmit" class="full-width has-padding btn-success" style="padding:10px; box-shadow: 0px 0px 20px #156785;">Create account</button>
</p>
</form>

</div></div></div>
</div></div></div></div></div>

<div><button id="regEmpSuccessSubmit" data-toggle="modal" data-target="#regEmpSuccess" style="display: none">Success Message</button></div>

  <!-- Success Modal -->
<div class="modal fade" id="regEmpSuccess" tabindex="-1" role="dialog" aria-labelledby="myEmployerModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button id="empSignInCloseBtn" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myEmployerModalLabel"> Registration Successful! </h4>
</div>
<div class="modal-body">
<div id="cd-login">

<br><span>Login to continue</span>
<div class="center-block">
<button id="cancelEmpregModal" type="button" class="btn btn-default" data-dismiss="modal"  style="width: 150px;">Done</button>   
</div>
</div></div></div></div></div> 

<script src="js/registerUser.js"></script>	
 
