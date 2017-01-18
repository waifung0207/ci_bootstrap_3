<div class="row mLR-pe-0">
 <div class="col-xs-12 col-sm-12 col-md-12 pL-pe-0 pR-pe-0">
 	<div class="col-xs-12 shift_left">
    <h2 class="text-center main-heading mB-pe-40">Sign Up</h2>
    <div class="input-field input-field-pe">
       <div  class="col-xs-6 col-md-6 pull-left pLR-pe-0">
       <input name="customers[customer_firstname]" id="customer_firstname" value="" class="my-input" tabindex="1"   type="text">
       
       <label class="my-label">First Name</label>
       </div>
       <div class="col-xs-6 col-md-6 pull-left pLR-pe-0">
       <input name="customers[customer_lastname]" id="customer_lastname" value="" class="my-input" tabindex="2"   type="text">
       
       <label class="my-label ">Last Name</label>
       </div>
    </div>
    <div class="input-field input-field-pe">
       <input class="my-input" id="customer_email" name="customers[customer_email]" value="PEtest@mailinator.com" tabindex="3"   type="text">
       
       <label class="my-label">Email</label>
    </div>
    <div class="input-field input-field-pe">
       <input class="my-input" id="customer_phone" name="customers[customer_phone]" value="" tabindex="4"   type="text">
       
       <label class="my-label">Phone</label>
    </div>
    <div class="input-field input-field-pe">
       <input name="customers[password]" id="password" value="" class="my-input" tabindex="5"   type="password">
       
       <label class="my-label">Password</label>
    </div>
    <div class="input-field input-field-pe">
       <input name="customers[confpassword]" id="confpassword" value="" class="my-input" tabindex="6"   type="password">
       
       <label class="my-label">Confirm Password</label>
    </div>
    <div class="input-field input-field-pe">
       <select name="customers[customer_refer_by]" id="refer_by_id" class="my-input" required="" tabindex="7">
       <option value=""></option>
       <option value="25">Photographer</option>
       <option value="85">Conference - United</option>
       <option value="94">Conference - Other</option>
       <option value="87">Trade Show - WPPI</option>
       <option value="93">Shoot and Share</option>
       <option value="89">Social Media - Facebook</option>
       <option value="90">Social Media - Twitter</option>
       <option value="91">Social Media - Instagram</option>
       <option value="92">Bokeh Podcast</option>
       <option value="26">Google Search</option>
       </select>
       
    			<label class="my-label">Referred By</label>
    </div>
    <input id="real_email" name="customers[real_email]" size="25" value="" type="text">
    <div class="input-field input-field-pe">
       <input class="my-input" id="customer_website" name="customers[customer_website]" value=""   tabindex="8" type="text">
       
       <label class="my-label">Website</label>
    </div>
    <div class="input-field input-field-pe">
    			<input checked="checked" class="mR-pe-10 pe-chk" name="customers[newsletter_subscription]"
        tabindex="8" value="1" type="checkbox">Subscribe to our Newsletter
    </div>
    <div class="input-field input-field-pe mT-pe-20-neg">
       <input id="terms" onclick="if (document.getElementById('terms').checked == true)
       document.getElementById('accterms').value = 1;
       else
       document.getElementById('accterms').value = 0;" class="mR-pe-10  pe-chk" tabindex="9" type="checkbox">I agree to the <span class="text-nowrap">PE <a href="http://support.photographersedit.com/hc/en-us/articles/114094835191-Terms-and-Conditions" target="_blank" class="underline-pe" >Terms &amp; Conditions</a></span>
       <input id="accterms" value="0" type="hidden">
    </div>
    <div class="input-field input-field-pe text-center mT-pe-30"><input class="continue" value="Submit" name="subAddDetail" tabindex="10" type="submit"></div>
       <input name="reseller_exempt_tax" id="reseller_exempt_tax" value="No" type="hidden">
       <input name="reseller_country" id="reseller_country" value="United States " type="hidden">
  </div>
 </div>
</div>