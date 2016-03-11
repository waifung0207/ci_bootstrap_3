<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - Spanish
*
* Author: Wilfrido Garc�a Espinosa
* 		  contacto@wilfridogarcia.com
*         @wilfridogarcia
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  05.04.2010
*
* Description:  Spanish language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful'] 	  	 = 'Cuenta creada con éxito';
$lang['account_creation_unsuccessful'] 	 	 = 'No se ha podido crear la cuenta';
$lang['account_creation_duplicate_email'] 	 = 'Email en uso o inválido';
$lang['account_creation_duplicate_identity'] = 'Nombre de usuario en uso o inválido';

// TODO Please Translate
$lang['account_creation_missing_default_group'] = 'Grupo predeterminado no está establecido';
$lang['account_creation_invalid_default_group'] = 'Nombre de grupo predeterminado no válido';


// Password
$lang['password_change_successful'] 	 	 = 'Contraseña renovada con éxito';
$lang['password_change_unsuccessful'] 	  	 = 'No se ha podido cambiar la contraseña';
$lang['forgot_password_successful'] 	 	 = 'Nueva contraseña enviada por email';
$lang['forgot_password_unsuccessful'] 	 	 = 'No se ha podido crear una nueva contraseña';

// Activation
$lang['activate_successful'] 		  	     = 'Cuenta activada con éxito';
$lang['activate_unsuccessful'] 		 	     = 'No se ha podido activar la cuenta';
$lang['deactivate_successful'] 		  	     = 'Cuenta desactivada con éxito';
$lang['deactivate_unsuccessful'] 	  	     = 'No se ha podido desactivar la cuenta';
$lang['activation_email_successful'] 	  	 = 'Email de activación enviado';
$lang['activation_email_unsuccessful']   	 = 'No se ha podido enviar el email de activación';

// Login / Logout
$lang['login_successful'] 		      	     = 'Sesión iniciada con éxito';
$lang['login_unsuccessful'] 		  	     = 'No se ha podido iniciar sesión';
$lang['login_unsuccessful_not_active'] 		 = 'Cuenta está inactiva';
$lang['login_timeout']                       = 'Temporalmente bloqueada. Inténtelo de nuevo más tarde.';
$lang['logout_successful'] 		 	         = 'Sesión finalizada con éxito';

// Account Changes
$lang['update_successful'] 		 	         = 'Información de la cuenta actualizada con éxito';
$lang['update_unsuccessful'] 		 	     = 'No se ha podido actualizar la información de la cuenta';
$lang['delete_successful'] 		 	         = 'Usuario eliminado';
$lang['delete_unsuccessful'] 		 	     = 'No se ha podido Eliminar el usuario';

// Groups
$lang['group_creation_successful']  = 'Grupo creado con éxito';
$lang['group_already_exists']       = 'Nombre del grupo ya está ocupado';
$lang['group_update_successful']    = 'Detalles del grupo se han actualizado';
$lang['group_delete_successful']    = 'Grupo borrado';
$lang['group_delete_unsuccessful'] 	= 'No se puede eliminar el grupo';
$lang['group_delete_notallowed']    = 'No se ha podido borrar el grupo de administradores';
$lang['group_name_required'] 		= 'Nombre del grupo requerido';
$lang['group_name_admin_not_alter'] = 'Nombre del grupo de administración no se puede cambiar';

// Activation Email
$lang['email_activation_subject']            = 'Activación de la cuenta';
$lang['email_activate_heading']    = 'Activar cuenta para %s';
$lang['email_activate_subheading'] = 'Por favor, haga click en este enlace para %s.';
$lang['email_activate_link']       = 'Activa tu cuenta';
// Forgot Password Email
$lang['email_forgotten_password_subject']    = 'Verificación de contraseña olvidada';
$lang['email_forgot_password_heading']    = 'Restablecer contraseña para %s';
$lang['email_forgot_password_subheading'] = 'Por favor, haga click en este enlace para %s.';
$lang['email_forgot_password_link']       = 'Restablecer su contraseña';
// New Password Email
$lang['email_new_password_subject']          = 'Nueva Contraseña';
$lang['email_new_password_heading']    = 'Nueva Contraseña para %s';
$lang['email_new_password_subheading'] = 'Su contraseña ha sido cambiado para: %s';
