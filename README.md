# Laravel Dutch Helpers

Dit laravel pakket komt met een toolbox om Nederlandse adressen te zoeken aan de hand van postcode en huisnummer. Daarnaast breidt het de validatie regels uit met Nederlands telefoonnummer en postcode validatie.

## Features
- Dutch Phone Number Validation
- Dutch Postal Code Validation
- Find address via Postal Code and House Number

## Installation

Via Composer

```bash
$ composer require itsonlyjeff/dutch-helpers:^0.1
```

## Basic Usage

**RandomController.php**
```php
use ItsOnlyJeff\DutchHelpers\Classes\NLPostCodeService;

// ...

$validator = $request->validate([
            'phone' => ['required', 'dutch-phone-number'],
            'zipcode' => ['required', 'dutch-zipcode'],
            'house_number' => ['required', 'numeric'],
        ]);

$location_details = new NLPostCodeService($validator['zipcode'], $validator['house_number']);

$address = $location_details->adres;
$latlon = $location_details->locatie;
// etc...
```
**Response**
``` yaml
{
bron: "BAG",
postcode: "2595BG",
huisnummer: "1",
woonplaatsnaam: "'s-Gravenhage",
gemeentenaam: "'s-Gravenhage",
provincienaam: "Zuid-Holland"
provincieafkorting: "ZH"
straatnaam: "Prinses Irenepad"
adres: "Prinses Irenepad"
locatie: array:2 [▼
    0 => "4.32599601"
    1 => "52.08314722"
  ]
percelen: []
buurtnaam: "Bezuidenhout-West"
wijknaam: "Wijk 26 Bezuidenhout"
waterschapsnaam: "Hoogheemraadschap van Delfland"
gekoppeld_appartement: []
}
```

## Contributing
Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

