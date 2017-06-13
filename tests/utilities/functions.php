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
function create_new_category($attribs)
{
    return [
        'name' => $attribs['name'] ?? 'Test'
    ];
}

/**
 * Data needed to create a new contact.
 *
 * @param  array  $attribs  Anything you want to override the default data supplied.
 * @return array
 */
function create_new_contact($attribs)
{
    return [
        'first' => $attribs['first'] ?? 'Test',
        'last' => $attribs['last'] ?? 'Tester',
        'street' => $attribs['street'] ?? '123 Test St.',
        'city' => $attribs['city'] ?? 'Testville',
        'state' => $attribs['state'] ?? 'Test',
        'zone' => $attribs['zone'] ?? '',
        'email' => $attribs['email'] ?? 'test@example.org',
        'officephone' => $attribs['officephone'] ?? '555-555-5555',
        'cellphone' => $attribs['cellphone'] ?? '555-555-5556',
        'fax' => $attribs['fax'] ?? '555-555-5557',
        'type' => $attribs['type'] ?? '',
        'company' => $attribs['company'] ?? 'Test Company',
        'zip' => $attribs['zip'] ?? '11111',
        'zone2' => $attribs['zone2'] ?? '',
        'zone3' => $attribs['zone3'] ?? '',
        'zone4' => $attribs['zone4'] ?? '',
        'zone5' => $attribs['zone5'] ?? '',
        'zone6' => $attribs['zone6'] ?? '',
        'zone7' => $attribs['zone7'] ?? '',
        'zone8' => $attribs['zone8'] ?? '',
        'zone9' => $attribs['zone9'] ?? '',
        'score_per' => $attribs['score_per'] ?? '0',
        'bid_per' => $attribs['bid_per'] ?? '0'
    ];
}

/**
 * Data needed to create a new project.
 *
 * @param  array  $attribs  Anything you want to override the default data supplied.
 * @return array
 */
function create_new_project($attribs)
{
    return [
        'name' => $attribs['name'] ?? 'Test Project',
        'bidduedate' => $attribs['bidduedate'] ?? '2017-01-31',
        'completedate' => $attribs['completedate'] ?? '',
        'zone' => $attribs['zone'] ?? '',
        'plans' => $attribs['plans'] ?? 'test_directory',
        'location' => $attribs['location'] ?? 'test, location',
        'planuser' => $attribs['planuser'] ?? 'test_user',
        'planpass' => $attribs['planpass'] ?? 'secret',
        'owner_name' => $attribs['owner_name'] ?? 'Test Name',
        'owner_phone' => $attribs['owner_phone'] ?? '555-555-5555',
        'super_name' => $attribs['super_name'] ?? '',
        'super_phone' => $attribs['super_phone'] ?? '',
    ];
}

/**
 * Data needed to create a new superintendant.
 *
 * @param  array  $attribs  Anything you want to override the default data supplied.
 * @return array
 */
function create_new_super($attribs)
{
    return [
        'name' => $attribs['name'] ?? 'Test',
        'phone' => $attribs['phone'] ?? '555-555-5555'
    ];
}

/**
 * Data needed to create a new zone/type.
 *
 * @param  array  $attribs  Anything you want to override the default data supplied.
 * @return array
 */
function create_new_zone($attribs)
{
    return [
        'name' => $attribs['name'] ?? 'Test'
    ];
}

/**
 * Data needed to create a new contact/project "bidder" relationship.
 *
 * @param  array  $attribs  Anything you want to override the default data supplied.
 * @return array
 */
function create_new_bidder($attribs)
{
    return [
        'project_id' => $attribs['project_id'] ?? 1,
        'category' => $attribs['category'] ?? 'Test Category',
        'status' => $attribs['status'] ?? '',
        'win' => $attribs['win'] ?? '',
        'score' => $attribs['score'] ?? 'NA',
        'company' => $attribs['company'] ?? 'Test Company',
    ];
}
