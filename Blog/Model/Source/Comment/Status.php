<?php

namespace Duud\Blog\Model\Source\Comment;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
	public function toOptionArray(){
		$option=[
			[
				"label" => __("Pending"),
				"value" => 0
			],
			
			[
				"label" => __("Denied"),
				"value" => 1
			],

			[
				"label" => __("Approve"),
				"value" => 2
			]
		];
		return $option;
	}
}