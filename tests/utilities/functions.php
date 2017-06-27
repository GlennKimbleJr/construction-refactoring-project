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
    return override([
        'name' => 'Test Category'
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
    return override([
        'first' => 'Test First',
        'last' => 'Test Last',
        'street' => '123 Test St.',
        'city' => 'Testville',
        'state' => 'Test State',
        'zone' => '',
        'email' => 'test@example.org',
        'officephone' => '555-555-5555',
        'cellphone' => '555-555-5556',
        'fax' => '555-555-5557',
        'type' => '',
        'company' => 'Test Company',
        'zip' => '11111',
        'zone2' => '',
        'zone3' => '',
        'zone4' => '',
        'zone5' => '',
        'zone6' => '',
        'zone7' => '',
        'zone8' => '',
        'zone9' => '',
        'score_per' => '0',
        'bid_per' => '0'
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
    return override([
        'name' => 'Test Project',
        'bidduedate' => '2017-01-31',
        'completedate' => '',
        'zone' => '',
        'plans' => 'test_directory',
        'location' => 'test, location',
        'planuser' => 'test_user',
        'planpass' => 'secret',
        'owner_name' => 'Test Name',
        'owner_phone' => '555-555-5555',
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
    return override([
        'name' => 'Test Super',
        'phone' => '555-555-5555'
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
    return override([
        'name' => 'Test Zone'
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
        if (isset($defaults[$key])) {
            $defaults[$key] = $value;
        }
    }

    return $defaults;
}
