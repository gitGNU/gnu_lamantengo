<?php
/**
 * @License(name="GNU General Public License", version="3.0")
 *
 * Copyright (C) 2010 Tom Kaczocha <freedomdeveloper@yahoo.com>
 *
 * This file is part of LaMantengo.
 *
 * LaMantengo is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * LaMantengo is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with LaMantengo.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
 
require_once("../includes/initialise.php");

$en_message_ar = array();

// link.php
$en_message_ar['en']['title_home']                      = "Home";
$en_message_ar['en']['error_insert_link']               = "Error trying to insert link. Please retry later. If problem persists, consider informing site's administrator.";
$en_message_ar['en']['instructions']                    = 'Enter the destination you want to link to in the text box above. Read the Terms of Service and accept them.
                                                           Click "Link" button and the site will return a new link, whose destination may be modified by any visitor.
                                                           By registering, the links you create can only be modified by your user account.';
$en_message_ar['en']['error_url']                       = "The address you try to visit is wrong (link id not added) Please check it.<br />\n";
$en_message_ar['en']['unknown_url']                     = "The link you are trying to visit does not exist or was discharged from our site.<br />\n";

// reging.php
$en_message_ar['en']['link_button']                     = "Link";
$en_message_ar['en']['login_button']                    = "Login";
$en_message_ar['en']['username']                        = "Username";
$en_message_ar['en']['password']                        = "Password";
$en_message_ar['en']['login_to_site']                   = "Login to Site";
$en_message_ar['en']['register']                        = "Register";
$en_message_ar['en']['register_title']                  = "Register a new User Account";
$en_message_ar['en']['forgot_password']                 = "I forgot my password";
$en_message_ar['en']['forgot_password_title']           = "Recover Password";

$en_message_ar['en']['title_profile']                   = "User Profile";
$en_message_ar['en']['profile_link']                    = "Profile";
$en_message_ar['en']['title_links']                     = "View all Links";
$en_message_ar['en']['links_link']                      = "My Links";
$en_message_ar['en']['title_sess_close']                = "Close the current session";
$en_message_ar['en']['sess_close_link']                 = "Logout";


// footer.php
$en_message_ar['en']['terms_of_service_link']           = "Terms of Service";
$en_message_ar['en']['terms_of_service_link_title']     = "Read the Terms of Service";
$en_message_ar['en']['send_site_query_title_tom']       = "Send Site Query";
$en_message_ar['en']['idea_and_realisation']            = "Idea and Realization: UnWebMaster.Com.Ar";

// register.php
$en_message_ar['en']['title_register']                  = "Register Account";
$en_message_ar['en']['error_agree']                     = "Debes aceptar los T&eacute;rminos del Servicio para poder registrarte.<br />\n";
$en_message_ar['en']['error_username']                  = "The user name is empty.<br />\n";
$en_message_ar['en']['error_size']                      = "The username must be 4 characters or more.<br />\n";
$en_message_ar['en']['error_email_empty']               = "The e-mail is empty.<br />\n";
$en_message_ar['en']['error_email_nomatch']             = "The e-mails do not match.<br />\n";
$en_message_ar['en']['error_email_invalid']             = "The e-mail entered is invalid.<br />\n";
$en_message_ar['en']['error_already_registered']        = "The username or e-mail account entered is already registered.<br />\n";
$en_message_ar['en']['error_already_reg']               = "Already logged in, cannot re-register.<br />\n";

$en_message_ar['en']['registered_successfully']         = "Your account has been created successfully. Check your e-mail (<b>$email</ b>) to obtain their input.<br />\n";
$en_message_ar['en']['important_message']               = "<br /><br /><b>** IMPORTANT **:</b>You are seeing this message because the site is in beta. Probably your account be removed after a few days, or update your password to verify your email.<br />\n";

$en_message_ar['en']['username_message']                = "(Minimum 4 characters)";
$en_message_ar['en']['first_name_message']              = "(Used for contact)";
$en_message_ar['en']['first_name_label']                = "First Name:";
$en_message_ar['en']['email_message']                   = "(Valid - password will be sent to this email)";
$en_message_ar['en']['email_repeat_label']              = "Repeat Email *:";
$en_message_ar['en']['email_repeat_message']            = "(Repeat the email)";

$en_message_ar['en']['title_agreeToS']                  = "I agree to the ToS";
$en_message_ar['en']['title_read_ToS']                  = "Read the ToS";
$en_message_ar['en']['accept_agree_label']              = "I accept the";
$en_message_ar['en']['register_button']                 = "Register";
$en_message_ar['en']['reset_button']                    = "Reset";
$en_message_ar['en']['reg_instruct']                    = "Enter the name of the user you want to register on the site, his real name (optional, only appear when we need to contact you), and a valid e-mail.<br />
                                                           In addition, enter the two words you see in the image, to verify that you are a human, not a computer by automated registrations.<br />
                                                           We will send a message to that address stating your login information, and will be the contact address associated with your account.<br />
                                                           To register for the site has to be consistent with our <a href=\"tos.php\" target=\"_blank\" title=\"Read the ToS (in a new window)\">Terms of Service</a>.";

$en_message_ar['en']['read_ToS_nWindow']                = "Read the ToS (in a new window)";

// email_register.php
$en_message_ar['en']['mail_subj']                       = "Registration LaMantengo.Com.Ar";
$en_message_ar['en']['mail_line1']                      = "Welcome to LaMantengo.Com.Ar<br />\r\n";
$en_message_ar['en']['mail_line2']                      = "To start using the service, log on <a href=\"http://www.lamantengo.com.ar/login.php\">http://www.lamantengo.com.ar/login.php</a>.<br />\r\n";
$en_message_ar['en']['mail_line3']                      = "Your login details are:<br />\r\n";
$en_message_ar['en']['mail_username']                   = "Username: ";
$en_message_ar['en']['mail_password']                   = "Password: ";
$en_message_ar['en']['mail_line4']                      = "You can change your password from your profile after login.<br />\r\n";
$en_message_ar['en']['mail_line5']                      = "If you forget your password, and you cannot recover, you can generate a new entering <a href=\"http://www.lamantengo.com.ar/forgot.php\">http://www.lamantengo.com.ar/forgot.php</a><br />\r\n";

// enviar_email.php
$en_message_ar['en']['mail_line6']                      = "* This is an e-mail sent from LaMantengo.Com.Ar where you entered *<br />\r\n";
$en_message_ar['en']['mail_line7']                      = "* this direction. If you registered, you can change the direction *<br />\r\n";
$en_message_ar['en']['mail_line8']                      = "* Associated with your account from your PROFILE                  *<br />\r\n";
$en_message_ar['en']['mail_line9']                      = "* [ http://www.lamantengo.com.ar/profile.php ]                    *<br />\r\n";

$en_message_ar['en']['mail_line10']                     = "Dear ";
$en_message_ar['en']['mail_line11']                     = "Sincerely,<br />\r\nTeam <b>LaMantengo.Com.Ar</b><br />\r\n<br />\r\n";

$en_message_ar['en']['mail_line12']                     = "* This is an e-mail sent from LaMantengo.Com.Ar where you entered *<br />\r\n";
$en_message_ar['en']['mail_line13']                     = "* This direction. If you registered, you can change the address   *<br />\r\n";
$en_message_ar['en']['mail_line14']                     = "* Associated with your account from your PROFILE                  *<br />\r\n";
$en_message_ar['en']['mail_line15']                     = "* [ http://www.lamantengo.com.ar/profile.php ]                    *<br />\r\n";

$en_message_ar['en']['mail_line16']                     = "Sincerely,<br />\r\nTeam <b>LaMantengo.Com.Ar</b><br />\r\n<br />\r\n";
$en_message_ar['en']['mail_line16']                     = "Sincerely,<br />\r\nTeam <b>LaMantengo.Com.Ar</b><br />\r\n<br />\r\n";
$en_message_ar['en']['mail_line16']                     = "Sincerely,<br />\r\nTeam <b>LaMantengo.Com.Ar</b><br />\r\n<br />\r\n";
$en_message_ar['en']['mail_line16']                     = "Sincerely,<br />\r\nTeam <b>LaMantengo.Com.Ar</b><br />\r\n<br />\r\n";

$en_message_ar['en']['error_mail']                      = "Failed to send new data by email.<br />\n";

// login.php
$en_message_ar['en']['title_login']                     = "Login";
$en_message_ar['en']['error_loggedin']                  = "User already logged in.";
$en_message_ar['en']['error_username_empty']            = "The username is empty.<br />\n";
$en_message_ar['en']['error_password_empty']            = "The password is empty.<br/>\n";
$en_message_ar['en']['error_user_disabled']             = "This user was disabled by admin.<br />\n";
$en_message_ar['en']['error_unknown_user']              = "Username/password combination unknown. Try again.<br />\n";

$en_message_ar['en']['login_welcome']                   = "Welcome, <b>".$_SESSION['username']."</b>. You will shortly be redirected to the home page.<br />";
$en_message_ar['en']['login_redirect']                  = "If you are not redirected after 3 seconds, click <a href=\"index.php\">here</ a>.";

// logout.php
$en_message_ar['en']['title_logout']                    = "Logout";
$en_message_ar['en']['error_already_loggedout']         = "Already logged out.<br />\n";

$en_message_ar['en']['session_closed']                  = "<div id=\"success\">The session was closed properly.</div>";

// profile.php
$en_message_ar['en']['title_profile']                   = "Profile";
$en_message_ar['en']['error_confirm_pass_empty']        = "Confirmation of new password is empty.<br />\n";
$en_message_ar['en']['error_passwords_nomatch']         = "New passwords do not match.<br />\n";
$en_message_ar['en']['error_password_tooshort']         = "The new password must be at least 6 characters.<br />\n";
$en_message_ar['en']['error_password_6_20_long']        = "The new password must be between 6 and 20 alphanumeric characters or symbols are<b>.</b>";
$en_message_ar['en']['error_password_incorrect']        = "The password entered is incorrect.<br />\n";
$en_message_ar['en']['error_login_to_view_profile']     = "You must login <a href=\"login.php?\"> </ a> to view your profile.<br />\n";

$en_message_ar['en']['profile_updated']                 = "The account details were updated successfully.<br />\n";
$en_message_ar['en']['new_password_label']              = "New Password: ";
$en_message_ar['en']['message_6_20_char']               = "6-20 alphanumeric characters";
$en_message_ar['en']['message_repeat_password']         = "Repeat new password:";
$en_message_ar['en']['message_symbols']                 = "or symbols <b>. ( ) - _ ! @ =</b>";
$en_message_ar['en']['label_current_password']          = "Current password *:";
$en_message_ar['en']['confirm_changes']                 = "Confirm changes";
$en_message_ar['en']['btn_edit_profile']                = "Edit Profile";
$en_message_ar['en']['profile_explanation']             = "Enter the name of the user you want to register on the site, his real name (optional, only appear when we need to contact you), and a valid e-mail.<br />
                                                          In addition, enter the two words you see in the image, to verify that you are a human, not a computer by automated registrations.<br />
                                                          We will send a message to that address stating your login information, and will be the contact address associated with your account.<br />
                                                          To register for the site has to be consistent with our <a href=\"tos.php\" target=\"_blank\" title=\"Read the ToS (in a new window)\">Terms of Service</a>.";

// mylinks.php
$en_message_ar['en']['title_mylinks']                   = "My Links";
$en_message_ar['en']['error_link_empty']                = "The link is empty<br />\n";
$en_message_ar['en']['error_incomplete_url']            = "The URL entered is incomplete. Please type your URL in either <b>protocol://server/path</b> (the \"//\" may be waived in cases that are not necessary)<br />\n";
$en_message_ar['en']['error_nopermission']              = "Link does does not exist / You do not have permission to edit this link.<br />\n";
$en_message_ar['en']['error_mass_removal']              = "To remove links massively must log <a href=\"login.php\"> </ a>. If you do not have an account, <a href=\"register.php\">register</a><br />\n";
$en_message_ar['en']['error_no_edit_permission']        = "No link $key: link exist / do not have permission to edit this link.<br />\n";
$en_message_ar['en']['error_no_link_id']                = "You have not entered the id of the link you want to delete.<br />\n";
$en_message_ar['en']['error_invalid_action']            = "Invalid action.<br />\n";
$en_message_ar['en']['error_not_loggedin_links']        = "To view your links must log <a href=\"login.php\">login</ a>. If you do not have an account, <a href=\"register.php\">register</a><br />\n";
$en_message_ar['en']['error_failed_database_conn']      = "Failed to connect to the database.<br />\n";

$en_message_ar['en']['success_updated']                 = "The $lid No. link was updated successfully";
$en_message_ar['en']['success_link_removed']            = "The link No. $key was successfully removed.<br />\n";

$en_message_ar['en']['label_destination']               = "Destination:";
$en_message_ar['en']['label_description']               = "Description:";
$en_message_ar['en']['label_last_modified']             = "Last modified:";
$en_message_ar['en']['label_round']                     = "Round:";

$en_message_ar['en']['table_destination']               = "Destination";
$en_message_ar['en']['table_description']               = "Description";
$en_message_ar['en']['table_round']                     = "Round";
$en_message_ar['en']['table_edit']                      = "Edit";
$en_message_ar['en']['table_remove']                    = "Remove";
$en_message_ar['en']['table_last_modified']             = "Last modified";

$en_message_ar['en']['title_link_new_window']           = "See link in a new window";
$en_message_ar['en']['delete_selected']                 = "Delete Selected";
$en_message_ar['en']['save_changes']                    = "Save Changes";

$en_message_ar['en']['click_button']                    = "Click button";
$en_message_ar['en']['inst_change_dest']                = "to the right of a link to change the destination of it, or";
$en_message_ar['en']['inst_remove']                     = "to remove it off permanently.<br />";
$en_message_ar['en']['inst_bulk_remove']                = "To delete multiple links together, check the box to the left of each link you want to delete, then press the \"Delete Selected.\"";

// view.php
$en_message_ar['en']['title_view']                      = "View Link";
$en_message_ar['en']['error_no_link_id']                = "No link id (Invalid URL).<br />\n";
$en_message_ar['en']['error_link_noexistent']           = "Link nonexistent / off.<br />\n";

$en_message_ar['en']['success_link_added']              = "The link was successfully added.";
$en_message_ar['en']['view_explanation']                = "Use this window to know which points to a link page. By clicking on the destination address can visit the site.<br />
                                                          If you are the owner of the link, or if a link is public, you will also find the ability to edit the link, or scrapped.
                                                          To do this, press the <img src=\"IMAGE_PATH . DS . edit.png\" alt=\"Edit\" title=\"Edit\"> or <img src=\"IMAGE_PATH . DS . delete.png\" alt=\"Remove\" title=\"Remove\" />, respectively.";

// tos.php
$en_message_ar['en']['terms_and_conditions']            = "Terms and Conditions of Service";
$en_message_ar['en']['introduction']                    = "Introduction";
$en_message_ar['en']['tos_text']                        = "Here will go all the legal terms of service LaMantengo.Com.Ar where, as usual, will say that we are not responsible for the use you give to this service except for compelling us law.";
$en_message_ar['en']['full_text']                       = "Full Text";
$en_message_ar['en']['pending']                         = "Pending...";

// email_forgot.php
$en_message_ar['en']['new_data']                        = "New data in LaMantengo.Com.Ar";
$en_message_ar['en']['new_login_data']                  = "Your new login data:<br />\r\n";
$en_message_ar['en']['login_reminder']                  = "Remember that you can to login from";

// forgot.php
$en_message_ar['en']['title_forgot']                    = "Recover password";
$en_message_ar['en']['error_already_loggedin']          = "You are already logged in.";
$en_message_ar['en']['error_email_nomatch']             = "The e-mail user and entered do not match. Try again.<br />\n";

$en_message_ar['en']['password_updated']                = "Your password was successfully updated. Check your email (<b>$email</b>) for its new data input.";
$en_message_ar['en']['reset_password']                  = "Reset Password";
$en_message_ar['en']['reset_explanation']               = "To reset your password, enter your username and e-mail associated with your account.<br />
                                                          In addition, enter the two words you see in the image, to verify that you are a human, not a computer by automated registrations.<br />
                                                          The new password will be sent to that address.";

// email_forgot_confirm.php
$en_message_ar['en']['mail_subject_lost_pass']          = "Lost your password for LaMantengo.Com.Ar";
$en_message_ar['en']['mail_lost_pass_message']          = "You are receiving this e-mail because you requested your login details for LaMantengo. If this is not so, simply ignore this message.<br />\r\n";
$en_message_ar['en']['mail_rebuild_login']              = "To rebuild your login, visit the following link:<br />\r\n";
$en_message_ar['en']['mail_link_fails']                 = "If the link fails, copy and paste ";
$en_message_ar['en']['mail_browser']                    = "in your browser.<br />\r\n";
$en_message_ar['en']['mail_receive_email']              = "You will receive another e-mail with your new data after a visit.<br />\r\n";

// email_report.php
$en_message_ar['en']['report_link']                     = "Report your link on LaMantengo.Com.Ar";
$en_message_ar['en']['visitors']                        = "Visitors: ";
$en_message_ar['en']['link_reported']                   = "your link has been reported";
$en_message_ar['en']['suggesting']                      = ", Suggesting";
$en_message_ar['en']['new_destination']                 = "as a new destination";
$en_message_ar['en']['his_message']                     = "His message was:<br />\r\n";
$en_message_ar['en']['you_can_contact']                 = "You can contact";
$en_message_ar['en']['at']                              = "at";


// email_report_confirm.php
$en_message_ar['en']['check_report']                    = "Check your report in LaMantengo.Com.Ar";
$en_message_ar['en']['check_report_link']               = "To check your account and allow submission of your report, please visit the following link:<br />\r\n";

// report.php
$en_message_ar['en']['title_report']                    = "Report Link";
$en_message_ar['en']['error_link_not_exist']            = "The selected link does not exist or was disabled.<br />\n";
$en_message_ar['en']['error_link_public']               = "The selected link is public or yours. ";
$en_message_ar['en']['error_click_here']                = "Click here to edit</a><br />\n";
$en_message_ar['en']['error_must_enter_name']           = "You must enter your name.<br />\n";
$en_message_ar['en']['error_must_enter_email']          = "You must enter your email.<br />\n";
$en_message_ar['en']['error_link_id_empty']             = "The id of the link to report is empty.<br />\n";
$en_message_ar['en']['error_key_invalid']               = "The key entered is invalid, or the report has already been confirmed and shipped.<br />\n";
$en_message_ar['en']['error_modify_report']             = "Attempt to update the report in the database.<br />\n";
$en_message_ar['en']['error_empty_report']              = "The identifier and / or password are empty report.<br />\n";
$en_message_ar['en']['error_nothing_to_do']             = "There was no indication any action to perform.<br />\n";

$en_message_ar['en']['email_verify']                    = "You were sent an e-mail to <b>" . $_POST['Email'] . "</b> to verify the address. Otherwise, the report not be sent.<br />\n";
$en_message_ar['en']['report_sent']                     = "The report was confirmed and successfully sent to the owner of the reported link.";

$en_message_ar['en']['suggested_target']                = "Suggested target:";
$en_message_ar['en']['comment']                         = "Comment:";

// visit.php
$en_message_ar['en']['title_visit']                     = "Visit Site";
$en_message_ar['en']['go_to']                           = "Go to LaMantengo.Com.Ar";
$en_message_ar['en']['remove_frame']                    = "Remove Frame";
$en_message_ar['en']['title_edit_link']                 = "Edit the Link";
$en_message_ar['en']['title_remove_link']               = "Remove Link";
$en_message_ar['en']['report_link_expired']             = "Report link expired / invalid";
$en_message_ar['en']['report']                          = "Report";

$en_message_ar['en']['no_definitions_found']            = "No definitions found:";


?>