<?php
/**
 * The configuration of selfregistration module
 */

$config = array (

	/* The authentication source that should be used. */
	'auth' => 'selfregister-ldap',

	// Realm for eduPersonPrincipalName
	'user.realm' => 'example.org',

	// Usen in mail and on pages
	'system.name' => 'Selfregister module',

	// Mailtoken valid for 5 days
	'mailtoken.lifetime' => (3600*24*5),
	'mail.from'     => 'Example <na@example.org>',
	'mail.replyto'  => 'Example <na@example.org>',
	'mail.subject'  => 'Example - email verification',

	// User storage backend selector
	'storage.backend' => 'LdapMod',

	// LDAP backend configuration
	// This is configured in authsources.php
	// FIXME: The name of this arrays shoud be the same as storage.backend value
	'ldap' => array(
		'admin.dn' => 'cn=admin,dc=example,dc=org',
		'admin.pw' => 'xyz',

		// Storage User Id indicate which of the attributes
		// that is the key in the storage
		// This relates to the attributs mapping
		'user.id.param' => 'uid',
		//'user.id.param' => 'cn',

		// Password encryption
		// plain, md5, sha1
		'psw.encrypt' => 'sha1',

		// LDAP objectClass'es
		'objectClass' => array(
			'inetOrgPerson',
			'organizationalPerson',
			'person',
			'top',
			'eduPerson',
			'norEduPerson'
			),
	), // end Ldap config

	// AWS SimpleDB configuration

	// SQL backend configuration

	// Password policy enforcer
	// Inspiration and backgroud
	// http://www.hq.nasa.gov/office/ospp/securityguide/V1comput/Password.htm


	// Mapping from the Storage backend field names to web frontend field names
	// This also indicate which user attributes that will be saved
	'attributes'  => array(
		'uid' => 'uid',
		'givenName' => 'givenName',
		'sn' => 'sn',
		// Will be a combination for givenName and sn.
		'cn' => 'cn',
		'mail' => 'mail',
		// uid and appended realm
		'eduPersonPrincipalName' => 'eduPersonPrincipalName',
		// Set from password walidataion and encryption
		'userPassword' => 'userPassword',
	),

	// Configuration for the field in the web frontend
	// This controlls the order of the fields
	'formFields' => array(
		// UID
		'uid' => array(
			'validate' => array(
				'filter'  => FILTER_VALIDATE_REGEXP,
				'options' => array("regexp"=>"/^[a-z]{1}[a-z0-9\-]{2,15}$/")
			),
			'layout' => array(
				'control_type' => 'text',
				'show' => true,
				'read_only' => true,
			),
		), // end uid
		'givenName' => array(
			'validate' => FILTER_DEFAULT,
			'layout' => array(
				'control_type' => 'text',
				'show' => true,
				'read_only' => false,
			),
		), // end givenName
		// Surname (ldap: sn)
		'sn' => array(
			'validate' => FILTER_DEFAULT,
			'layout' => array(
				'control_type' => 'text',
				'show' => true,
				'read_only' => false,
			),
		), // end ename
		'mail' => array(
			'validate' => FILTER_VALIDATE_EMAIL,
			'layout' => array(
				'control_type' => 'text',
				'show' => true,
				'read_only' => false,
			),
		), // end mail
		// Common name: read only
		'cn' => array(
			'validate' => FILTER_DEFAULT,
			'layout' => array(
				'control_type' => 'text',
				'show' => true,
				'read_only' => false,
				'size' => '35',
			),
		), // end cn
		// eduPersonPrincipalName
		'eduPersonPrincipalName' => array(
			'validate' => FILTER_DEFAULT,
			'layout' => array(
				'control_type' => 'text',
				'show' => true,
				'read_only' => false,
			),
		), // end eduPersonPrincipalName
		'userPassword' => array(
			'validate' => FILTER_DEFAULT,
			'layout' => array(
				'control_type' => 'password',
			),
		),
		'pw1' => array(
			'validate' => FILTER_DEFAULT,
			'layout' => array(
				'control_type' => 'password',
			),
		),
		'pw2' => array(
			'validate' => FILTER_DEFAULT,
			'layout' => array(
				'control_type' => 'password',
			),
		), // end pw2
	),

);
