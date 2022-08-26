<?php
namespace wipe\inc\v1\objects;

use DB\Base\Stage as BaseStage;
use DB\Base\House as BaseHouse;
use DB\Base\Groups as BaseGroup;
use DB\Base\Project as BaseProject;
use DB\Base\Subproject as BaseSubproject;

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

    protected function applyByDefaultValues(): void
    {
        $this->status = $this::ATTRIBUTE_STATUS_IN_PROCESS;
        $this->is_available = $this::ATTRIBUTE_IS_AVAILABLE_OPEN_ACCESS;
    }

    protected function applyDefaultValuesByObj(BaseProject|BaseSubproject|BaseGroup|BaseHouse|BaseStage &$obj): void
    {
        $this->id = $obj->getId();
        $this->name = $obj->getName();
        $this->status = $obj->getStatus();
        $this->is_available = $obj->getIsAvailable();
    }
}