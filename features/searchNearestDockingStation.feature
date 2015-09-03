Feature: Searching docking station

  In order to use app which search nearest stations from my location
  As a public transport user
  I want to find nearest bike docking station easily

  Background:
    Given there are such docking stations:
    | id  | name                     | lat        | long       | available bikes |
    | 1   | Toruń Rynek Staromiejski | 53.010418  | 18.6037566 |              5  |
    | 2   | Toruń Św Katarzyny       | 53.0132672 | 18.613699  |              2  |
    | 3   | Toruń Plac Rapackiego    | 53.0099343 | 18.6010726 |              0  |

    @api
  Scenario: Searching next docking station
    When I am searching nearest bike docking stations from my posisiton which is "53.03531,18.598338"
    Then I should see such nearest docking stations:
     | id  | name                     | lat        | long       | available bikes | distance (km) |
     | 1   | Toruń Św Katarzyny       | 53.0132672 | 18.613699  |               2 |          2.66 |
     | 2   | Toruń Rynek Staromiejski | 53.010418  | 18.6037566 |               5 |          2.79 |
     | 3   | Toruń Plac Rapackiego    | 53.0099343 | 18.6010726 |               0 |          2.83 |
