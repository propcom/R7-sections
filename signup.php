<?php
/* Step 1a: Set the name of the form that this code relates to */
$multiFormName = 'signup-form';

/* Leave these 2 lines as they are */
require '/var/www/shared/formincludes/signupFormHeader.php';
$fh = $multiForms[$multiFormName];

/* Step 1b: Set site id */

$siteId = $siteid;

/* Step 2: Set which fields you want to be required */

$forenameRequired = true;
$surnameRequired = false;
$companyRequired = false;
$dobRequired = true;
$dobYearRequired = false;
$emailRequired = true;
$phoneRequired = false;
$addressRequired = false;   // Set to 'postcode' (with quotes) to just make postcode required
$additionalInfoRequired = false;
$cvRequired = false;
$commentsRequired = false;
$reservationDateRequired = false;
$reservationYearRequired = false;
$reservationDepartureRequired = false;
$reservationTimeRequired = false;
$reservationGuestsRequired = false;

$mailingListRequired = false;  // If true, mailing list box *must* be checked for form to validate

/* Step 3: Set whether you want an email sending */

$sendEmail = Arr::get($config, 'sendEmail', false);

/* Step 3a: If sending an email, set email subject and from & to addresses */

$email->setSubject($sitename);

$email->setFromEmail($site_email); // Email is sent 'from' this address
$email->setFromName('Signup from '.$sitename); // "Friendly" name emails are sent from (usually "<pubname> Website")

$email->addRecipient($site_email);

if(isset($config['recipients']) && $config['recipients']) {
    
    foreach($config['recipients'] as $recipient) {
        
        $email->addRecipient($recipient);
        
    }
    
}

//$email->addRecipient('ruth.nachum@propcom.co.uk');		// Add a recipient to the email
//$email->addBccRecipient('andy-signups@propcomm.co.uk');	// Add a bcc to the email (remove the // at the start to enable a line)
//$email->addBccRecipient('john@propcomm.co.uk');

/* Step 4: Set whether you want the user adding to the database
 *         If you *are* using the 'Join our mailing list' checkbox, leave set to 'checkbox'
 *         If you want to make an 'opt-out' checkbox, set to 'checkbox-optout'
 * 		   If *not* using the checkbox, set to true if you want the user adding; or set to false if not
 */
$addToDatabase = true;

/* Step 4a: Set whether you want a welcome mailer sent (if set up in the control panel) (true - send mailer; false - do not send mailer) */
$sendWelcomeMailer = Arr::get($config, 'welcomeMailer', false);

/* Step 4b: Set the groups/lists you want the user to be put in (set to true to be put in group or add the list ID (new CP only)) */

$group1 = false;
$group2 = false;
$group3 = false;
$group4 = false;
$group5 = false;

if(isset($config['listIDs']) && $config['listIDs']) {
    
    foreach($config['listIDs'] as $listid) {
        
        $listIDs[] = $listid;
        
    }

}

/* Step 5: Add any custom fields here */

// $fh->addField(new FormFieldText('example', $exampleRequired));

/* Leave this line as is */
require '/var/www/shared/formincludes/signupFormFooter.php';
?>
<div class="signup">
    
    <div class="signup__background">
        
        <div class="centre-wrap centre-wrap--centred centre-wrap--small centre-wrap--no">

            <h3>Sign-Up</h3>            

            <div id="<?= $multiFormName; ?>-wrapper" class="signup__wrapper">

                <? // Success Text  ?>
                <? if ($fh->showSuccessText): ?>

                    <p class="successText">Thank you. We will be in touch soon.</p>

                <? endif; ?>

                <? // To be displayed at page load ?>
                <? if ($fh->showForm): ?>

                    <? // To be displayed if the repsonse comes back with errors ?>
                    <? if ($fh->showErrorText): ?>

                        <p class="errorText">You have not filled in all required fields correctly, please check the form and try again.</p>

                    <? else: ?>

                        <h4>Claim your Free Drink</h4>
                    
                        <p class="welcomeText"><?= \Arr::get($config, 'welcomeText', 'Join our mailing list and receive our news and events straight to your inbox.');?></p>

                    <? endif; ?>

                    <form action="" method="post" enctype="multipart/form-data" id="<?= $multiFormName; ?>" <?= $fh->showErrorText ? 'class="form-error"' : ''?>>

                        <div class="field-wrap<?php if ($fh->fields['forename']->isError) { ?> error<? } ?>">
                            <label for="<?= $multiFormName ?>-forename">Name</label>
                            <input type="text" name="forename" id="<?= $multiFormName ?>-forename" value="<?php echo $fh->fields['forename']->value ?>" <?= $forenameRequired ? 'required' : ''; ?> />
                        </div>


                        <div class="field-wrap<?php if ($fh->fields['email']->isError) { ?> error<? } ?>">
                            <label for="<?= $multiFormName ?>-email">Email</label>
                            <input type="email" name="email" id="<?= $multiFormName ?>-email" value="<?php echo $fh->fields['email']->value ?>" <?= $emailRequired ? 'required' : ''; ?> />
                        </div>

                        <div class="last field-wrap<?php if ($fh->fields['dob']->isError) { ?> error<? } ?>">
                            <label for="dob">Birthday</label>

                            <div class="select-wrap">
                                <select name="dob-day" id="dob-day" <?= $dobRequired ? 'required' : ''; ?>>
                                    <option value="">DD</option>
                                    <?php for ($i = 1; $i <= 31; $i++) { ?>
                                        <option value="<?php echo $i ?>"<?php echo $fh->fields['dob']->day == $i ? ' selected="selected"' : '' ?>><?php echo $i ?></option>
                                    <? } ?>
                                </select>
                                <div class="select">DD</div>
                            </div>

                            <div class="select-wrap">
                                <select name="dob-month" id="dob-month" <?= $dobRequired ? 'required' : ''; ?>>
                                    <option value="">MM</option>
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo $i ?>"<?php echo $fh->fields['dob']->month == $i ? ' selected="selected"' : '' ?>><?php echo date('M', mktime(0, 0, 0, $i, 1)) ?></option>
                                    <? } ?>
                                </select>
                               <div class="select">MM</div>
                           </div>    

                        </div>
                        
                        <p class="terms"><a href="javascript:void(0);" class="js-terms">T &amp; Cs</a></p>

                        <div style="display:none !important;">
                            <textarea name="textboxfilter" rows="" cols=""></textarea>
                            <input type="hidden" name="multiFormName" value="<?= $multiFormName ?>" />
                        </div>

                        <input type="submit" name="submitted" value="Send" class="submit" />

                    </form>

                <? endif; ?>

            </div>

        </div>
        
    </div>    
    
</div>

<div class="signup__terms">
   
    <p class="h_alpha">Terms &amp; Conditions</p>
    
    <? if($type === 'youngs') :?>
    
        <p>By filling in your details you are agreeing to hear from Young's and this pub from time to time. Your details will be stored in accordance with the Data Protection Act and we promise never to share your details with anyone else.</p>
        <p>You may unsubscribe from Young's pubs at any time simply by clicking on the unsubscribe button at the bottom of the email or by emailing <a href="mailto:enquiries@youngs.co.uk?subject=Terms and Conditions Enquiry - <?= $sitename;?>">enquiries@youngs.co.uk</a>.</p>
        <p>Promoter Young &amp; Co.'s Brewery, P.L.C. Riverside House, 26 Osiers Road, Wandsworth, London, SW18 1 NH. Registered Company No 32762</p>
    
    <? elseif($type === 'geronimo') :?>
    
        <p>By filling in your details you are agreeing to hear from Geronimo Inn’s and this pub from time to time. Your details will be stored in accordance with the Data Protection Act and we promise never to share your details with anyone else.</p>
        <p>You may unsubscribe from Geronimo Inns pubs at any time simply by clicking on the unsubscribe button at the bottom of the email or by emailing <a href="mailto:enquiries@geronimo-inns.co.uk?subject=Terms and Conditions Enquiry - <?= $sitename;?>">enquiries@geronimo-inns.co.uk</a>.</p>
        <p>Promoter Geronimo Inns, P.L.C. Riverside House, 26 Osiers Road, Wandsworth, London, SW18 1NH. Registered Company No 2979146</p>
    
    <? endif;?>
    
</div>