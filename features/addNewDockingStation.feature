Feature: As a system administrator
  I want to add new docking stations to the system
  so public transport users can search bikes in system including that station

  Scenario: Adding new docking station
    Given There are no docking stations
    When I am adding new docking station:
      | name                     | lat        | long       |
      | Toruń Plac Rapackiego    | 53.0099343 | 18.6010726 |
    Then docking station "Toruń Plac Rapcakiego" should be available for public transport users using the system
