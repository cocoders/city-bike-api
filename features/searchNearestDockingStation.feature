Feature: As a public transport user
  I want to find nearest bike docking station easily
  so I can use app which search nearest stations from my location

  Background:
    Given there are such docking stations:
      | name                     | lat        | long       | available bikes |
      | Toruń Rynek Staromiejski | 53.010418  | 18.6037566 |              5  |
      | Toruń Św Katarzyny       | 53.0132672 | 18.613699  |              2  |
      | Toruń Plac Rapackiego    | 53.0099343 | 18.6010726 |              0  |

  Scenario: Searching next docking station
    When I am searching nearest bike docking stations from my posisiton which is "53.03531,18.598338"
    Then I should see such nearest docking stations:
      | name                     | lat        | long       | available bikes | distance (km) |
      | Toruń Św Katarzyny       | 53.0132672 | 18.613699  |               2 |          2.66 |
      | Toruń Rynek Staromiejski | 53.010418  | 18.6037566 |               5 |          2.79 |
      | Toruń Plac Rapackiego    | 53.0099343 | 18.6010726 |               0 |          2.83 |

    # 2.9km
    # 3.0km
    # 3.2km
