Yii2 Contacts
===============

Yii2 Contacts to create, manage, and delete contacts in a Yii2 site.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require cinghie/yii2-contacts "*"
```

or add

```
"cinghie/yii2-contacts": "*"
```

## Configuration

### 1. Update yii2-contacts database schema

Make sure that you have properly configured `db` application component
and run the following command:

```
$ php yii migrate/up --migrationPath=@vendor/cinghie/yii2-contacts/migrations
```

With contacts table, will be installed also the country phonecode table 

### 2. Set configuration file

Set on your configuration file

```	
'modules' => [ 

    // Yii2 Contacts
    'contacts' => [
        'class' => 'cinghie\contacts\Contacts',
        'roles' => ['admin']
     ],
	
]	
```

### Permissions

To access the module actions the user must have this permissions:

 - Create: contacts-create-contacts
 - Delete: contacts-delete-all-contacts or contacts-delete-his-contacts
 - Index: contacts-index-contacts 
 - Update: contacts-update-all-contacts or contacts-update-his-contacts
 - View: contacts-views-all-contacts or contacts-views-his-contacts

### URLS

 - Contacts: PathToApp/index.php?r=contacts/contacts/index
 - Contacts with Pretty Urls: PathToApp/contacts/contacts/index
