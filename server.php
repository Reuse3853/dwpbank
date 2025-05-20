<?php
header("Content-Type: application/json; charset=utf-8");

$json = json_decode(onlyASCII(file_get_contents("php://input")), true);

function onlyASCII($string)
{
    $string = mb_convert_encoding($string, "UTF-8", "UTF-8");

    return preg_replace('/[^\x20-\x7E]/', "", $string);
}

$response;
if ($json["function"] == "getStocks") {
    $response["status"] = "OK";
    $response["stocks"] = [
        [
            "wkn" => "123456",
            "isin" => "DE0001234567",
            "name" => "TechCorp Aktie",
            "typ" => "AKTIE",
            "kurs" => 152.3,
            "anlagerisiko" => "Hoch",
            "datum_naechste_hauptversammlung" => "2025-06-15",
            "emittent" => "TechCorp AG",
            "branche" => "Technologie",
            "kgv" => 28.5,
            "dividende" => 1.25,
            "marktkapitalisierung" => "35",
            "kursentwicklung" => "+12",
            "beschreibung" => "Führender Anbieter im Technologiebereich mit starkem Wachstumspotenzial.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "654321",
            "isin" => "DE0006543210",
            "name" => "Enterprises Bond",
            "typ" => "Anleihe",
            "kurs" => 101.4,
            "anlagerisiko" => "Mittel",
            "datum_naechste_hauptversammlung" => "2025-07-10",
            "emittent" => "Enterprises GmbH",
            "branche" => "Finanzen",
            "kgv" => null,
            "dividende" => 2.1,
            "marktkapitalisierung" => null,
            "kursentwicklung" => "-1.5",
            "beschreibung" => "Solide Anleihe mit stabiler Rendite, ideal für mittelrisikofreudige Anleger.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "111111",
            "isin" => "DE0001111111",
            "name" => "Global Mix Fund",
            "typ" => "Fonds",
            "kurs" => 87.2,
            "anlagerisiko" => "Mittel",
            "datum_naechste_hauptversammlung" => "2025-08-20",
            "emittent" => "Global Invest AG",
            "branche" => "Mischfonds",
            "kgv" => null,
            "dividende" => 1.05,
            "marktkapitalisierung" => "2",
            "kursentwicklung" => "-6.8",
            "beschreibung" => "Diversifizierter Mischfonds mit Fokus auf globale Märkte.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "222222",
            "isin" => "DE0002222222",
            "name" => "Energy Sector ETF",
            "typ" => "ETF",
            "kurs" => 112.5,
            "anlagerisiko" => "Mittel",
            "datum_naechste_hauptversammlung" => "2025-09-12",
            "emittent" => "Energy Group",
            "branche" => "Energie",
            "kgv" => 14.2,
            "dividende" => 2.3,
            "marktkapitalisierung" => "6.5",
            "kursentwicklung" => "+9.1",
            "beschreibung" => "Breit aufgestellter ETF im Energiesektor mit positiver Kursentwicklung.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "333333",
            "isin" => "DE0003333333",
            "name" => "Pharma Innovations",
            "typ" => "Aktie",
            "kurs" => 98.75,
            "anlagerisiko" => "Hoch",
            "datum_naechste_hauptversammlung" => "2025-06-30",
            "emittent" => "Pharma AG",
            "branche" => "Pharma",
            "kgv" => 19.7,
            "dividende" => 0.85,
            "marktkapitalisierung" => "18",
            "kursentwicklung" => "+15.4",
            "beschreibung" => "Innovatives Pharmaunternehmen mit starkem Fokus auf Forschung.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "444444",
            "isin" => "DE0004444444",
            "name" => "Govt Bond 10Y",
            "typ" => "Anleihe",
            "kurs" => 100.0,
            "anlagerisiko" => "Niedrig",
            "datum_naechste_hauptversammlung" => "2025-09-01",
            "emittent" => "Bundesrepublik Deutschland",
            "branche" => "Staatsanleihen",
            "kgv" => null,
            "dividende" => 0.75,
            "marktkapitalisierung" => null,
            "kursentwicklung" => "+0.4",
            "beschreibung" => "Staatlich abgesicherte Anleihe mit minimalem Risiko.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "555555",
            "isin" => "DE0005555555",
            "name" => "Real Estate Fund",
            "typ" => "fonds",
            "kurs" => 143.8,
            "anlagerisiko" => "Mittel",
            "datum_naechste_hauptversammlung" => "2025-07-25",
            "emittent" => "Real Invest AG",
            "branche" => "Immobilien",
            "kgv" => null,
            "dividende" => 3.0,
            "marktkapitalisierung" => "1.8",
            "kursentwicklung" => "-5.2",
            "beschreibung" => "Immobilienfonds mit stabilen Erträgen aus europäischen Märkten.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "666666",
            "isin" => "DE0006666666",
            "name" => "Consumer Goods ETF",
            "typ" => "ETF",
            "kurs" => 72.5,
            "anlagerisiko" => "Mittel",
            "datum_naechste_hauptversammlung" => "2025-08-15",
            "emittent" => "Consumer Group",
            "branche" => "Konsumgüter",
            "kgv" => 16.3,
            "dividende" => 1.5,
            "marktkapitalisierung" => "3.7",
            "kursentwicklung" => "+7.6",
            "beschreibung" => "Branchenweiter Konsumgüter-ETF mit ausgewogenem Risiko-Ertrags-Verhältnis.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "777777",
            "isin" => "DE0007777777",
            "name" => "AutoMotive AG",
            "typ" => "Aktie",
            "kurs" => 215.0,
            "anlagerisiko" => "Hoch",
            "datum_naechste_hauptversammlung" => "2025-06-20",
            "emittent" => "AutoMotive AG",
            "branche" => "Automobil",
            "kgv" => 12.9,
            "dividende" => 4.2,
            "marktkapitalisierung" => "48",
            "kursentwicklung" => "+11.9",
            "beschreibung" => "Automobilkonzern mit starkem Exportgeschäft und Dividendenhistorie.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "888888",
            "isin" => "DE0008888888",
            "name" => "Convertible Bond",
            "typ" => "Anleihe",
            "kurs" => 103.2,
            "anlagerisiko" => "Mittel",
            "datum_naechste_hauptversammlung" => "2025-07-05",
            "emittent" => "Convertible Ltd.",
            "branche" => "Wandelanleihen",
            "kgv" => null,
            "dividende" => 1.9,
            "marktkapitalisierung" => null,
            "kursentwicklung" => "-2.6",
            "beschreibung" => "Wandelanleihe mit mittlerem Risiko und solider Verzinsung.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "999999",
            "isin" => "DE0009999999",
            "name" => "Fixed Income Fund",
            "typ" => "Fonds",
            "kurs" => 95.6,
            "anlagerisiko" => "Niedrig",
            "datum_naechste_hauptversammlung" => "2025-08-10",
            "emittent" => "Fixed Invest",
            "branche" => "Rentenfonds",
            "kgv" => null,
            "dividende" => 1.3,
            "marktkapitalisierung" => "1.1",
            "kursentwicklung" => "+3.3",
            "beschreibung" => "Rentenfonds mit niedriger Volatilität und konservativer Ausrichtung.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "101010",
            "isin" => "DE0001010101",
            "name" => "Tech Sector ETF",
            "typ" => "ETF",
            "kurs" => 123.45,
            "anlagerisiko" => "Hoch",
            "datum_naechste_hauptversammlung" => "2025-09-20",
            "emittent" => "Tech Group",
            "branche" => "Technologie",
            "kgv" => 26.7,
            "dividende" => 1.7,
            "marktkapitalisierung" => "5.5",
            "kursentwicklung" => "+10.7",
            "beschreibung" => "Technologie-ETF mit Fokus auf wachstumsstarke Unternehmen.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "202020",
            "isin" => "DE0002020202",
            "name" => "ChemIndustries",
            "typ" => "aktie",
            "kurs" => 67.9,
            "anlagerisiko" => "Mittel",
            "datum_naechste_hauptversammlung" => "2025-06-25",
            "emittent" => "Chem AG",
            "branche" => "Chemie",
            "kgv" => 17.4,
            "dividende" => 1.2,
            "marktkapitalisierung" => "9.4",
            "kursentwicklung" => "+6.5",
            "beschreibung" => "Chemieaktie mit stabilem Geschäft und moderatem KGV.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "303030",
            "isin" => "DE0003030303",
            "name" => "High Yield Bond",
            "typ" => "Anleihe",
            "kurs" => 110.15,
            "anlagerisiko" => "Hoch",
            "datum_naechste_hauptversammlung" => "2025-07-15",
            "emittent" => "High Yield Corp.",
            "branche" => "Unternehmensanleihen",
            "kgv" => null,
            "dividende" => 4.1,
            "marktkapitalisierung" => null,
            "kursentwicklung" => "-4.9",
            "beschreibung" => "Hochzinsanleihe mit überdurchschnittlicher Rendite und erhöhtem Risiko.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
        [
            "wkn" => "404040",
            "isin" => "DE0004040404",
            "name" => "Equity Growth Fund",
            "typ" => "Fonds",
            "kurs" => 129.0,
            "anlagerisiko" => "Hoch",
            "datum_naechste_hauptversammlung" => "2025-08-05",
            "emittent" => "Growth Invest",
            "branche" => "Aktienfonds",
            "kgv" => null,
            "dividende" => 0.9,
            "marktkapitalisierung" => "3.3",
            "kursentwicklung" => "+8.4",
            "beschreibung" => "Aktienfonds mit Fokus auf wachstumsorientierte Unternehmen weltweit.",
            "historie" => array_map(
                function ($date) {
                    return [
                        "x" => $date,
                        "y" => rand(140, 180),
                    ];
                },
                [
                    "2025-01-01T00:00:00Z",
                    "2025-01-08T00:00:00Z",
                    "2025-01-15T00:00:00Z",
                    "2025-01-22T00:00:00Z",
                    "2025-01-29T00:00:00Z",
                    "2025-02-05T00:00:00Z",
                    "2025-02-12T00:00:00Z",
                    "2025-02-19T00:00:00Z",
                    "2025-02-26T00:00:00Z",
                    "2025-03-05T00:00:00Z",
                    "2025-03-12T00:00:00Z",
                    "2025-03-19T00:00:00Z",
                    "2025-03-26T00:00:00Z",
                    "2025-04-02T00:00:00Z",
                    "2025-04-09T00:00:00Z",
                ]
            ),
        ],
    ];
}

echo json_encode($response);

?>
