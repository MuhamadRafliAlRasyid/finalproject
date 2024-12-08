<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Marketplace
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Marketplace\V1\AvailableAddOn;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;


/**
 * @property string|null $sid
 * @property string|null $availableAddOnSid
 * @property string|null $friendlyName
 * @property string|null $productName
 * @property string|null $uniqueName
 * @property string|null $url
 */
class AvailableAddOnExtensionInstance extends InstanceResource
{
    /**
     * Initialize the AvailableAddOnExtensionInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $availableAddOnSid The SID of the AvailableAddOn resource with the extension to fetch.
     * @param string $sid The SID of the AvailableAddOn Extension resource to fetch.
     */
    public function __construct(Version $version, array $payload, string $availableAddOnSid, string $sid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'availableAddOnSid' => Values::array_get($payload, 'available_add_on_sid'),
            'friendlyName' => Values::array_get($payload, 'friendly_name'),
            'productName' => Values::array_get($payload, 'product_name'),
            'uniqueName' => Values::array_get($payload, 'unique_name'),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['availableAddOnSid' => $availableAddOnSid, 'sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return AvailableAddOnExtensionContext Context for this AvailableAddOnExtensionInstance
     */
    protected function proxy(): AvailableAddOnExtensionContext
    {
        if (!$this->context) {
            $this->context = new AvailableAddOnExtensionContext(
                $this->version,
                $this->solution['availableAddOnSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch the AvailableAddOnExtensionInstance
     *
     * @return AvailableAddOnExtensionInstance Fetched AvailableAddOnExtensionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): AvailableAddOnExtensionInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
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
        return '[Twilio.Marketplace.V1.AvailableAddOnExtensionInstance ' . \implode(' ', $context) . ']';
    }
}
