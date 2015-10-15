<?php
/* Step 1a: Set the name of the form that this code relates to */
$multiFormName = \Arr::get($config, 'name', 'generic').'-form';

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
$dobYearRequired = true;
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
$email->setFromName(\Arr::get($config, 'title').' enquiry from '.$sitename); // "Friendly" name emails are sent from (usually "<pubname> Website")

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
$addToDatabase = false;

/* Step 4a: Set whether you want a welcome mailer sent (if set up in the control panel) (true - send mailer; false - do not send mailer) */
$sendWelcomeMailer = Arr::get($config, 'welcomeMailer', false);

/* Step 4b: Set the groups/lists you want the user to be put in (set to true to be put in group or add the list ID (new CP only)) */

$group1 = false;
$group2 = false;
$group3 = false;
$group4 = false;
$group5 = false;

/* Step 5: Add any custom fields here */

foreach($config['fields'] as $field => $field_opts) {

    $fh->addField(new FormFieldText($field, \Arr::get($field_opts, 'required', false)));
    
}

/* Correct Field order */

$fh->fields = array_reverse($fh->fields);

/* Leave this line as is */
require '/var/www/shared/formincludes/signupFormFooter.php';

$confirmation = \Arr::get($config, 'confirmationEmail', null);

if ($fh->showSuccessText && $confirmation) {
    
		$enquiryEmail = new Email();
		$enquiryEmail->addRecipient($site_email);
		
        if(isset($config['recipients']) && $config['recipients']) {
    
            foreach($config['recipients'] as $recipient) {

                $enquiryEmail->addRecipient($recipient);

            }

        }
    
        $enquiryEmail->setSubject('Booking reservation '. $fh->fields['date']->value .", ".$fh->fields['forename']->value." ".$fh->fields['surname']->value);
		$enquiryEmail->setFromEmail($site_email);
		$enquiryEmail->setReplyTo($fh->fields['email']->value);
		$enquiryEmail->setFromName($sitename);

		$html = file_get_contents(DOCROOT.'mailers/'.$confirmation.'.html');

		$html = str_replace("[!sitename]", $sitename, $html);
        $html = str_replace("[!facebook]", $social['facebook'], $html);    
        $html = str_replace("[!submitDate]", date('j/n/Y'), $html);
		$html = str_replace("[!submitTime]", date('H:i'), $html);
        $html = str_replace("[!twitter]", $social['twitter'], $html);
    
		
        foreach($config['fields'] as $field => $field_opts) {
            
            $html = str_replace("[!".$field."]", $fh->fields[$field]->value, $html);

        }    

		$enquiryEmail->setHtmlBody($html);
		$enquiryEmail->send();
    
    } 

?>

<div class="generic-form">

    <a href="javscript:void(0);" class="anchor" id="<?= \Arr::get($config, 'name', 'generic');?>"></a>
   
    <div class="centre-wrap centre-wrap--centred centre-wrap--small centre-wrap--no">

        <h3><?= \Arr::get($config, 'title', 'Generic form plz rename');?></h3>            

        <div id="<?= $multiFormName; ?>-wrapper" class="generic-form__wrapper">

            <? // Success Text  ?>
            <? if ($fh->showSuccessText): ?>

                <p class="successText"><?= \Arr::get($config, 'success', 'Thank you. We will be in touch soon.');?></p>

            <? endif; ?>

            <? // To be displayed at page load ?>
            <? if ($fh->showForm): ?>

                <? // To be displayed if the repsonse comes back with errors ?>
                <? if ($fh->showErrorText): ?>

                    <p class="errorText">You have not filled in all required fields correctly, please check the form and try again.</p>

                <? endif; ?>

                <form action="#<?= \Arr::get($config, 'name', 'generic');?>" method="post" enctype="multipart/form-data" id="<?= $multiFormName; ?>" <?= $fh->showErrorText ? 'class="form-error"' : ''?>>

                    <? foreach($config['fields'] as $field => $field_opts) :?>
                    
                       <div class="field-wrap <?= \Arr::get($field_opts, 'classes');?>">        
                          
                            <? switch(\Arr::get($field_opts, 'type', 'text')):
                            case 'select': ?>
                            
                            <div class="select-wrap">
                                <select name="<?= $field;?>" id="<?= $field;?>" <?= \Arr::get($field_opts, 'required', false) ? 'required' : ''; ?>>
                                    <option value=""><?= \Arr::get($field_opts, 'label');?></option>
                                    <? foreach($field_opts['options'] as $option => $value) :?>
                                    <option value="<?= $value;?>"><?= $option;?></option>
                                    <? endforeach;?>
                                </select>
                                <div class="select"><?= \Arr::get($field_opts, 'label');?></div>
                            </div>
                            
                            <? break;?>
                            
                            <? case 'textarea':?>
                                <label for="<?= $field;?>"><?= \Arr::get($field_opts, 'label');?></label>
                                <textarea name="<?= $field;?>" id="<?= $field;?>" cols="30" rows="<?= \Arr::get($field_opts, 'rows', 1);?>" <?= \Arr::get($field_opts, 'required', false) ? 'required' : ''; ?>></textarea>
                            <? break;?>
                            
                            <? default: ?>
                            
                            <label for="<?= $field;?>"><?= \Arr::get($field_opts, 'label');?></label>
                            <input class="<?= \Arr::get($field_opts, 'extras');?>" id="<?= $field;?>" type="<?= \Arr::get($field_opts, 'type');?>" name="<?= $field;?>" value="<?php echo $fh->fields[$field]->value ?>" <?= \Arr::get($field_opts, 'required', false) ? 'required' : ''; ?>>
                            
                            <? endswitch ?>
                                                                
                       </div>
                       
                    <? endforeach;?>

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