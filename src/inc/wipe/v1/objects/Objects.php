<?php
namespace wipe\inc\v1\objects;

use DB\Base\Stage as BaseStage;
use DB\Base\House as BaseHouse;
use DB\Base\Groups as BaseGroup;
use DB\Base\Project as BaseProject;
use DB\Base\Subproject as BaseSubproject;
use wipe\inc\v1\objects\exception\AccessDeniedException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;

class Objects
{
    private const ATTRIBUTE_STATUS_IN_PROCESS = 'in_process';
    private const ATTRIBUTE_STATUS_COMPLETED = 'completed';
    private const ATTRIBUTE_STATUS_DELETED = 'deleted';

    private const ATTRIBUTE_IS_AVAILABLE_OPEN_ACCESS = true;
    private const ATTRIBUTE_IS_AVAILABLE_PRIVATE_ACCESS = false;

    /** @var int|null ID объекта. */
    protected ?int $id = null;

    /** @var string|null Наименование объекта. */
    protected ?string $name = null;

    /** @var string|null Статус объекта (в процессе, завершен, удален). */
    protected ?string $status = null;

    /** @var bool|null Доступ к объекту (пуличный, приватный). */
    protected ?bool $is_available = null;

    /**
     * Заполнение свойств класса о умолчанию.
     * @return void
     */
    protected function applyByDefaultValues(): void
    {
        $this->status = $this::ATTRIBUTE_STATUS_IN_PROCESS;
        $this->is_available = $this::ATTRIBUTE_IS_AVAILABLE_OPEN_ACCESS;
    }

    /**
     * Заполнение свойств класса, используя объект.
     * @param BaseProject|BaseSubproject|BaseGroup|BaseHouse|BaseStage $obj
     * @return void
     */
    protected function applyDefaultValuesByObj(BaseProject|BaseSubproject|BaseGroup|BaseHouse|BaseStage &$obj): void
    {
        $this->name = $obj->getName();
        $this->status = $obj->getStatus();
        $this->is_available = $obj->getIsAvailable();
    }

    /** @return bool|null Доступ к объекту (пуличный, приватный). */
    public function isAvailable(): ?bool
    {
        return $this->is_available;
    }

    /**
     * @throws AccessDeniedException
     */
    public function isAvailableOrThrow(): bool
    {
        return $this->is_available ?: throw new AccessDeniedException();
    }

    #region Getter Default Values Functions
    /** @return int|null ID объекта. */
    public function getId(): ?int
    {
        return $this->id;
    }

    /** @return string|null Наименование объекта. */
    public function getName(): ?string
    {
        return $this->name;
    }

    /** @return string|null  Статус объекта (в процессе, завершен, удален). */
    public function getStatus(): ?string
    {
        return $this->status;
    }
    #endregion

    #region Setter Default Values Functions
    /**
     * Присваивание свойству класса ID объекта.
     * @param int|null $id ID объекта.
     * @return Objects
     */
    public function setId(?int $id): Objects
    {
        if ($this->id !== $id) {
            $this->id = $id;
        }

        return $this;
    }

    /**
     * @param string|null $name
     * @return Objects
     */
    public function setName(?string $name): Objects
    {
        if ($this->name !== $name) {
            $this->name = $name;
        }

        return $this;
    }

    /**
     * @param string $status
     * @return Objects
     * @throws IncorrectStatusException
     */
    public function setStatus(string $status): Objects
    {
        if ($this->status !== $status) {
            if ($status === $this::ATTRIBUTE_STATUS_IN_PROCESS ||
                $status === $this::ATTRIBUTE_STATUS_COMPLETED ||
                $status === $this::ATTRIBUTE_STATUS_DELETED) $this->status = $status;
            else throw new IncorrectStatusException();
        }

        return $this;
    }
    #endregion

}