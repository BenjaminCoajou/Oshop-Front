<?php


// Voilà ce que j'imagine qu'il se passe du côté de PDO lorsqu'il nous fournit les résultats avec FETCH_CLASS ou de fetchObject

$results = []; // les résultats renvoyés par mySQL

$resultsToReturn = [];

function fetchAll($fetchStyle, $className)
{
    if ($fetchStyle == \PDO::FETCH_CLASS) {
        foreach ($this->results as $result) {
            $currentResult = new $className();
            // pour chaque champ du résultat (dans $result), on donne une valeur à la propriété qui correspond
            // pour le champ name de la table article
            $currentResult->name = $result['name'];
            $currentResult->rate = $result['rate'];
            $currentResult->picture = $result['picture'];
            $this->resultToReturn[] = $currentResult;
        }
    } else if ($fetchStyle == PDO::FETCH_ASSOC) {
        // préparer un tableau associatif dans $resultsToReturn et le retourner
    }


    return $this->resultsToReturn;
}
