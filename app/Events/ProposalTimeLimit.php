<?php

namespace App\Events;

use App\Data\Models\Proposal;
use Illuminate\Queue\SerializesModels;

class ProposalTimeLimit extends Event
{
    use SerializesModels;
    /**
     * @var Proposal
     */
    private $proposal;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Proposal $proposal)
    {
        //
        $this->proposal = $proposal;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }

    /**
     * @return Proposal
     */
    public function getProposal()
    {
        return $this->proposal;
    }
}
