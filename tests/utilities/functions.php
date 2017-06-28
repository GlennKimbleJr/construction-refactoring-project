<?php

/**
 * Returns the desired data object.
 * 
 * @param  string  $type   The data object to be returned.
 * @param  array  $attribs  Anything you want to override the default data supplied.
 * @param  boolean $object Return data as an object if true, otherwise an array.
 * @return object|array
 */
function make($type, $attribs = [], $object = true)
{
    $function = "create_new_" . $type;

    return ($object) ? (object) $function($attribs) : $function($attribs);
}

/**
 * Data needed to create a new category.
 *
 * @param  array  $attribs  Anything you want to override the default data supplied.
 * @return array
 */
function create_new_categories($attribs)
{
    $faker = Faker\Factory::create();

    return override([
        'name' => $faker->slug(2, false)
    ], $attribs);
}

/**
 * Data needed to create a new contact.
 *
 * @param  array  $attribs  Anything you want to override the default data supplied.
 * @return array
 */
function create_new_contacts($attribs)
{
    $faker = Faker\Factory::create();

    return override([
        'company' => $faker->company,
        'first' => $faker->firstName,
        'last' => $faker->lastName,
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip' => $faker->postcode,
        'email' => $faker->email,
        'officephone' => $faker->phoneNumber,
        'cellphone' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
        'category_id' => 1,
        'score_per' => '0',
        'bid_per' => '0'
    ], $attribs);
}

/**
 * Data needed to create a new contact/zone relationship.
 *
 * @param  array  $attribs  Anything you want to override the default data supplied.
 * @return array
 */
function create_new_contacts_zones($attribs)
{
    return override([
        'contact_id' => 1,
        'zone_id' => 1
    ], $attribs);
}

/**
 * Data needed to create a new project.
 *
 * @param  array  isset($attribs  Anything you want to override the default data supplied.
 * @return array
 */
function create_new_projects($attribs)
{
    $faker = Faker\Factory::create();

    return override([
        'name' => $faker->sentence(2),
        'bidduedate' => date('Y-m-d', (time() + (60*60*24*7))),
        'completedate' => '',
        'zone_id' => 1,
        'plans' => $faker->slug(2, false),
        'location' => $faker->address,
        'planuser' => $faker->userName,
        'planpass' => $faker->slug(3),
        'owner_name' => $faker->name,
        'owner_phone' => $faker->phoneNumber,
        'super_id' => 1,
    ], $attribs);
}

/**
 * Data needed to create a new superintendant.
 *
 * @param  array  isset($attribs  Anything you want to override the default data supplied.
 * @return array
 */
function create_new_supers($attribs)
{
    $faker = Faker\Factory::create();

    return override([
        'name' => $faker->name,
        'phone' => $faker->phoneNumber
    ], $attribs);
}

/**
 * Data needed to create a new zone/type.
 *
 * @param  array  isset($attribs  Anything you want to override the default data supplied.
 * @return array
 */
function create_new_zones($attribs)
{
    $faker = Faker\Factory::create();

    return override([
        'name' => $faker->slug(2, false)
    ], $attribs);
}

/**
 * Data needed to create a new contact/project "bidder" relationship.
 *
 * @param  array  isset($attribs  Anything you want to override the default data supplied.
 * @return array
 */
function create_new_bidders($attribs)
{
    return override([
        'project_id' => 1,
        'contact_id' => 1,
        'category_id' => 1,
        'status' => '',
        'win' => '',
        'score' => 'NA',
    ], $attribs);
}

/**
 * Replace default attributes with override attributes.
 * 
 * @param  array $defaults
 * @param  array $overrides
 * @return array
 */
function override($defaults, $overrides)
{
    foreach( $overrides as $key => $value ) {
        $defaults[$key] = $value;
    }

    return $defaults;
}
