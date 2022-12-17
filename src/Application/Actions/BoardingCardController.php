<?php

namespace App\Application\Actions;

use App\Domain\Collection\BoardingCardCollection;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;

class BoardingCardController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public static function convert(Request $request, Response $response): Response
    {
        $cardList = $request->getParsedBody();
        if (!$cardList) {
            return $response->withStatus(400)->withJson('List not found');
        }

        # Sort
        $boardingCardCollection = (new BoardingCardCollection())->hydrate($cardList);
        $sortedBoardingCardList = (new BoardingCardSorter($boardingCardCollection))->execute();

        # Stringify
        $boardingCardCollectionSorted = (new BoardingCardCollection())->fromArray($sortedBoardingCardList);
        $humanizedBoardingCardList = (new BoardingCardStringifier($boardingCardCollectionSorted))->execute();

        return $response->withStatus(200)->withJson($humanizedBoardingCardList);
    }
}