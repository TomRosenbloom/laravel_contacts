# Laravel Contacts

## Implementation notes

In the resources controller created from artisan, the param passed to methods update, store etc. is Contact model rather than an id. For now I'm using id just to get up and running, but look into this...

For selecting city, there should be an 'add city' button with the dropdown



## Data structure

Note, the data structure for physical addresses is v similar to email addresses. Maybe just do one of these to start with...

Note, there is going to be an issue with the name of tables with 'addresses' in the name, because of pluralisation. Maybe.

### Contacts

A contacts has the potential to be a slightly abstract thing, because it could consist of a single person, multiple persons, a business, or combinations of these things. Initially one person = one contact, but I want a data structure that has scalability.

This is just over complicated isn't it? Let's just agglomerate person and contact into one thing for now at least. Might make more sense to add an Organisation table and allow people to be linked to that.

First_name
Last_name
Birth_date
Honorific - foreign key to honorifics table
Status - active or not

### Persons

A person ~~belongs to~~ *is* a contact, in the interests of keeping things simple and manageable for now. So we don't need a separate Persons table.

### Addresses

Table of addresses

### Address_contact

Pivot table linking addresses to contacts.

Type - foreign key link to address_types
Default - a boolean flag to show if this is the default address

### Address_types

For example, home, business, billing etc.

### Contact_types

What would this mean when contact = person? In a commercial context it could be used for say, 'customer', 'supplier'... not sure...

### Email_addresses

Separate table for email address, allowing contact to have more than one

### Email_address_types

Home, business etc. but not 'default' - that is a flag on the email_address_contact pivot table.

For now I'm going to use the address_types table for the type, because I can't see why the types for physical address/email address would be different.

### Email_address_contact

Pivot table linking contacts to email address

Type - foreign key link to address_types
Default - a boolean flag to show if this is the default address

### Citys

Look up table for cities

### Honorifics

Look up table for honorifics