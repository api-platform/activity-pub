<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An Object representing some form of Action that has been taken.
 *
 * @see http://www.w3.org/ns/activitystreams#Activity
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Activity")
 */
abstract class Activity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @var string|null Subproperty of as:attributedTo that identifies the primary actor
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#actor")
     */
    private ?string $actor = null;

    /**
     * @var string|null Identifies an entity to which an object is attributed
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#attributedTo")
     */
    private ?string $attributedTo = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Link")
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#attachment")
     */
    private ?Link $attachment = null;

    /**
     * @var string[]|null
     *
     * @ORM\Column(type="json", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#bcc")
     */
    private ?array $bcc = null;

    /**
     * @var string[]|null
     *
     * @ORM\Column(type="json", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#bto")
     */
    private ?array $bto = null;

    /**
     * @var string[]|null
     *
     * @ORM\Column(type="json", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#cc")
     */
    private ?array $cc = null;

    /**
     * @var string|null Specifies the context within which an object exists or an activity was performed
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#context")
     */
    private ?string $context = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#generator")
     */
    private ?string $generator = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Image")
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#icon")
     */
    private ?Image $icon = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Image")
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#image")
     */
    private ?Image $image = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#inReplyTo")
     */
    private ?string $inReplyTo = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#location")
     */
    private ?string $location = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#object")
     */
    private ?string $object = null;

    /**
     * @var string|null describes a possible exclusive answer or option for a question
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#oneOf")
     */
    private ?string $oneOf = null;

    /**
     * @var string|null describes a possible inclusive answer or option for a question
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#anyOf")
     */
    private ?string $anyOf = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#preview")
     */
    private ?string $preview = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#result")
     */
    private ?string $result = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#audience")
     */
    private ?string $audience = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#tag")
     */
    private ?string $tag = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#target")
     */
    private ?string $target = null;

    /**
     * @var string|null for certain activities, specifies the entity from which the action is directed
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#origin")
     */
    private ?string $origin = null;

    /**
     * @var string|null Indentifies an object used (or to be used) to complete an activity
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#instrument")
     */
    private ?string $instrument = null;

    /**
     * @var string[]|null
     *
     * @ORM\Column(type="json", nullable=true, name="`to`")
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#to")
     */
    private ?array $to = null;

    /**
     * @var Link|null Specifies a link to a specific representation of the Object
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Link")
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#url")
     */
    private ?Link $url = null;

    /**
     * @var string|null the content of the object
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#content")
     */
    private ?string $content = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#name")
     */
    private ?string $name = null;

    /**
     * @var \DateInterval|null The duration of the object
     *
     * @ORM\Column(nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#duration")
     */
    private ?\DateInterval $duration = null;

    /**
     * @var \DateTimeInterface|null The ending time of the object
     *
     * @ORM\Column(type="date", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#endTime")
     */
    private ?\DateTimeInterface $endTime = null;

    /**
     * @var string|null The MIME Media Type
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#mediaType")
     */
    private ?string $mediaType = null;

    /**
     * @var \DateTimeInterface|null Specifies the date and time the object was published
     *
     * @ORM\Column(type="date", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#published")
     */
    private ?\DateTimeInterface $published = null;

    /**
     * @var \DateTimeInterface|null The starting time of the object
     *
     * @ORM\Column(type="date", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#startTime")
     */
    private ?\DateTimeInterface $startTime = null;

    /**
     * @var string|null A short summary of the object
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#summary")
     */
    private ?string $summary = null;

    /**
     * @var \DateTimeInterface|null Specifies when the object was last updated
     *
     * @ORM\Column(type="date", nullable=true)
     * @ApiProperty(iri="http://www.w3.org/ns/activitystreams#updated")
     */
    private ?\DateTimeInterface $updated = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $externalId = null;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setActor(?string $actor): void
    {
        $this->actor = $actor;
    }

    public function getActor(): ?string
    {
        return $this->actor;
    }

    public function setAttributedTo(?string $attributedTo): void
    {
        $this->attributedTo = $attributedTo;
    }

    public function getAttributedTo(): ?string
    {
        return $this->attributedTo;
    }

    public function setAttachment(?Link $attachment): void
    {
        $this->attachment = $attachment;
    }

    public function getAttachment(): ?Link
    {
        return $this->attachment;
    }

    public function addBcc(string $bcc): void
    {
        $this->bcc[] = $bcc;
    }

    public function removeBcc(string $bcc): void
    {
        if (false !== $key = array_search($bcc, $this->bcc ?? [], true)) {
            unset($this->bcc[$key]);
        }
    }

    /**
     * @return string[]|null
     */
    public function getBcc(): ?array
    {
        return $this->bcc;
    }

    public function addBto(string $bto): void
    {
        $this->bto[] = $bto;
    }

    public function removeBto(string $bto): void
    {
        if (false !== $key = array_search($bto, $this->bto ?? [], true)) {
            unset($this->bto[$key]);
        }
    }

    /**
     * @return string[]|null
     */
    public function getBto(): ?array
    {
        return $this->bto;
    }

    public function addCc(string $cc): void
    {
        $this->cc[] = $cc;
    }

    public function removeCc(string $cc): void
    {
        if (false !== $key = array_search($cc, $this->cc ?? [], true)) {
            unset($this->cc[$key]);
        }
    }

    /**
     * @return string[]|null
     */
    public function getCc(): ?array
    {
        return $this->cc;
    }

    public function setContext(?string $context): void
    {
        $this->context = $context;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function setGenerator(?string $generator): void
    {
        $this->generator = $generator;
    }

    public function getGenerator(): ?string
    {
        return $this->generator;
    }

    public function setIcon(?Image $icon): void
    {
        $this->icon = $icon;
    }

    public function getIcon(): ?Image
    {
        return $this->icon;
    }

    public function setImage(?Image $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setInReplyTo(?string $inReplyTo): void
    {
        $this->inReplyTo = $inReplyTo;
    }

    public function getInReplyTo(): ?string
    {
        return $this->inReplyTo;
    }

    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setObject(?string $object): void
    {
        $this->object = $object;
    }

    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setOneOf(?string $oneOf): void
    {
        $this->oneOf = $oneOf;
    }

    public function getOneOf(): ?string
    {
        return $this->oneOf;
    }

    public function setAnyOf(?string $anyOf): void
    {
        $this->anyOf = $anyOf;
    }

    public function getAnyOf(): ?string
    {
        return $this->anyOf;
    }

    public function setPreview(?string $preview): void
    {
        $this->preview = $preview;
    }

    public function getPreview(): ?string
    {
        return $this->preview;
    }

    public function setResult(?string $result): void
    {
        $this->result = $result;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setAudience(?string $audience): void
    {
        $this->audience = $audience;
    }

    public function getAudience(): ?string
    {
        return $this->audience;
    }

    public function setTag(?string $tag): void
    {
        $this->tag = $tag;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTarget(?string $target): void
    {
        $this->target = $target;
    }

    public function getTarget(): ?string
    {
        return $this->target;
    }

    public function setOrigin(?string $origin): void
    {
        $this->origin = $origin;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setInstrument(?string $instrument): void
    {
        $this->instrument = $instrument;
    }

    public function getInstrument(): ?string
    {
        return $this->instrument;
    }

    public function addTo(string $to): void
    {
        $this->to[] = $to;
    }

    public function removeTo(string $to): void
    {
        if (false !== $key = array_search($to, $this->to ?? [], true)) {
            unset($this->to[$key]);
        }
    }

    /**
     * @return string[]|null
     */
    public function getTo(): ?array
    {
        return $this->to;
    }

    public function setUrl(?Link $url): void
    {
        $this->url = $url;
    }

    public function getUrl(): ?Link
    {
        return $this->url;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDuration(?\DateInterval $duration): void
    {
        $this->duration = $duration;
    }

    public function getDuration(): ?\DateInterval
    {
        return $this->duration;
    }

    public function setEndTime(?\DateTimeInterface $endTime): void
    {
        $this->endTime = $endTime;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setMediaType(?string $mediaType): void
    {
        $this->mediaType = $mediaType;
    }

    public function getMediaType(): ?string
    {
        return $this->mediaType;
    }

    public function setPublished(?\DateTimeInterface $published): void
    {
        $this->published = $published;
    }

    public function getPublished(): ?\DateTimeInterface
    {
        return $this->published;
    }

    public function setStartTime(?\DateTimeInterface $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setSummary(?string $summary): void
    {
        $this->summary = $summary;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setUpdated(?\DateTimeInterface $updated): void
    {
        $this->updated = $updated;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setExternalId(?string $externalId): void
    {
        $this->externalId = $externalId;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }
}
