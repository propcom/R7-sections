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

$fh->addField(new FormFieldBool('marketing-consent', false));
$fh->addField(new FormFieldBool('profiling-consent', false));
$fh->addField(new FormFieldText('page-url', false, 255, false, true));
$fh->addField(new FormFieldText('custom-source', false, 32));

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

        <div class="centre-wrap  centre-wrap--centred  centre-wrap--no">

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

                        <h4>Keep in touch with our very latest news, events,<br/> tipples and treats</h4>
                        <p class="welcomeText">Please confirm your communication preferences below.</p>

                    <? endif; ?>

                    <form action="" method="post" enctype="multipart/form-data" id="<?= $multiFormName; ?>" class="clearfix<?= $fh->showErrorText ? '  form-error' : ''?>">
                        <div class="clearfix">
                            <div class="field-wrap<?php if ($fh->fields['forename']->isError) { ?> error<? } ?>">
                                <label for="<?= $multiFormName ?>-forename">Name*</label>
                                <input type="text" name="forename" id="<?= $multiFormName ?>-forename" value="<?php echo $fh->fields['forename']->value ?>" <?= $forenameRequired ? 'required' : ''; ?> />
                            </div>


                            <div class="field-wrap<?php if ($fh->fields['email']->isError) { ?> error<? } ?>">
                                <label for="<?= $multiFormName ?>-email">Email*</label>
                                <input type="email" name="email" id="<?= $multiFormName ?>-email" value="<?php echo $fh->fields['email']->value ?>" <?= $emailRequired ? 'required' : ''; ?> />
                            </div>

                            <div class="field-wrap<?php if ($fh->fields['dob']->isError) { ?> error<? } ?>">
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
                        </div>

                        <div class="clearfix">
                            <div class="consent">
                                <div class="mb15 field-wrap<?php if (@$fh->fields['marketing-consent']->isError) { ?> error<? } ?>">
                        			<input type="checkbox" required name="marketing-consent" id="<?=$multiFormName?>-marketing-consent"
                        				value=""<?php echo @$fh->fields['marketing-consent']->checked?'checked="checked" ':''?>
                        				class="checkbox js-terms"
                        			/>
                        			<label for="<?=$multiFormName?>-marketing-consent">Sign me up for offers, news and promotions, mainly via email</label>
                        		</div>

                        		<div class="field-wrap<?php if (@$fh->fields['profiling-consent']->isError) { ?> error<? } ?> js-field  profiling-consent">
                        			<input type="checkbox" name="profiling-consent" id="<?=$multiFormName?>-profiling-consent"
                        				value=""<?php echo @$fh->fields['profiling-consent']->checked?'checked="checked" ':''?>
                        				class="checkbox"
                        			/>
                        			<label for="<?=$multiFormName?>-profiling-consent">I am happy for my data to be used to personalise my customer experience</label>
                        		</div>
                            </div>
                        </div>

                        <div class="clearfix">
                            <div style="display:none !important;">
                                <textarea name="textboxfilter" rows="" cols=""></textarea>
                                <input type="hidden" name="multiFormName" value="<?= $multiFormName ?>" />
                                <?
                					if(isset($_SERVER['HTTP_HOST'])) { $domain = $_SERVER['HTTP_HOST']; }
                					if(isset($_SERVER['REQUEST_URI'])) { $page = $_SERVER['REQUEST_URI']; }

                                    if($domain && $page) { echo '<input type="hidden" name="page-url" value="'. $domain, $page .'" />'; }
                				?>
                				<input type="hidden" name="custom-source" value="signupform" />
                            </div>

                            <input type="submit" name="submitted" value="Send" class="submit last" />
                        </div>

                        <p class="terms">
                            Young & Co.’s Brewery, P.L.C and its group of companies are committed to protecting your data and it will be processed in accordance with our privacy policy which can be found at <a href="http://www.youngs.co.uk/privacy-policy" target="_blank">www.youngs.co.uk/privacy-policy</a>. Please read this policy before completing this form. Promoter: Young & Co.’s Brewery P.L.C, Riverside House, 26 Osiers Road, Wandsworth, London SW18 1NH. Registered in England & Wales Company No. 32762
                        </p>
                    </form>

                <? endif; ?>

            </div>

        </div>

    </div>

</div>
