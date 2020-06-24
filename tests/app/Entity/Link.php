<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a qualified reference to another resource. Patterned after the RFC5988 Web Linking Model.
 *
 * @see http://www.w3.org/ns/activitystreams#Link
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Link")
 */
abstract class Link
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @var string|null Identifies an entity to which an object is attributed
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#attributedTo")
     */
    private ?string $attributedTo = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#preview")
     */
    private ?string $preview = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#name")
     */
    private ?string $name = null;

    /**
     * @var int|null The display height expressed as device independent pixels
     *
     * @ORM\Column(type="integer", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#height")
     */
    private ?int $height = null;

    /**
     * @var string|null The target URI of the Link
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#href")
     */
    private ?string $href = null;

    /**
     * @var string|null A hint about the language of the referenced resource
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#hreflang")
     */
    private ?string $hreflang = null;

    /**
     * @var string|null The MIME Media Type
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#mediaType")
     */
    private ?string $mediaType = null;

    /**
     * @var string|null The RFC 5988 or HTML5 Link Relation associated with the Link
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#rel")
     */
    private ?string $rel = null;

    /**
     * @var int|null specifies the preferred display width of the content, expressed in terms of device independent pixels
     *
     * @ORM\Column(type="integer", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#width")
     */
    private ?int $width = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setAttributedTo(?string $attributedTo): void
    {
        $this->attributedTo = $attributedTo;
    }

    public function getAttributedTo(): ?string
    {
        return $this->attributedTo;
    }

    public function setPreview(?string $preview): void
    {
        $this->preview = $preview;
    }

    public function getPreview(): ?string
    {
        return $this->preview;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setHeight(?int $height): void
    {
        $this->height = $height;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHref(?string $href): void
    {
        $this->href = $href;
    }

    public function getHref(): ?string
    {
        return $this->href;
    }

    public function setHreflang(?string $hreflang): void
    {
        $this->hreflang = $hreflang;
    }

    public function getHreflang(): ?string
    {
        return $this->hreflang;
    }

    public function setMediaType(?string $mediaType): void
    {
        $this->mediaType = $mediaType;
    }

    public function getMediaType(): ?string
    {
        return $this->mediaType;
    }

    public function setRel(?string $rel): void
    {
        $this->rel = $rel;
    }

    public function getRel(): ?string
    {
        return $this->rel;
    }

    public function setWidth(?int $width): void
    {
        $this->width = $width;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }
}
