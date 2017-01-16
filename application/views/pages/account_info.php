<div class="row">
 <div class="col-xs-12 col-sm-12 col-md-12 pL-pe-0 pR-pe-0">
 	<div class="detail_pg mLR-pe-auto">
     <h2 class="text-center main-heading">Account Details</h2>
     <form id="detail" name="detail" method="post" action="https://oldpe.photographersedit.com/account_details" style="margin:0px;padding:0px;" novalidate>	
       <input name="reseller_exempt_tax" id="reseller_exempt_tax" value="No" type="hidden"> 
       <input name="reseller_country" id="reseller_country" value="United States " type="hidden">
       <!-- below line will check if CC details need to be updated. If value is 1 it will update-->
       <input name="updateCcDetails" id="updateCcDetails" value="0" type="hidden">
       <input name="subAddDetail2" value="Save" style="position: absolute; height: 0px; width: 0px; border: none; padding: 0px; visibility: hidden;" hidefocus="true" tabindex="-1" type="submit">
       <!-------------------------- row1 starts----------------------------->
       <div class="row mLR-pe-0">
       <div class="col-xs-12 col-md-5">
       <div class="col-xs-12" id="self_info">
            <h2 class="text-center info_subheading mB-pe-40">Personal Details</h2>
            <div class="form-group form-group-pe">
            <input name="customers[customer_firstname]" value="Santosh" id="customer_firstname" tabindex="1" class="my-input" required type="text">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label class="my-label">First Name</label>
            </div>
            <div class="form-group form-group-pe">
            <input name="customers[customer_lastname]" id="customer_lastname" value="Deo" tabindex="2" class="my-input" required type="text">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label class="my-label">Last Name</label>
            </div>
            <div class="form-group form-group-pe">
            <input name="customers[customer_phone]" id="customer_phone" value="1234567890" tabindex="3" class="my-input" required type="text">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label class="my-label">Phone</label>
            </div>
            <div class="form-group form-group-pe">
            <input name="customers[company_name]" value="Tiuconsulting" id="company_name" tabindex="4" class="my-input" required type="text">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label class="my-label">Company Name</label>
            </div>
            <div class="form-group form-group-pe">
            <input name="customers[customer_website]" value="http://www.tiuconsulting.com" id="customer_website" tabindex="5" class="my-input" required type="text">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label class="my-label">Website</label>
            </div>
            <!-- Login info -->
            <div class="form-group form-group-pe">
            <input class="my-input" required name="customers[customer_email]" value="sdeo@tiuconsulting.com" tabindex="6" type="text">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label class="my-label">Email</label>
            </div>
            <div class="form-group form-group-pe">
            <input readonly class="my-input" required id="customer_password" name="customers[customer_password]" value="santyad31" tabindex="7" type="password">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label class="my-label" style="font-size: 12px; top: -16px; outline-style:none!important;">Password</label>
            </div>
            <div class="form-group form-group-pe">
            <input readonly class="my-input" id="customer_confirm_password" required name="customers[customer_confirm_password]" value="santyad31" tabindex="8" type="password">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label class="my-label" style="font-size: 12px; top: -16px;  outline-style:none!important;">Confirm Password</label>
            </div>
            <!-- Login info end -->
            <div class="form-group form-group-pe">
            <select name="customers[customer_refer_by]" id="refer_by_id" class="my-input" tabindex="9">
            <option value="">Please Select</option>
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
            <span class="highlight"></span>
            <span class="bar"></span>
            <label class="my-label">Referred By</label>
            </div>
       </div>
       <div class="col-xs-12 hide" id="self_info">
       <h2 class="text-center info_subheading mB-pe-40 mT-pe-20">Email Notifications</h2>
       <div class="form-group form-group-pe" style="margin-bottom:17px;">
       <input name="newsletter_subscription_service_related" id="subscrb_service_related" tabindex="10" value="0" onclick="subscription('subscrb_service_related','newsletter_subscription_service_related');" style="float:left;" type="checkbox"> 
       <span class="chk_txt">Subscribe to new update and service-related announcements</span> 
       <input id="newsletter_subscription_service_related" name="customers[newsletter_subscription_service_related]" value="0" type="hidden">
       </div>
       <div class="form-group form-group-pe" style="margin-bottom:17px;">
       <input name="newsletter_subscription_special_promotions" id="subscrb_special_promotions" tabindex="10" value="0" onclick="subscription('subscrb_special_promotions','newsletter_subscription_special_promotions');" style="float:left;" type="checkbox"> 
       <span class="chk_txt">Subscribe to special promotions</span>  
       <input id="newsletter_subscription_special_promotions" name="customers[newsletter_subscription_special_promotions]" value="0" type="hidden">
       </div>
       </div>
       <div class="col-xs-12" id="self_info">
       <h2 class="text-center info_subheading">
       Membership Details</h2>
       <table class="membershiptable" width="100%" cellspacing="0px" cellpadding="0px">
       <thead>
       <tr>
       <th class="my_height" valign="top" align="center">
       Account Created: Jul 20, 2011
       </th>
       </tr>
       <tr>
       <th class="my_height" valign="top" align="center">
       Membership Level: Freedom Individual
       </th>
       </tr>
       <tr>
       <th class="my_height" valign="top" align="center">
       Membership Began: Dec  7, 2016
       </th>
       </tr>
       <tr>
       <th class="my_height" valign="top" align="center">
       Membership Renews: Dec  7, 2017
       </th>
       </tr>
       <tr>
       <th class="my_height" valign="top" align="center">
       Next Bill Occures: Feb  7, 2017
       </th>
       </tr>
       </thead>
       <tbody>
       <tr>
       <td valign="bottom" align="left">
       <div class="form-group form-group-pe" style="margin-bottom:17px;">
       <input name="newsletter_subscription" id="subscrb" tabindex="10" value="0" onclick="subscription('subscrb','newsletter_subscription');" style="float:left;" type="checkbox"> 
       <span class="chk_txt">Subscribe to the PE Newsletter</span>  
       <input id="newsletter_subscription" name="customers[newsletter_subscription]" value="0" type="hidden">
       </div>
       </td>
       </tr>
       <tr>
       <td style="text-align:center;" valign="bottom" align="center">
       <!--<a href="#" class="continue" id="OpenDialog" >Cancel Membership </a>-->
       <a href="#" class="continue" id="confirmcancel1">Cancel Membership </a>
       </td>
       </tr>
       <tr><td>&nbsp;</td></tr>
       </tbody>
       </table>
       </div>
       </div>
       <!-----------------------------Column 1 Ends------------------------> 
       <!-----------------------------Column 2 Starts------------------------>          
       <div class="col-xs-12 col-md-2 mob_blank"></div>              
       <!-----------------------------Column 2 Ends------------------------> 
       <!-----------------------------Column 3 Starts------------------------> 
       <div class="col-xs-12 col-md-5">
       <div class="col-xs-12" id="self_info_last">
       <div id="self_info" style="margin-bottom:0px; float:left; border:solid 0px #000; padding-bottom:0px;">
       <h2 class="text-center info_subheading mB-pe-40">Credit Card Details</h2>
       <div class="form-group form-group-pe">
       <input onclick="readonlyfileds()" name="craeditCardOption" id="craeditCardOption_old_card" value="old_card" checked="checked" tabindex="11" type="radio"> Use Existing Card(************1111)
       <input name="customers[pay_trace_customer_id]" id="pay_trace_customer_id" value="3162Santosh3889" type="hidden">
       
       </div>	
       <div class="form-group form-group-pe">
       <input onclick="readonlyfileds()" name="craeditCardOption" id="craeditCardOption_new_card" value="new_card" style="margin-top:5px;" tabindex="12" type="radio"> Enter New Credit Card
       </div>
       <div id="newcardform" style="display:none;">                  
       <div class="form-group form-group-pe">
       <input name="customers[credit_card][card_number]" id="card_number" value="" tabindex="13" onchange="updateCC();" class="my-input" required type="text">
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="my-label">Card Number</label>
       </div>
       <div class="form-group form-group-pe">
       <div style="float:left; width:46%">  
       <select name="customers[credit_card][expire_month]" id="user_credit_card_expire_month" style="width:100%;" tabindex="14" onchange="updateCC();" class="my-input">
       <option value="">MM</option>
       <option value="1">1</option>                   
       <option value="2">2</option>                   
       <option value="3">3</option>                   
       <option value="4">4</option>                   
       <option value="5">5</option>                   
       <option value="6">6</option>                   
       <option value="7">7</option>                   
       <option value="8">8</option>                   
       <option value="9">9</option>                   
       <option value="10">10</option>                   
       <option value="11">11</option>                   
       <option value="12">12</option>                   
       </select>
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="my-label">Expiration Date</label>
       </div>
       <div style="float:right; margin-left:2%; width:46%">
       <select name="customers[credit_card][expire_year]" id="user_credit_card_expire_year" tabindex="15" style="width:100%;" onchange="updateCC();" class="my-input">
       <option value="">YYYY</option>
       <option value="2010">2010</option>
       <option value="2011">2011</option>
       <option value="2012">2012</option>
       <option value="2013">2013</option>
       <option value="2014">2014</option>
       <option value="2015">2015</option>
       <option value="2016">2016</option>
       <option value="2017">2017</option>
       <option value="2018">2018</option>
       <option value="2019">2019</option>
       <option value="2020">2020</option>
       <option value="2021">2021</option>
       <option value="2022">2022</option>
       <option value="2023">2023</option>
       <option value="2024">2024</option>
       <option value="2025">2025</option>
       <option value="2026">2026</option>
       <option value="2027">2027</option>
       <option value="2028">2028</option>
       <option value="2029">2029</option>
       </select>
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="my-label">&nbsp;</label>
       </div>                  
       </div> 
       <div class="form-group form-group-pe">
       <input id="card_cvv" name="customers[credit_card][cvv]" value="" tabindex="16" onchange="updateCC();" class="my-input" required type="password">
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="my-label">Security Code (CVV) </label>
       </div>
       </div>  
       </div>        
       </div> 
       <!--------------------------------billing Detail Starts----------------->
       <div id="self_info_last_billing" class="col-xs-12">
       <h2 class="text-center info_subheading mB-pe-40">Billing Details</h2>
       <div class="form-group form-group-pe">
       <input name="customers[billing_name]" id="billing_name" value="Santosh Deo" tabindex="17" class="my-input" required type="text">
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="my-label">Name</label>
       </div>
       <div class="form-group form-group-pe">
       <input name="customers[billing_address]" id="billing_address" value="College road test dd" tabindex="18" class="my-input" required type="text">
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="my-label">Street 1</label>
       </div>
       <div class="form-group form-group-pe">
       <input name="customers[billing_address2]" id="billing_address2" value="New laxmi nagar" tabindex="19" class="my-input" required type="text">
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="my-label">Street 2</label>
       </div>
       <div class="form-group form-group-pe">
       <input name="customers[billing_city]" id="billing_city" value="Gondia" tabindex="20" class="my-input" required type="text">
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="my-label">City</label>
       </div>	
       <div class="form-group form-group-pe">
       <select name="customers[billing_country]" id="billing_country" tabindex="21" class="my-input">
       <option value="">Please Select</option>
       <option value="AF">Afghanistan</option>
       <option value="AL">Albania</option>
       <option value="DZ">Algeria</option>
       <option value="AS">American Samoa</option>
       <option value="AD">Andorra</option>
       <option value="AO">Angola</option>
       <option value="AI">Anguilla</option>
       <option value="AQ">Antarctica</option>
       <option value="AG">Antigua And Barbuda</option>
       <option value="AR">Argentina</option>
       <option value="AM">Armenia</option>
       <option value="AW">Aruba</option>
       <option value="AU">Australia</option>
       <option value="AT">Austria</option>
       <option value="AZ">Azerbaijan</option>
       <option value="BS">Bahamas</option>
       <option value="BH">Bahrain</option>
       <option value="BD">Bangladesh</option>
       <option value="BB">Barbados</option>
       <option value="BY">Belarus</option>
       <option value="BE">Belgium</option>
       <option value="BZ">Belize</option>
       <option value="BJ">Benin</option>
       <option value="BM">Bermuda</option>
       <option value="BT">Bhutan</option>
       <option value="BO">Bolivia</option>
       <option value="BA">Bosnia And Herzegowina</option>
       <option value="BW">Botswana</option>
       <option value="BV">Bouvet Island</option>
       <option value="BR">Brazil</option>
       <option value="IO">British Indian Ocean Territory</option>
       <option value="BN">Brunei Darussalam</option>
       <option value="BG">Bulgaria</option>
       <option value="BF">Burkina Faso</option>
       <option value="BI">Burundi</option>
       <option value="KH">Cambodia</option>
       <option value="CM">Cameroon</option>
       <option value="CA">Canada</option>
       <option value="CV">Cape Verde</option>
       <option value="KY">Cayman Islands</option>
       <option value="CF">Central African Republic</option>
       <option value="TD">Chad</option>
       <option value="CL">Chile</option>
       <option value="CN">China</option>
       <option value="CX">Christmas Island</option>
       <option value="CC">Cocos (keeling) Islands</option>
       <option value="CO">Colombia</option>
       <option value="KM">Comoros</option>
       <option value="CG">Congo</option>
       <option value="CK">Cook Islands</option>
       <option value="CR">Costa Rica</option>
       <option value="CI">Cote D'ivoire</option>
       <option value="HR">Croatia</option>
       <option value="CU">Cuba</option>
       <option value="CY">Cyprus</option>
       <option value="CZ">Czech Republic</option>
       <option value="DK">Denmark</option>
       <option value="DJ">Djibouti</option>
       <option value="DM">Dominica</option>
       <option value="DO">Dominican Republic</option>
       <option value="TP">East Timor</option>
       <option value="EC">Ecuador</option>
       <option value="EG">Egypt</option>
       <option value="SV">El Salvador</option>
       <option value="GQ">Equatorial Guinea</option>
       <option value="ER">Eritrea</option>
       <option value="EE">Estonia</option>
       <option value="ET">Ethiopia</option>
       <option value="FK">Falkland Islands (malvinas)</option>
       <option value="FO">Faroe Islands</option>
       <option value="FJ">Fiji</option>
       <option value="FI">Finland</option>
       <option value="FR">France</option>
       <option value="FX">France, Metropolitan</option>
       <option value="GF">French Guiana</option>
       <option value="PF">French Polynesia</option>
       <option value="TF">French Southern Territories</option>
       <option value="GA">Gabon</option>
       <option value="GM">Gambia</option>
       <option value="GE">Georgia</option>
       <option value="DE">Germany</option>
       <option value="GH">Ghana</option>
       <option value="GI">Gibraltar</option>
       <option value="GR">Greece</option>
       <option value="GL">Greenland</option>
       <option value="GD">Grenada</option>
       <option value="GP">Guadeloupe</option>
       <option value="GU">Guam</option>
       <option value="GT">Guatemala</option>
       <option value="GN">Guinea</option>
       <option value="GW">Guinea-bissau</option>
       <option value="GY">Guyana</option>
       <option value="HT">Haiti</option>
       <option value="HM">Heard And Mc Donald Islands</option>
       <option value="HN">Honduras</option>
       <option value="HK">Hong Kong</option>
       <option value="HU">Hungary</option>
       <option value="IS">Iceland</option>
       <option value="IN">India</option>
       <option value="ID">Indonesia</option>
       <option value="IR">Iran (islamic Republic Of)</option>
       <option value="IQ">Iraq</option>
       <option value="IE">Ireland</option>
       <option value="IL">Israel</option>
       <option value="IT">Italy</option>
       <option value="JM">Jamaica</option>
       <option value="JP">Japan</option>
       <option value="JO">Jordan</option>
       <option value="KZ">Kazakhstan</option>
       <option value="KE">Kenya</option>
       <option value="KI">Kiribati</option>
       <option value="KP">Korea, Democratic People's Republic Of</option>
       <option value="KR">Korea, Republic Of</option>
       <option value="KW">Kuwait</option>
       <option value="KG">Kyrgyzstan</option>
       <option value="LA">Lao People's Democratic Republic</option>
       <option value="LV">Latvia</option>
       <option value="LB">Lebanon</option>
       <option value="LS">Lesotho</option>
       <option value="LR">Liberia</option>
       <option value="LY">Libyan Arab Jamahiriya</option>
       <option value="LI">Liechtenstein</option>
       <option value="LT">Lithuania</option>
       <option value="LU">Luxembourg</option>
       <option value="MO">Macau</option>
       <option value="MK">Macedonia, The Former Yugoslav Republic Of</option>
       <option value="MG">Madagascar</option>
       <option value="MW">Malawi</option>
       <option value="MY">Malaysia</option>
       <option value="MV">Maldives</option>
       <option value="ML">Mali</option>
       <option value="MT">Malta</option>
       <option value="MH">Marshall Islands</option>
       <option value="MQ">Martinique</option>
       <option value="MR">Mauritania</option>
       <option value="MU">Mauritius</option>
       <option value="YT">Mayotte</option>
       <option value="MX">Mexico</option>
       <option value="FM">Micronesia, Federated States Of</option>
       <option value="MD">Moldova, Republic Of</option>
       <option value="MC">Monaco</option>
       <option value="MN">Mongolia</option>
       <option value="MS">Montserrat</option>
       <option value="MA">Morocco</option>
       <option value="MZ">Mozambique</option>
       <option value="MM">Myanmar</option>
       <option value="NA">Namibia</option>
       <option value="NR">Nauru</option>
       <option value="NP">Nepal</option>
       <option value="NL">Netherlands</option>
       <option value="AN">Netherlands Antilles</option>
       <option value="NC">New Caledonia</option>
       <option value="NZ">New Zealand</option>
       <option value="NI">Nicaragua</option>
       <option value="NE">Niger</option>
       <option value="NG">Nigeria</option>
       <option value="NU">Niue</option>
       <option value="NF">Norfolk Island</option>
       <option value="MP">Northern Mariana Islands</option>
       <option value="NO">Norway</option>
       <option value="OM">Oman</option>
       <option value="PK">Pakistan</option>
       <option value="PW">Palau</option>
       <option value="PA">Panama</option>
       <option value="PG">Papua New Guinea</option>
       <option value="PY">Paraguay</option>
       <option value="PE">Peru</option>
       <option value="PH">Philippines</option>
       <option value="PN">Pitcairn</option>
       <option value="PL">Poland</option>
       <option value="PT">Portugal</option>
       <option value="PR">Puerto Rico</option>
       <option value="QA">Qatar</option>
       <option value="RE">Reunion</option>
       <option value="RO">Romania</option>
       <option value="RU">Russian Federation</option>
       <option value="RW">Rwanda</option>
       <option value="KN">Saint Kitts And Nevis</option>
       <option value="LC">Saint Lucia</option>
       <option value="VC">Saint Vincent And The Grenadines</option>
       <option value="WS">Samoa</option>
       <option value="SM">San Marino</option>
       <option value="ST">Sao Tome And Principe</option>
       <option value="SA">Saudi Arabia</option>
       <option value="SN">Senegal</option>
       <option value="SC">Seychelles</option>
       <option value="SL">Sierra Leone</option>
       <option value="SG">Singapore</option>
       <option value="SK">Slovakia (slovak Republic)</option>
       <option value="SI">Slovenia</option>
       <option value="SB">Solomon Islands</option>
       <option value="SO">Somalia</option>
       <option value="ZA">South Africa</option>
       <option value="GS">South Georgia And The South Sandwich Islands</option>
       <option value="ES">Spain</option>
       
       <option value="LK">Sri Lanka</option>
       <option value="SH">St. Helena</option>
       <option value="PM">St. Pierre And Miquelon</option>
       <option value="SD">Sudan</option>
       <option value="SR">Suriname</option>
       <option value="SJ">Svalbard And Jan Mayen Islands</option>
       <option value="SZ">Swaziland</option>
       <option value="SE">Sweden</option>
       <option value="CH">Switzerland</option>
       <option value="SY">Syrian Arab Republic</option>
       <option value="TW">Taiwan</option>
       <option value="TJ">Tajikistan</option>
       <option value="TZ">Tanzania, United Republic Of</option>
       <option value="TH">Thailand</option>
       <option value="TG">Togo</option>
       <option value="TK">Tokelau</option>
       <option value="TO">Tonga</option>
       <option value="TT">Trinidad And Tobago</option>
       <option value="TN">Tunisia</option>
       <option value="TR">Turkey</option>
       <option value="TM">Turkmenistan</option>
       <option value="TC">Turks And Caicos Islands</option>
       <option value="TV">Tuvalu</option>
       <option value="UG">Uganda</option>
       <option value="UA">Ukraine</option>
       <option value="AE">United Arab Emirates</option>
       <option value="GB">United Kingdom </option>
       <option value="US" selected="">United States </option>
       <option value="UM">United States Minor Outlying Islands</option>
       <option value="UY">Uruguay</option>
       <option value="UZ">Uzbekistan</option>
       <option value="VU">Vanuatu</option>
       <option value="VA">Vatican City State (holy See)</option>
       <option value="VE">Venezuela</option>
       <option value="VN">Viet Nam</option>
       <option value="VG">Virgin Islands (british)</option>
       <option value="VI">Virgin Islands (u.s.)</option>
       <option value="WF">Wallis And Futuna Islands</option>
       <option value="EH">Western Sahara</option>
       <option value="YE">Yemen</option>
       <option value="YU">Yugoslavia</option>
       <option value="ZR">Zaire</option>
       <option value="ZM">Zambia</option>
       <option value="ZW">Zimbabwe</option>
       </select>
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="my-label">Country</label>
       </div>	
       <div class="form-group form-group-pe">
       <select name="customers[billing_state]" id="billing_state" tabindex="22" class="my-input"><option value="">Please Select</option><option value="AL">ALABAMA</option><option value="AK">ALASKA </option><option value="AZ">ARIZONA</option><option value="AR">ARKANSAS</option><option value="CA">CALIFORNIA</option><option value="CO">COLORADO</option><option value="CT">CONNECTICUT </option><option value="DE">DELAWARE</option><option value="DC">DISTRICT OF COLUMBIA</option><option value="FL">FLORIDA</option><option value="GA">GEORGIA</option><option value="HI">HAWAII</option><option value="ID">IDAHO</option><option value="IL">ILLINOIS</option><option value="IN">INDIANA</option><option value="IA">IOWA</option><option value="KS">KANSAS</option><option value="KY">KENTUCKY</option><option value="LA">LOUISIANA</option><option value="ME">MAINE</option><option value="MD">MARYLAND</option><option value="MA">MASSACHUSETTS</option><option value="MI">MICHIGAN</option><option value="MN">MINNESOTA</option><option value="MS">MISSISSIPPI</option><option value="MO">MISSOURI</option><option value="MT">MONTANA</option><option value="NE">NEBRASKA</option><option value="NV">NEVADA</option><option value="NH">NEW HAMPSHIRE</option><option value="NJ">NEW JERSEY</option><option value="NM">NEW MEXICO</option><option value="NY">NEW YORK</option><option value="NC">NORTH CAROLINA</option><option value="ND">NORTH DAKOTA</option><option value="OH" selected="selected">OHIO</option><option value="OK">OKLAHOMA</option><option value="OR">OREGON</option><option value="PA">PENNSYLVANIA</option><option value="RI">RHODE ISLAND</option><option value="SC">SOUTH CAROLINA</option><option value="SD">SOUTH DAKOTA</option><option value="TN">TENNESSEE</option><option value="TX">TEXAS</option><option value="VI">US Virgin Islands</option><option value="UT">UTAH</option><option value="VT">VERMONT</option><option value="VA">VIRGINIA</option><option value="WA">WASHINGTON</option><option value="WV">WEST VIRGINIA</option><option value="WI">WISCONSIN</option><option value="WY">WYOMING</option></select>
       <input style="display:none" name="customers[billing_state_other]" id="billing_state_other" value="OH" tabindex="23" class="my-input" required type="text">
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="my-label">State/Province</label>
       </div>	
       <div class="form-group form-group-pe">
       <input maxlength="8" name="customers[billing_zip]" id="billing_zip" value="44224" tabindex="24" class="my-input" required type="text">
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="my-label">Zip</label>
       </div>	
       </div>
       <!----------------------------billing Details ends------------------->
       <!--------------------------------Credit Balance Starts----------------->  
       <div id="self_info_last_billing" class="col-xs-12">
       <h2 style="margin-bottom:10px;" class="text-center info_subheading">Credit Balance:</h2>
       <div class="form-group form-group-pe" style="text-align:center;">$95</div>
       </div>  
       <!----------------------------Credit Balance ends------------------->
       <!-----------------------------Column 3 Ends------------------------>    
       </div>
       </div>
       <!----------------------row1 Ends------------------------------------------->
       <!----------------------row2 starts------------------------------------------->             
       <div class="row">
       <div class="col-xs-12 col-sm-6 hide">
       <h2 class="h2 " style="font-size:30px;">Shipping Details</h2>
       <p class="form">
       <span class="txt_field">Street 1 </span> 
       <span class="txt_box_field">
       <input name="customers[customer_address]" id="customer_address" value="College road" class="" tabindex="25" type="text">
       </span>
       </p>
       <p class="form">
       <span class="txt_field">Street 2 </span>
       <span class="txt_box_field">
       <input name="customers[customer_address2]" id="customer_address2" value="New laxmi nagar" class="" tabindex="26" type="text">
       </span>
       </p>
       <p class="form">
       <span class="txt_field">City </span>
       <span class="txt_box_field"> 
       <input name="customers[customer_city]" id="customer_city" value="Gondia" class="" tabindex="27" type="text">
       </span>
       </p>
       <p class="form">
       <span class="txt_field">Country </span>
       <span class="txt_box_field" id="main_caint">
       <select name="customers[customer_country]" id="customer_country" tabindex="28">
       <option value="">Please Select</option>
       <option value="AF">Afghanistan</option>
       <option value="AL">Albania</option>
       <option value="DZ">Algeria</option>
       <option value="AS">American Samoa</option>
       <option value="AD">Andorra</option>
       <option value="AO">Angola</option>
       <option value="AI">Anguilla</option>
       <option value="AQ">Antarctica</option>
       <option value="AG">Antigua And Barbuda</option>
       <option value="AR">Argentina</option>
       <option value="AM">Armenia</option>
       <option value="AW">Aruba</option>
       <option value="AU">Australia</option>
       <option value="AT">Austria</option>
       <option value="AZ">Azerbaijan</option>
       <option value="BS">Bahamas</option>
       <option value="BH">Bahrain</option>
       <option value="BD">Bangladesh</option>
       <option value="BB">Barbados</option>
       <option value="BY">Belarus</option>
       <option value="BE">Belgium</option>
       <option value="BZ">Belize</option>
       <option value="BJ">Benin</option>
       <option value="BM">Bermuda</option>
       <option value="BT">Bhutan</option>
       <option value="BO">Bolivia</option>
       <option value="BA">Bosnia And Herzegowina</option>
       <option value="BW">Botswana</option>
       <option value="BV">Bouvet Island</option>
       <option value="BR">Brazil</option>
       <option value="IO">British Indian Ocean Territory</option>
       <option value="BN">Brunei Darussalam</option>
       <option value="BG">Bulgaria</option>
       <option value="BF">Burkina Faso</option>
       <option value="BI">Burundi</option>
       <option value="KH">Cambodia</option>
       <option value="CM">Cameroon</option>
       <option value="CA">Canada</option>
       <option value="CV">Cape Verde</option>
       <option value="KY">Cayman Islands</option>
       <option value="CF">Central African Republic</option>
       <option value="TD">Chad</option>
       <option value="CL">Chile</option>
       <option value="CN">China</option>
       <option value="CX">Christmas Island</option>
       <option value="CC">Cocos (keeling) Islands</option>
       <option value="CO">Colombia</option>
       <option value="KM">Comoros</option>
       <option value="CG">Congo</option>
       <option value="CK">Cook Islands</option>
       <option value="CR">Costa Rica</option>
       <option value="CI">Cote D'ivoire</option>
       <option value="HR">Croatia</option>
       <option value="CU">Cuba</option>
       <option value="CY">Cyprus</option>
       <option value="CZ">Czech Republic</option>
       <option value="DK">Denmark</option>
       <option value="DJ">Djibouti</option>
       <option value="DM">Dominica</option>
       <option value="DO">Dominican Republic</option>
       <option value="TP">East Timor</option>
       <option value="EC">Ecuador</option>
       <option value="EG">Egypt</option>
       <option value="SV">El Salvador</option>
       <option value="GQ">Equatorial Guinea</option>
       <option value="ER">Eritrea</option>
       <option value="EE">Estonia</option>
       <option value="ET">Ethiopia</option>
       <option value="FK">Falkland Islands (malvinas)</option>
       <option value="FO">Faroe Islands</option>
       <option value="FJ">Fiji</option>
       <option value="FI">Finland</option>
       <option value="FR">France</option>
       <option value="FX">France, Metropolitan</option>
       <option value="GF">French Guiana</option>
       <option value="PF">French Polynesia</option>
       <option value="TF">French Southern Territories</option>
       <option value="GA">Gabon</option>
       <option value="GM">Gambia</option>
       <option value="GE">Georgia</option>
       <option value="DE">Germany</option>
       <option value="GH">Ghana</option>
       <option value="GI">Gibraltar</option>
       <option value="GR">Greece</option>
       <option value="GL">Greenland</option>
       <option value="GD">Grenada</option>
       <option value="GP">Guadeloupe</option>
       <option value="GU">Guam</option>
       <option value="GT">Guatemala</option>
       <option value="GN">Guinea</option>
       <option value="GW">Guinea-bissau</option>
       <option value="GY">Guyana</option>
       <option value="HT">Haiti</option>
       <option value="HM">Heard And Mc Donald Islands</option>
       <option value="HN">Honduras</option>
       <option value="HK">Hong Kong</option>
       <option value="HU">Hungary</option>
       <option value="IS">Iceland</option>
       <option value="IN" selected="">India</option>
       <option value="ID">Indonesia</option>
       <option value="IR">Iran (islamic Republic Of)</option>
       <option value="IQ">Iraq</option>
       <option value="IE">Ireland</option>
       <option value="IL">Israel</option>
       <option value="IT">Italy</option>
       <option value="JM">Jamaica</option>
       <option value="JP">Japan</option>
       <option value="JO">Jordan</option>
       <option value="KZ">Kazakhstan</option>
       <option value="KE">Kenya</option>
       <option value="KI">Kiribati</option>
       <option value="KP">Korea, Democratic People's Republic Of</option>
       <option value="KR">Korea, Republic Of</option>
       <option value="KW">Kuwait</option>
       <option value="KG">Kyrgyzstan</option>
       <option value="LA">Lao People's Democratic Republic</option>
       <option value="LV">Latvia</option>
       <option value="LB">Lebanon</option>
       <option value="LS">Lesotho</option>
       <option value="LR">Liberia</option>
       <option value="LY">Libyan Arab Jamahiriya</option>
       <option value="LI">Liechtenstein</option>
       <option value="LT">Lithuania</option>
       <option value="LU">Luxembourg</option>
       <option value="MO">Macau</option>
       <option value="MK">Macedonia, The Former Yugoslav Republic Of</option>
       <option value="MG">Madagascar</option>
       <option value="MW">Malawi</option>
       <option value="MY">Malaysia</option>
       <option value="MV">Maldives</option>
       <option value="ML">Mali</option>
       <option value="MT">Malta</option>
       <option value="MH">Marshall Islands</option>
       <option value="MQ">Martinique</option>
       <option value="MR">Mauritania</option>
       <option value="MU">Mauritius</option>
       <option value="YT">Mayotte</option>
       <option value="MX">Mexico</option>
       <option value="FM">Micronesia, Federated States Of</option>
       <option value="MD">Moldova, Republic Of</option>
       <option value="MC">Monaco</option>
       <option value="MN">Mongolia</option>
       <option value="MS">Montserrat</option>
       <option value="MA">Morocco</option>
       <option value="MZ">Mozambique</option>
       <option value="MM">Myanmar</option>
       <option value="NA">Namibia</option>
       <option value="NR">Nauru</option>
       <option value="NP">Nepal</option>
       <option value="NL">Netherlands</option>
       <option value="AN">Netherlands Antilles</option>
       <option value="NC">New Caledonia</option>
       <option value="NZ">New Zealand</option>
       <option value="NI">Nicaragua</option>
       <option value="NE">Niger</option>
       <option value="NG">Nigeria</option>
       <option value="NU">Niue</option>
       <option value="NF">Norfolk Island</option>
       <option value="MP">Northern Mariana Islands</option>
       <option value="NO">Norway</option>
       <option value="OM">Oman</option>
       <option value="PK">Pakistan</option>
       <option value="PW">Palau</option>
       <option value="PA">Panama</option>
       <option value="PG">Papua New Guinea</option>
       <option value="PY">Paraguay</option>
       <option value="PE">Peru</option>
       <option value="PH">Philippines</option>
       <option value="PN">Pitcairn</option>
       <option value="PL">Poland</option>
       <option value="PT">Portugal</option>
       <option value="PR">Puerto Rico</option>
       <option value="QA">Qatar</option>
       <option value="RE">Reunion</option>
       <option value="RO">Romania</option>
       <option value="RU">Russian Federation</option>
       <option value="RW">Rwanda</option>
       <option value="KN">Saint Kitts And Nevis</option>
       <option value="LC">Saint Lucia</option>
       <option value="VC">Saint Vincent And The Grenadines</option>
       <option value="WS">Samoa</option>
       <option value="SM">San Marino</option>
       <option value="ST">Sao Tome And Principe</option>
       <option value="SA">Saudi Arabia</option>
       <option value="SN">Senegal</option>
       <option value="SC">Seychelles</option>
       <option value="SL">Sierra Leone</option>
       <option value="SG">Singapore</option>
       <option value="SK">Slovakia (slovak Republic)</option>
       <option value="SI">Slovenia</option>
       <option value="SB">Solomon Islands</option>
       <option value="SO">Somalia</option>
       <option value="ZA">South Africa</option>
       <option value="GS">South Georgia And The South Sandwich Islands</option>
       <option value="ES">Spain</option>
       <option value="LK">Sri Lanka</option>
       <option value="SH">St. Helena</option>
       <option value="PM">St. Pierre And Miquelon</option>
       <option value="SD">Sudan</option>
       <option value="SR">Suriname</option>
       <option value="SJ">Svalbard And Jan Mayen Islands</option>
       <option value="SZ">Swaziland</option>
       <option value="SE">Sweden</option>
       <option value="CH">Switzerland</option>
       <option value="SY">Syrian Arab Republic</option>
       <option value="TW">Taiwan</option>
       <option value="TJ">Tajikistan</option>
       <option value="TZ">Tanzania, United Republic Of</option>
       <option value="TH">Thailand</option>
       <option value="TG">Togo</option>
       <option value="TK">Tokelau</option>
       <option value="TO">Tonga</option>
       <option value="TT">Trinidad And Tobago</option>
       <option value="TN">Tunisia</option>
       <option value="TR">Turkey</option>
       <option value="TM">Turkmenistan</option>
       <option value="TC">Turks And Caicos Islands</option>
       <option value="TV">Tuvalu</option>
       <option value="UG">Uganda</option>
       <option value="UA">Ukraine</option>
       <option value="AE">United Arab Emirates</option>
       <option value="GB">United Kingdom </option>
       <option value="US">United States </option>
       <option value="UM">United States Minor Outlying Islands</option>
       <option value="UY">Uruguay</option>
       <option value="UZ">Uzbekistan</option>
       <option value="VU">Vanuatu</option>
       <option value="VA">Vatican City State (holy See)</option>
       <option value="VE">Venezuela</option>
       <option value="VN">Viet Nam</option>
       <option value="VG">Virgin Islands (british)</option>
       <option value="VI">Virgin Islands (u.s.)</option>
       <option value="WF">Wallis And Futuna Islands</option>
       <option value="EH">Western Sahara</option>
       <option value="YE">Yemen</option>
       <option value="YU">Yugoslavia</option>
       <option value="ZR">Zaire</option>
       <option value="ZM">Zambia</option>
       <option value="ZW">Zimbabwe</option>
       </select>
       </span>
       </p> 
       <p class="form">																							
       <span class="txt_field">State/Province </span>
       <span class="txt_box_field" id="main_caint">
       <span id="SetState">
       <select name="customers[customer_state]" id="customer_state" tabindex="29">
       <option value="">Please Select</option>
       </select>
       <input class="" style="display:none" name="customers[customer_state_other]" id="customer_state_other" value="MS" tabindex="30" type="text">
       </span> 
       </span> 
       </p>                   
       <p class="form">
       <span class="txt_field">Zip </span>
       <span class="txt_box_field"> 
       <input name="customers[customer_zip]" id="customer_zip" value="441614" class="" maxlength="8" tabindex="31" type="text">
       </span>
       </p>
       <p style="font-weight:normal;" class="form">
       <span class="txt_field blank_td">&nbsp;</span>
       <span class="txt_box_field">
       <input value="1" checked="checked" onclick="toggleShippingAddress('self_info_last_billing');" name="customers[billing_shipping_same]" id="billing_shipping_same" tabindex="32" style="width:auto; float:left; margin:4px 10px 0 0; height:auto;" type="checkbox">
       Same as Billing
       </span>
       </p> 
       </div>
       <div class="col-xs-12 col-sm-6 col-sm-6 col-sm-6-leftspace" style="display:none;" id="giftcards">
       </div>
       </div>
       <p class="save_btn" style="float:none; text-align:center;">
       <input class="continue" name="subAddDetail" value="Save" tabindex="33" type="submit">
       </p>
       <!-------------------------- 3 cols ends----------------------------->   
     </form>
  </div>
   
	</div>
</div>