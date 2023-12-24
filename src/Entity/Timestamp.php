<?php
namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
trait Timestamp{

    #[ORM\Column(type: "datetime")]
    private DateTime $createdAt;

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist()]
    public function prePersist():void {
        $this->createdAt = new DateTime();
    }

}