<?php

declare(strict_types=1);

namespace common\yii;

use yii\validators\FilterValidator;

/**
 * @inheritdoc
 */
class TrimValidator extends FilterValidator {
	/** @inheritdoc */
	public $filter = 'trim';
}
