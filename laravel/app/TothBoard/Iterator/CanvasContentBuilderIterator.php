<?php

namespace App\TothBoard\Iterator;

use App\TothBoard\Entity\CanvasCard;


class CanvasContentBuilderIterator
{
	static public function buildFromType(array $canvas_card_list, array $type_card_list) : array
	{
		$result_card_list = array();

		foreach ($type_card_list as $card_type => $card)
		{
			$result_card_list[$card_type] = new CanvasCard();
			$result_card_list[$card_type]->sequence = $card['Sequence'];
			$result_card_list[$card_type]->max_card_row = $card['MaxCardRow'];
			$result_card_list[$card_type]->max_card_column = $card['MaxCardColumn'];
			$result_card_list[$card_type]->name = $card['Name'];

			if (isset($canvas_card_list[$card_type]) and is_array($canvas_card_list[$card_type]))
			{
				if (isset($canvas_card_list[$card_type]['Value']) and is_array($canvas_card_list[$card_type]['Value']))
				{
					foreach ($canvas_card_list[$card_type]['Value'] as $value_sequence => $value)
					{
						$result_card_list[$card_type]->card_value[$value_sequence] = $value;
					}
				}
			}
		}

		return $result_card_list;
	}

	static public function exportToJson(array $canvas_card_list) : array
	{
		$result_card_list = array();

		foreach ($canvas_card_list as $card_type => $card) {
			$result_card_list[$card_type] = array();
			$result_card_list[$card_type]['Sequence'] = $card->sequence;
			$result_card_list[$card_type]['MaxCardRow'] = $card->max_card_row;
			$result_card_list[$card_type]['MaxCardColumn'] = $card->max_card_column;
			$result_card_list[$card_type]['Name'] = $card->name;

			$result_card_list[$card_type]['Value'] = array();
			foreach ($card->card_value as $card_value_order => $card_value) {
				$result_card_list[$card_type]['Value'][$card_value_order] = $card_value;
			}		
		}

		return $result_card_list;
	}
}

?>