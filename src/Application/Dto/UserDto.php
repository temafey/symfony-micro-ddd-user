<?php

declare(strict_types=1);

namespace Backend\Api\User\Application\Dto;

use MicroModule\Base\Domain\Exception\SerializationException;

/**
 * Class UserDto.
 *
 * @SuppressWarnings(PHPMD)
 */
class UserDto implements NormalizeInterface
{
    private const  VERSION = '0.0.1';

    /**
     * Dto version value.
     *
     * @var string
     */
    private string $version;

    /**
     * User uuid value.
     *
     * @var string|null
     */
    private ?string $uuid = null;

    /**
     * User name value.
     *
     * @var string|null
     */
    private ?string $nickname = null;

    /**
     * User password value.
     *
     * @var string|null
     */
    private ?string $password = null;

    /**
     * User firstname value.
     *
     * @var string|null
     */
    private ?string $firstname = null;

    /**
     * User lastname value.
     *
     * @var string|null
     */
    private ?string $lastname = null;

    /**
     * User age value.
     *
     * @var int|null
     */
    private ?int $age = null;

    /**
     * User createAt date value.
     *
     * @var string|null
     */
    private ?string $createdAt = null;

    /**
     * User updatedAt date value.
     *
     * @var string|null
     */
    private ?string $updatedAt = null;

    /**
     * Convert array to dto object.
     *
     * @param mixed[] $data
     *
     * @return UserDto
     */
    public static function denormalize(array $data)
    {
        $obj = new self();
        $obj->setVersion($data['version']);

        if (isset($data['uuid'])) {
            $obj->setUuid($data['uuid']);
        }

        if (isset($data['nickname'])) {
            $obj->setNickname($data['nickname']);
        }

        if (isset($data['password'])) {
            $obj->setPassword($data['password']);
        }

        if (isset($data['firstname'])) {
            $obj->setFirstname($data['firstname']);
        }

        if (isset($data['lastname'])) {
            $obj->setLastname($data['lastname']);
        }

        if (isset($data['age'])) {
            $obj->setAge($data['age']);
        }

        if (isset($data['createdAt'])) {
            $obj->setCreatedAt($data['createdAt']);
        }

        if (isset($data['updatedAt'])) {
            $obj->setUpdatedAt($data['updatedAt']);
        }

        return $obj;
    }

    /**
     * Convert object dto to array.
     *
     * @return mixed[]
     */
    public function normalize(): array
    {
        $data = [
            'version' => $this->getVersion(),
        ];

        if (null !== $this->uuid) {
            $data['uuid'] = $this->getUuid();
        }

        if (null !== $this->nickname) {
            $data['nickname'] = $this->getNickname();
        }

        if (null !== $this->password) {
            $data['password'] = $this->getPassword();
        }

        if (null !== $this->firstname) {
            $data['firstname'] = $this->getFirstname();
        }

        if (null !== $this->lastname) {
            $data['lastname'] = $this->getLastname();
        }

        if (null !== $this->age) {
            $data['age'] = $this->getAge();
        }

        if (null !== $this->createdAt) {
            $data['createdAt'] = $this->getCreatedAt();
        }

        if (null !== $this->updatedAt) {
            $data['updatedAt'] = $this->getUpdatedAt();
        }

        return $data;
    }

    /**
     * ProgramDto constructor.
     */
    public function __construct()
    {
        $this->version = self::VERSION;
    }

    /**
     * Validate is key exists in array.
     *
     * @param mixed[] $array
     * @param string|int $key
     *
     * @return bool
     */
    private static function keyExists(array $array, $key): bool
    {
        if (!isset($array[$key])) {
            throw new SerializationException(sprintf('Array does not contain an element with key "%s"', $key));
        }

        return true;
    }

    /**
     * Return uuid value.
     *
     * @return string|null
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * Set uuid value.
     *
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * Return version value.
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Set version value.
     *
     * @param string $version
     */
    private function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * Return nickname value.
     *
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * Set nickname value.
     *
     * @param string|null $nickname
     */
    public function setNickname(?string $nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * Return password value.
     *
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set password value.
     *
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Return name value.
     *
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Set name value.
     *
     * @param string|null $firstname
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * Return lastname value.
     *
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Set lastname value.
     *
     * @param string|null $lastname
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * Return age value.
     *
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * Set age value.
     *
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * Return createdAt value.
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt value.
     *
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Return updatedAt value.
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt value.
     *
     * @param string $updatedAt
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
