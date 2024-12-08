<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Assistants
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Assistants\V1\Assistant;

use Twilio\Exceptions\TwilioException;
use Twilio\Values;
use Twilio\Version;
use Twilio\InstanceContext;


class AssistantsKnowledgeContext extends InstanceContext
    {
    /**
     * Initialize the AssistantsKnowledgeContext
     *
     * @param Version $version Version that contains the resource
     * @param string $assistantId The assistant ID.
     * @param string $id The knowledge ID.
     */
    public function __construct(
        Version $version,
        $assistantId,
        $id
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'assistantId' =>
            $assistantId,
        'id' =>
            $id,
        ];

        $this->uri = '/Assistants/' . \rawurlencode($assistantId)
        .'/Knowledge/' . \rawurlencode($id)
        .'';
    }

    /**
     * Create the AssistantsKnowledgeInstance
     *
     * @return AssistantsKnowledgeInstance Created AssistantsKnowledgeInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(): AssistantsKnowledgeInstance
    {

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        $payload = $this->version->create('POST', $this->uri, [], [], $headers);

        return new AssistantsKnowledgeInstance(
            $this->version,
            $payload,
            $this->solution['assistantId'],
            $this->solution['id']
        );
    }


    /**
     * Delete the AssistantsKnowledgeInstance
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
        return '[Twilio.Assistants.V1.AssistantsKnowledgeContext ' . \implode(' ', $context) . ']';
    }
}
