<?php

namespace ItsOnlyJeff\DutchHelpers\Classes;

use Illuminate\Support\Facades\Http;

class NLPostCodeService
{
    const ENDPOINT_URL_FREE = 'https://api.pdok.nl/bzk/locatieserver/search/v3_1/free?fq=';

    public string $bron;
    public string $postcode;
    public string $huisnummer;
    public string $woonplaatsnaam;
    public string $gemeentenaam;
    public string $provincienaam;
    public string $provincieafkorting;
    public string $straatnaam;
    public string $adres;
    public array $locatie;
    public array $percelen;
    public string $buurtnaam;
    public string $wijknaam;
    public string $waterschapsnaam;
    public array $gekoppeld_appartement;


    public function __construct(string $postcode, string $huisnummer)
    {
        $resultsFromApi = self::getResultsFromApi($postcode, $huisnummer);
        $this->bron = $resultsFromApi->bron ?? '';
        $this->postcode = $resultsFromApi->postcode ?? '';
        $this->huisnummer = $huisnummer;
        $this->woonplaatsnaam = $resultsFromApi->woonplaatsnaam ?? '';
        $this->gemeentenaam = $resultsFromApi->gemeentenaam ?? '';
        $this->provincienaam = $resultsFromApi->provincienaam ?? '';
        $this->provincieafkorting = $resultsFromApi->provincieafkorting ?? '';
        $this->straatnaam = $resultsFromApi->straatnaam ?? '';
        $this->adres = $resultsFromApi->straatnaam ?? '' . ' ' . $huisnummer;
        $this->locatie = explode(' ', trim(str_replace(['POINT(', ')'], '', $resultsFromApi->centroide_ll))) ?? [];
        $this->buurtnaam = $resultsFromApi->buurtnaam ?? '';
        $this->wijknaam = $resultsFromApi->wijknaam ?? '';
        $this->percelen = $resultsFromApi->gekoppeld_perceel ?? [];
        $this->waterschapsnaam = $resultsFromApi->waterschapsnaam ?? '';
        $this->gekoppeld_appartement = $resultsFromApi->gekoppeld_appartement ?? [];
    }

    static function getResultsFromApi(string $postalCode, ?string $houseNumber = null)
    {
        $query = 'postcode:'.str_replace(' ', '', $postalCode).'&q=huisnummer~"'.str_replace(' ', '', $houseNumber).'"*';
        $content = json_decode(Http::get(self::ENDPOINT_URL_FREE.$query));
        if (isset($content->response->docs[0])) {
            return $content->response->docs[0];
        }
        return null;

    }

}