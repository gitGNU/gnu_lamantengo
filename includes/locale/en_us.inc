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

/*
// link.php
$title_home = "Home";

$error_insert_link = "Error trying to insert link. Please retry later. If problem persists, consider informing site's administrator.";

$instructions = 'Enter link\'s destination in the text box above. Read the Terms of Service and accept them. Click "Link" button and the site will give you back a new link, whose destination could be modified by any visitor. By registering, your links could be modified only by your account.';

$link_button = "Link";

// reging.php
$login_button = "Login";

$username = "Username";

$password = "Password";

$login_to_site = "Login to Site";

$register = "Register";

$register_title = "Register a new User Account";

$forgot_password = "I forgot my password";

$forgot_password_title = "Recover Password";

// footer.php
$terms_of_service_link = "Terms of Service";

$terms_of_service_link_title = "Read the Terms of Service";

$send_site_query_title_tom = "Send Site Query";

$idea_and_realisation = "Idea and Realization: UnWebMaster.Com.Ar";
*/

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
                                                           To register for the site has to be consistent with our <a href=\"tos.php?sid=$sid\" target=\"_blank\"";

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

$en_message_ar['en']['login_welcome']                   = "Welcome, <b>$user</b>. You will shortly be redirected to the home page.<br />";
$en_message_ar['en']['login_redirect']                  = "If you are not redirected after 3 seconds, click <a href=\"index.php?sid=$sid\">here</ a>.";

// logout.php
$en_message_ar['en']['title_logout']                    = "Logout";
$en_message_ar['en']['error_already_loggedout']         = "Already logged out.<br />\n";

$en_message_ar['en']['session_closed']                  = "<div id=\"success\">The session was closed properly.</div>";

?>