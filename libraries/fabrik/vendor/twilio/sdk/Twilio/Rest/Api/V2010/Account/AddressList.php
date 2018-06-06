<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\ListResource;
use Twilio\Options;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

class AddressList extends ListResource {
    /**
     * Construct the AddressList
     * 
     * @param Version $version Version that contains the resource
     * @param string $accountSid The account_sid
     * @return \Twilio\Rest\Api\V2010\Account\AddressList 
     */
    public function __construct(Version $version, $accountSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('accountSid' => $accountSid, );

        $this->uri = '/Accounts/' . rawurlencode($accountSid) . '/Addresses.json';
    }

    /**
     * Create a new AddressInstance
     * 
     * @param string $customerName The customer_name
     * @param string $street The street
     * @param string $city The city
     * @param string $region The region
     * @param string $postalCode The postal_code
     * @param string $isoCountry The iso_country
     * @param array|Options $options Optional Arguments
     * @return AddressInstance Newly created AddressInstance
     */
    public function create($customerName, $street, $city, $region, $postalCode, $isoCountry, $options = array()) {
        $options = new Values($options);

        $data = Values::of(array(
            'CustomerName' => $customerName,
            'Street' => $street,
            'City' => $city,
            'Region' => $region,
            'PostalCode' => $postalCode,
            'IsoCountry' => $isoCountry,
            'FriendlyName' => $options['friendlyName'],
            'EmergencyEnabled' => Serialize::booleanToString($options['emergencyEnabled']),
            'AutoCorrectAddress' => Serialize::booleanToString($options['autoCorrectAddress']),
        ));

        $payload = $this->version->create(
            'POST',
            $this->uri,
            array(),
            $data
        );

        return new AddressInstance($this->version, $payload, $this->solution['accountSid']);
    }

    /**
     * Streams AddressInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     * 
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, stream()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return \Twilio\Stream stream of results
     */
    public function stream($options = array(), $limit = null, $pageSize = null) {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($options, $limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads AddressInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     * 
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return AddressInstance[] Array of results
     */
    public function read($options = array(), $limit = null, $pageSize = null) {
        return iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of AddressInstance records from the API.
     * Request is executed immediately
     * 
     * @param array|Options $options Optional Arguments
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return \Twilio\Page Page of AddressInstance
     */
    public function page($options = array(), $pageSize = Values::NONE, $pageToken = Values::NONE, $pageNumber = Values::NONE) {
        $options = new Values($options);
        $params = Values::of(array(
            'CustomerName' => $options['customerName'],
            'FriendlyName' => $options['friendlyName'],
            'IsoCountry' => $options['isoCountry'],
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ));

        $response = $this->version->page(
            'GET',
            $this->uri,
            $params
        );

        return new AddressPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of AddressInstance records from the API.
     * Request is executed immediately
     * 
     * @param string $targetUrl API-generated URL for the requested results page
     * @return \Twilio\Page Page of AddressInstance
     */
    public function getPage($targetUrl) {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new AddressPage($this->version, $response, $this->solution);
    }

    /**
     * Constructs a AddressContext
     * 
     * @param string $sid The sid
     * @return \Twilio\Rest\Api\V2010\Account\AddressContext 
     */
    public function getContext($sid) {
        return new AddressContext($this->version, $this->solution['accountSid'], $sid);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Api.V2010.AddressList]';
    }
}