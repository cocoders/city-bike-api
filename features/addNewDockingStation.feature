Feature: As a system administrator
  I want to add new docking stations to the system

  Scenario: Adding new docking station
    Given There are no docking stations
    When I am adding new docking station:
      | name                     | lat        | long       |
      | Toruń Plac Rapackiego    | 53.0099343 | 18.6010726 |
    Then There should be "1" docking station in the system