<?php namespace BoundedContext\Contracts\Player;

use BoundedContext\Contracts\Player\Snapshot\Snapshot;

interface Factory
{
    /**
     * Returns a Player by a Snapshot.
     *
     * @param Snapshot $snapshot
     * @return Player $player
     */

    public function snapshot(Snapshot $snapshot);
}
