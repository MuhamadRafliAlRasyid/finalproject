<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Api
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Api\V2010\Account\Sip;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Values;
use Twilio\Version;
use Twilio\InstanceContext;
use Twilio\Rest\Api\V2010\Account\Sip\CredentialList\CredentialList;


/**
 * @property CredentialList $credentials
 * @method \Twilio\Rest\Api\V2010\Account\Sip\CredentialList\CredentialContext credentials(string $sid)
 */
class CredentialListContext extends InstanceContext
    {
    protected $_credentials;

    /**
     * Initialize the CredentialListContext
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The unique id of the Account that is responsible for this resource.
     * @param string $sid The credential list Sid that uniquely identifies this resource
     */
    public function __construct(
        Version $version,
        $accountSid,
        $sid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'accountSid' =>
            $accountSid,
        'sid' =>
            $sid,
        ];

        $this->uri = '/Accounts/' . \rawurlencode($accountSid)
        .'/SIP/CredentialLists/' . \rawurlencode($sid)
        .'.json';
    }

    /**
     * Delete the CredentialListInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        return $this->version->delete('DELETE', $this->uri, [], [], $headers);
    }


    /**
     * Fetch the CredentialListInstance
     *
     * @return CredentialListInstance Fetched CredentialListInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): CredentialListInstance
    {

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        $payload = $this->version->fetch('GET', $this->uri, [], [], $headers);

        return new CredentialListInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['sid']
        );
    }


    /**
     * Update the CredentialListInstance
     *
     * @param string $friendlyName A human readable descriptive text for a CredentialList, up to 64 characters long.
     * @return CredentialListInstance Updated CredentialListInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(string $friendlyName): CredentialListInstance
    {

        $data = Values::of([
            'FriendlyName' =>
                $friendlyName,
        ]);

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        $payload = $this->version->update('POST', $this->uri, [], $data, $headers);

        return new CredentialListInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['sid']
        );
    }


    /**
     * Access the credentials
     */
    protected function getCredentials(): CredentialList
    {
        if (!$this->_credentials) {
            $this->_credentials = new CredentialList(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['sid']
            );
        }

        return $this->_credentials;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get(string $name): ListResource
    {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments): InstanceContext
    {
        $property = $this->$name;
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Api.V2010.CredentialListContext ' . \implode(' ', $context) . ']';
    }
}
